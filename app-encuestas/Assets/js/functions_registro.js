document.addEventListener('DOMContentLoaded', function () {
    fntGetSurveys();

    // Validate Form
    if (document.querySelector("#formRegistro")) {
        let formRegistro = document.querySelector("#formRegistro");
        formRegistro.onsubmit = function (e) {
            e.preventDefault();
            fntSaveAnswers();
        }
    }
});

async function fntGetSurveys() {
    const listSurveys = document.querySelector("#listSurveys");
    const objData = await fetchData(BASE_URL_API + '/Registro/getSurveys');
    if (objData.status) {
        let html = '<option value="">Seleccione una encuesta...</option>';
        objData.data.forEach(item => {
            html += `<option value="${item.id_hsurvey}">${item.name_hsurvey}</option>`;
        });
        listSurveys.innerHTML = html;
    }
}

async function fntLoadForm() {
    const idSurvey = document.querySelector("#listSurveys").value;
    const container = document.querySelector("#containerForm");
    const divActions = document.querySelector("#divActions");

    if (idSurvey == "") {
        container.style.display = "none";
        divActions.style.display = "none";
        container.innerHTML = '<div class="text-center p-5"><i class="fas fa-spinner fa-spin"></i> Cargando formulario...</div>';
        return;
    }

    container.style.display = "block";
    divActions.style.display = "none"; // Hide until loaded

    // Reuse Encuestas API to get questions
    const objData = await fetchData(BASE_URL_API + '/Encuestas/getQuestions/' + idSurvey);

    if (objData.status && Array.isArray(objData.data)) {
        let html = '';
        objData.data.forEach(q => {
            html += generateQuestionHTML(q);
        });
        container.innerHTML = html;
        divActions.style.display = "block";
    } else {
        container.innerHTML = '<div class="alert alert-info text-center">No hay preguntas configuradas para esta encuesta.</div>';
    }
}

function generateQuestionHTML(q) {
    let inputHtml = '';
    let required = 'required'; // Assume all required for now, or check logical business rule? Let's make them required for basic version unless empty options logic exists.

    // Parse options
    let options = [];
    if (q.options_bsurvey && q.options_bsurvey !== "null") {
        try { options = JSON.parse(q.options_bsurvey); } catch (e) { }
    }

    const qId = q.id_bsurvey;
    const qType = q.type_bsurvey;

    // Type 1: Texto Abierto
    if (qType == 1) {
        inputHtml = `<input type="text" class="form-control question-input" data-id="${qId}" data-type="${qType}">`;
    }
    // Type 2: Fecha
    else if (qType == 2) {
        inputHtml = `<input type="date" class="form-control question-input" data-id="${qId}" data-type="${qType}">`;
    }
    // Type 3: Seleccion Unica (Radio)
    else if (qType == 3) {
        if (Array.isArray(options)) {
            options.forEach((opt, i) => {
                let val = (typeof opt === 'object') ? opt.nombre : opt;
                let hasInput = (typeof opt === 'object') ? opt.has_input : false;

                inputHtml += `
                <div class="form-check">
                    <input class="form-check-input question-input-radio" type="radio" name="radio_${qId}" id="radio_${qId}_${i}" value="${val}" data-id="${qId}" data-type="${qType}" data-hasinput="${hasInput}">
                    <label class="form-check-label" for="radio_${qId}_${i}">${val}</label>
                    ${hasInput ? `<input type="text" class="form-control form-control-sm d-inline-block ml-2 w-50 input-other" style="display:none;" placeholder="Especifique...">` : ''}
                </div>`;
            });
            // Listener for 'Others' input
            // Handled globally or after render?
        }
    }
    // Type 4: Seleccion Multiple (Checkbox)
    else if (qType == 4) {
        if (Array.isArray(options)) {
            options.forEach((opt, i) => {
                let val = (typeof opt === 'object') ? opt.nombre : opt;
                let hasInput = (typeof opt === 'object') ? opt.has_input : false;

                inputHtml += `
                <div class="form-check">
                    <input class="form-check-input question-input-check" type="checkbox" name="check_${qId}[]" id="check_${qId}_${i}" value="${val}" data-id="${qId}" data-type="${qType}" data-hasinput="${hasInput}">
                    <label class="form-check-label" for="check_${qId}_${i}">${val}</label>
                    ${hasInput ? `<input type="text" class="form-control form-control-sm d-inline-block ml-2 w-50 input-other" style="display:none;" placeholder="Especifique...">` : ''}
                </div>`;
            });
        }
    }
    // Type 5: Compuesta (Inputs based on options)
    else if (qType == 5) {
        if (Array.isArray(options)) {
            options.forEach((opt, i) => {
                let val = (typeof opt === 'object') ? opt.nombre : opt;
                inputHtml += `
                <div class="form-group row mb-2">
                    <label class="col-sm-1 col-form-label font-weight-bold" style="align-self: center;">${val}</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control question-input-compuesta" data-label="${val}" data-id="${qId}" data-type="${qType}">
                    </div>
                </div>`;
            });
        }
    }

    return `
    <div class="card mb-4 shadow-sm question-card" data-id="${qId}" data-type="${qType}">
        <div class="card-header bg-light">
            <h5 class="mb-0 text-dark">${q.question_bsurvey}</h5>
        </div>
        <div class="card-body">
            ${inputHtml}
        </div>
    </div>`;
}

async function fntSaveAnswers() {
    const idSurvey = document.querySelector("#listSurveys").value;
    if (idSurvey == "") return;

    let answers = [];
    const questionCards = document.querySelectorAll(".question-card");
    let isValid = true;

    questionCards.forEach(card => {
        const qId = card.getAttribute('data-id');
        const qType = card.getAttribute('data-type');
        let val = null;

        if (qType == 1 || qType == 2) {
            val = card.querySelector(".question-input").value;
        }
        else if (qType == 3) {
            // Radio
            const checked = card.querySelector("input[type='radio']:checked");
            if (checked) {
                val = checked.value;
                // If has extra input enabled
                if (checked.dataset.hasinput === "true") {
                    const container = checked.closest('.form-check');
                    const otherInput = container.querySelector('.input-other');
                    if (otherInput) {
                        const otherVal = otherInput.value.trim();
                        if (otherVal !== "") val = otherVal;
                        else val = checked.value;
                    }
                }
            }
        }
        else if (qType == 4) {
            // Checkbox - array
            val = [];
            const checks = card.querySelectorAll("input[type='checkbox']:checked");
            checks.forEach(chk => {
                let v = chk.value;
                if (chk.dataset.hasinput === "true") {
                    const container = chk.closest('.form-check');
                    const otherInput = container.querySelector('.input-other');
                    if (otherInput) {
                        const otherVal = otherInput.value.trim();
                        if (otherVal !== "") v = otherVal;
                    }
                }
                val.push(v);
            });
            if (val.length == 0) val = null;
        }
        else if (qType == 5) {
            // Compuesta - Multiple texts
            val = [];
            const inputs = card.querySelectorAll(".question-input-compuesta");
            inputs.forEach(inp => {
                if (inp.value.trim() !== "") {
                    val.push(inp.getAttribute('data-label') + ": " + inp.value.trim());
                }
            });
            if (val.length == 0) val = null;
        }

        // Basic Validation (Simple check empty)
        if (val === null || val === "" || (Array.isArray(val) && val.length === 0)) {
            isValid = false;
            card.classList.add("border-danger");
        } else {
            // Special check for Type 5: All fields must be filled
            if (qType == 5) {
                const totalInputs = card.querySelectorAll(".question-input-compuesta").length;
                if (val.length < totalInputs) {
                    isValid = false;
                    card.classList.add("border-danger");
                } else {
                    card.classList.remove("border-danger");
                    answers.push({
                        idQuestion: qId,
                        type: qType,
                        value: val
                    });
                }
            } else {
                card.classList.remove("border-danger");
                answers.push({
                    idQuestion: qId,
                    type: qType,
                    value: val
                });
            }
        }
    });

    if (!isValid) {
        swal("Atención", "Por favor responde todas las preguntas marcadas en rojo.", "error");
        return;
    }

    if (answers.length === 0) {
        swal("Atención", "No hay respuestas para guardar.", "warning");
        return;
    }

    const formData = new FormData();
    formData.append("idSurvey", idSurvey);
    formData.append("answers", JSON.stringify(answers));

    const objData = await fetchData(BASE_URL_API + '/Registro/saveRespuestas', 'POST', formData);
    if (objData.status) {
        swal("Guardado", `${objData.msg}\n\nID Usuario: ${localStorage.getItem('idUser')}\nSecuencia: ${objData.sequence}`, "success");
        fntResetForm();
    } else {
        swal("Error", objData.msg, "error");
    }
}

function fntResetForm() {
    document.querySelector("#listSurveys").value = "";
    document.querySelector("#containerForm").innerHTML = "";
    document.querySelector("#containerForm").style.display = "none";
    document.querySelector("#divActions").style.display = "none";
}

// Logic for "Other" input visibility (Event delegation)
document.addEventListener('change', function (e) {
    if (e.target && e.target.classList.contains('question-input-radio')) {
        // Radios: Hide all 'others' in this question group, show for this one if applicable
        const name = e.target.name;
        // Select all radios with same name
        const radios = document.querySelectorAll(`input[name="${name}"]`);
        radios.forEach(r => {
            const cont = r.closest('.form-check');
            const inp = cont.querySelector('.input-other');
            if (inp) {
                inp.style.display = 'none';
                inp.value = '';
            }
        });

        // If current checked has input
        if (e.target.dataset.hasinput === "true") {
            const cont = e.target.closest('.form-check');
            const inp = cont.querySelector('.input-other');
            if (inp) {
                inp.style.display = 'inline-block';
                inp.focus();
            }
        }
    }

    // Checkboxes: Toggle own input
    if (e.target && e.target.classList.contains('question-input-check')) {
        if (e.target.dataset.hasinput === "true") {
            const cont = e.target.closest('.form-check');
            const inp = cont.querySelector('.input-other');
            if (inp) {
                if (e.target.checked) {
                    inp.style.display = 'inline-block';
                    inp.focus();
                } else {
                    inp.style.display = 'none';
                    inp.value = '';
                }
            }
        }
    }
});
