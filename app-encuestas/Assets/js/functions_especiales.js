let tableEspeciales;

document.addEventListener('DOMContentLoaded', function () {
    tableEspeciales = $('#tableEspeciales').DataTable({
        "processing": true,
        "language": lenguajeEspanol,
        "ajax": {
            "url": BASE_URL_API + "/Especiales/getEspeciales",
            "type": "GET",
            "headers": { 'Authorization': `Bearer ${localStorage.getItem('userToken')}` },
            "dataSrc": ""
        },
        "columns": [
            { "data": "matr_especial" },
            { "data": "susc_especial" },
            { "data": "dire_especial" },
            { "data": "barr_especial" },
            { "data": "estado_especial" },
            { "data": "medi_especial", "visible": false },
            { "data": "lati_especial", "visible": false },
            { "data": "long_especial", "visible": false },
            { "data": "estr_especial", "visible": false },
            { "data": "tele_especial", "visible": false },
            { "data": "email_especial", "visible": false },
            { "data": "habi_especial", "visible": false },
            { "data": "frec_especial", "visible": false },
            { "data": "defr_especial", "visible": false },
            { "data": "alma_especial", "visible": false },
            { "data": "tial_especial", "visible": false },
            { "data": "deal_especial", "visible": false },
            { "data": "larg_especial", "visible": false },
            { "data": "anch_especial", "visible": false },
            { "data": "alto_especial", "visible": false },
            { "data": "punt_especial", "visible": false },
            { "data": "vivi_especial", "visible": false },
            { "data": "devi_especial", "visible": false },
            { "data": "tama_especial", "visible": false },
            { "data": "cuar_especial", "visible": false },
            { "data": "bani_especial", "visible": false },
            { "data": "zona_especial", "visible": false },
            { "data": "fren_especial", "visible": false },
            { "data": "fond_especial", "visible": false },
            { "data": "usos_especial", "visible": false },
            { "data": "inst_especial", "visible": false },
            { "data": "options" }
        ],
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success",
                "exportOptions": {
                    "columns": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
                }
            },
            {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger",
                "orientation": "landscape",
                "pageSize": "LEGAL",
                "exportOptions": {
                    "columns": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]
                }
            }
        ],
        "responsive": true,
        "destroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

    if (document.querySelector("#formEspecial")) {
        const formEspecial = document.querySelector("#formEspecial");
        formEspecial.onsubmit = async function (e) {
            e.preventDefault();
            const strMatr = document.querySelector('#txtMatr').value;
            const strSusc = document.querySelector('#txtSusc').value;

            if (strMatr == '' || strSusc == '') {
                swal("Atención", "Matrícula y Suscriptor son obligatorios.", "error");
                return;
            }

            const formData = new FormData(formEspecial);
            const objData = await fetchData(BASE_URL_API + '/Especiales/setEspecial', 'POST', formData);

            if (objData?.status) {
                $('#modalFormEspecial').modal("hide");
                formEspecial.reset();
                swal({
                    title: "Especiales",
                    text: objData.msg,
                    type: "success",
                    confirmButtonColor: "#28a745"
                });
                tableEspeciales.ajax.reload();
            } else {
                swal("Error", objData?.msg || "Error desconocido", "error");
            }
        };
    }
});

function openModal() {
    document.querySelector('#idEspecial').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Registro Especial";
    document.querySelector("#formEspecial").reset();
    document.querySelector("#txtEfec").value = ""; // Reset new field
    $('#modalFormEspecial').modal('show');
}

async function fntEditEspecial(idEspecial) {
    document.querySelector('#titleModal').innerHTML = "Actualizar Registro";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    const objData = await fetchData(BASE_URL_API + '/Especiales/getEspecial/' + idEspecial);

    if (objData?.status) {
        document.querySelector("#idEspecial").value = objData.data.id_especial;
        document.querySelector("#txtMatr").value = objData.data.matr_especial;
        document.querySelector("#txtSusc").value = objData.data.susc_especial;
        document.querySelector("#txtMedi").value = objData.data.medi_especial;
        document.querySelector("#txtBarr").value = objData.data.barr_especial;
        document.querySelector("#txtDire").value = objData.data.dire_especial;
        document.querySelector("#txtLati").value = objData.data.lati_especial;
        document.querySelector("#txtLong").value = objData.data.long_especial;
        document.querySelector("#txtEstr").value = objData.data.estr_especial;
        document.querySelector("#txtTele").value = objData.data.tele_especial;
        document.querySelector("#txtEmail").value = objData.data.email_especial;
        document.querySelector("#txtHabi").value = objData.data.habi_especial;
        document.querySelector("#txtFrec").value = objData.data.frec_especial;
        document.querySelector("#txtDefr").value = objData.data.defr_especial;
        document.querySelector("#txtAlma").value = objData.data.alma_especial;
        document.querySelector("#txtTial").value = objData.data.tial_especial;
        document.querySelector("#txtDeal").value = objData.data.deal_especial;
        document.querySelector("#txtLarg").value = objData.data.larg_especial;
        document.querySelector("#txtAnch").value = objData.data.anch_especial;
        document.querySelector("#txtAlto").value = objData.data.alto_especial;
        document.querySelector("#txtPunt").value = objData.data.punt_especial;
        document.querySelector("#txtVivi").value = objData.data.vivi_especial;
        document.querySelector("#txtDevi").value = objData.data.devi_especial;
        document.querySelector("#txtTama").value = objData.data.tama_especial;
        document.querySelector("#txtCuar").value = objData.data.cuar_especial;
        document.querySelector("#txtBani").value = objData.data.bani_especial;
        document.querySelector("#txtZona").value = objData.data.zona_especial;
        document.querySelector("#txtFren").value = objData.data.fren_especial;
        document.querySelector("#txtFond").value = objData.data.fond_especial;
        document.querySelector("#txtUsos").value = objData.data.usos_especial;
        document.querySelector("#txtInst").value = objData.data.inst_especial;
        document.querySelector("#txtEfec").value = objData.data.efect_especial;

        fntFrecuencia(objData.data.frec_especial);
        fntTipoAlmacenamiento(objData.data.tial_especial);
        fntVivienda(objData.data.vivi_especial);
        fntZonasVerdes(objData.data.zona_especial);
        $('#modalFormEspecial').modal('show');
    } else {
        swal("Error", objData?.msg || "Datos no encontrados", "error");
    }
}

function fntFrecuencia(value) {
    let txtDefr = document.querySelector("#txtDefr");
    if (value == "OTRO") {
        txtDefr.disabled = false;
        txtDefr.required = true;
    } else {
        txtDefr.disabled = true;
        txtDefr.required = false;
        txtDefr.value = "";
    }
}

function fntTipoAlmacenamiento(value) {
    let txtDeal = document.querySelector("#txtDeal");
    if (value == "OTROS") {
        txtDeal.disabled = false;
        txtDeal.required = true;
    } else {
        txtDeal.disabled = true;
        txtDeal.required = false;
        txtDeal.value = "";
    }
}

function fntVivienda(value) {
    let txtDevi = document.querySelector("#txtDevi");
    if (value == "OTRO") {
        txtDevi.disabled = false;
        txtDevi.required = true;
    } else {
        txtDevi.disabled = true;
        txtDevi.required = false;
        txtDevi.value = "";
    }
}

function fntZonasVerdes(value) {
    let txtFren = document.querySelector("#txtFren");
    let txtFond = document.querySelector("#txtFond");
    if (value == "SI") {
        txtFren.disabled = false;
        txtFond.disabled = false;
        txtFren.required = true;
        txtFond.required = true;
    } else {
        txtFren.disabled = true;
        txtFond.disabled = true;
        txtFren.required = false;
        txtFond.required = false;
        txtFren.value = "";
        txtFond.value = "";
    }
}

function fntDelEspecial(idEspecial) {
    swal({
        title: "Eliminar Registro",
        text: "¿Realmente quiere eliminar este registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, async function (isConfirm) {
        if (isConfirm) {
            let formData = new FormData();
            formData.append("idEspecial", idEspecial);
            const objData = await fetchData(BASE_URL_API + '/Especiales/delEspecial', 'POST', formData);

            if (objData?.status) {
                swal({
                    title: "Eliminado!",
                    text: objData.msg,
                    type: "success",
                    confirmButtonColor: "#28a745"
                });
                tableEspeciales.ajax.reload();
            } else {
                swal("Atención!", objData?.msg || "Error al eliminar", "error");
            }
        }
    });
}

function fntEfectividad(value) {
    if (value != "" && value != "EFECTIVA") {
        let strMatr = document.querySelector('#txtMatr').value;
        let strSusc = document.querySelector('#txtSusc').value;
        if (strMatr == '' || strSusc == '') {
            swal("Atención", "Matrícula y Suscriptor son obligatorios.", "error");
            document.querySelector("#txtEfec").value = "";
            return;
        }
        // Trigger existing submit handler
        let btnGuardar = document.querySelector("#btnActionForm");
        btnGuardar.click();
    }
}
