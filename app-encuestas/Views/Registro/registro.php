<?php headerAdmin($data); ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fas fa-edit"></i> <?= $data['page_title'] ?></h1>
            <p>Diligenciar Encuestas</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/registro"><?= $data['page_title'] ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form id="formRegistro" name="formRegistro">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label font-weight-bold">Seleccionar Encuesta:</label>
                            <div class="col-md-6">
                                <select class="form-control" id="listSurveys" name="listSurveys" onchange="fntLoadForm();" required>
                                    <option value="">Seleccione una encuesta...</option>
                                    <!-- Options loaded via JS -->
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div id="containerForm" style="display:none;">
                            <div class="text-center p-5"><i class="fas fa-spinner fa-spin"></i> Cargando formulario...</div>
                        </div>
                        <div id="divActions" class="mt-4 text-center" style="display:none;">
                            <button id="btnSubmit" class="btn btn-primary btn-lg" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Respuestas</button>
                            <button class="btn btn-secondary btn-lg" type="button" onclick="fntResetForm();"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php footerAdmin($data); ?>