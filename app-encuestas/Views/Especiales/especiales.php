<?php headerAdmin($data); ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fas fa-edit"></i> <?= $data['page_title'] ?></h1>
            <p>Gestión de Encuestas Pre-cargadas</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/especiales"><?= $data['page_title'] ?></a></li>
        </ul>
        <button class="btn btn-primary" type="button" onclick="openModalCSV();" style="margin-left: 10px;"><i
                class="fas fa-file-upload"></i> Cargar CSV</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableEspeciales">
                            <thead>
                                <tr>
                                    <th>Matrícula</th>
                                    <th>Suscriptor</th>
                                    <th>Dirección</th>
                                    <th>Barrio</th>
                                    <th>Estado</th>
                                    <th>Medidor</th>
                                    <th>Latitud</th>
                                    <th>Longitud</th>
                                    <th>Estrato</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Habitantes</th>
                                    <th>Frecuencia</th>
                                    <th>Otra Frec.</th>
                                    <th>Almacenamiento</th>
                                    <th>Tipo Almacenamiento</th>
                                    <th>Otro Alc.</th>
                                    <th>Largo</th>
                                    <th>Ancho</th>
                                    <th>Alto</th>
                                    <th>Puntos</th>
                                    <th>Vivienda</th>
                                    <th>Otra Viv.</th>
                                    <th>Tamaño</th>
                                    <th>Cuartos</th>
                                    <th>Baños</th>
                                    <th>Zona Verde</th>
                                    <th>Frente</th>
                                    <th>Fondo</th>
                                    <th>Usos</th>
                                    <th>Instalar</th>
                                    <th>Dig.</th>
                                    <th>Efectividad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<style>
    #modalFormEspecial .modal-body {
        font-size: 0.75rem;
    }

    #modalFormEspecial label {
        margin-bottom: 0.2rem;
        font-weight: 600;
    }

    #modalFormEspecial .form-control {
        font-size: 0.75rem;
        height: calc(1.6rem + 2px);
        padding: 0.2rem 0.5rem;
    }

    #modalFormEspecial h5.text-primary {
        font-size: 1rem;
        margin-bottom: 0.8rem;
        margin-top: 0.5rem;
    }
</style>
<div class="modal fade" id="modalFormEspecial" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Registro Especial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEspecial" name="formEspecial" class="form-horizontal">
                    <input type="hidden" id="idEspecial" name="idEspecial" value="">

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información Básica</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="txtMatr">Matrícula</label>
                                    <input type="text" class="form-control" id="txtMatr" name="txtMatr" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtMedi">Medidor</label>
                                    <input type="text" class="form-control" id="txtMedi" name="txtMedi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtSusc">Suscriptor</label>
                                <textarea class="form-control" id="txtSusc" name="txtSusc" rows="2"
                                    required=""></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="txtTele">Teléfono</label>
                                    <input type="text" class="form-control" id="txtTele" name="txtTele">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtEmail">Email</label>
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtDire">Dirección</label>
                                <textarea class="form-control" id="txtDire" name="txtDire" rows="2"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="txtBarr">Barrio</label>
                                    <input type="text" class="form-control" id="txtBarr" name="txtBarr">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtLati">Latitud</label>
                                    <input type="text" class="form-control" id="txtLati" name="txtLati">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtLong">Longitud</label>
                                    <input type="text" class="form-control" id="txtLong" name="txtLong">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txtEfec">Efectividad</label>
                                    <select class="form-control" id="txtEfec" name="txtEfec" onchange="fntEfectividad(this.value)">
                                        <option value="">Seleccione...</option>
                                        <option value="EFECTIVA">EFECTIVA</option>
                                        <option value="SIN INFORMACION">SIN INFORMACION</option>
                                        <option value="PREDIO DESOCUPADO">PREDIO DESOCUPADO</option>
                                        <option value="PREDIO CERRADO">PREDIO CERRADO</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-primary">Detalles Técnicos</h5>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="txtEstr">Estrato</label>
                                    <input type="text" class="form-control" id="txtEstr" name="txtEstr">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtHabi">Habitantes</label>
                                    <select class="form-control" id="txtHabi" name="txtHabi">
                                        <option value="">Seleccione...</option>
                                        <option value="1">1</option>
                                        <option value="2 A 3">2 A 3</option>
                                        <option value="4 A 5">4 A 5</option>
                                        <option value="6">6</option>
                                        <option value="MAS DE 6">MAS DE 6</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtFrec">Frecuencia</label>
                                    <select class="form-control" id="txtFrec" name="txtFrec"
                                        onchange="fntFrecuencia(this.value)">
                                        <option value="">Seleccione...</option>
                                        <option value="DIARIA">DIARIA</option>
                                        <option value="2 DIAS A LA SEMANA">2 DIAS A LA SEMANA</option>
                                        <option value="UNA VEZ A LA SEMANA">UNA VEZ A LA SEMANA</option>
                                        <option value="QUINCENAL">QUINCENAL</option>
                                        <option value="MENSUAL">MENSUAL</option>
                                        <option value="OTRO">OTRO</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtDefr">Cuál (Otro)</label>
                                    <input type="text" class="form-control" id="txtDefr" name="txtDefr" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="txtAlma">Almacenamiento</label>
                                    <select class="form-control" id="txtAlma" name="txtAlma">
                                        <option value="">Seleccione...</option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="txtTial">Tipo Almacenamiento</label>
                                    <select class="form-control" id="txtTial" name="txtTial"
                                        onchange="fntTipoAlmacenamiento(this.value)">
                                        <option value="">Seleccione...</option>
                                        <option value="ALBERCA SUBTERRANEA">ALBERCA SUBTERRANEA</option>
                                        <option value="TANQUE ELEVADO">TANQUE ELEVADO</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtDeal">Cuál (Otro)</label>
                                    <input type="text" class="form-control" id="txtDeal" name="txtDeal" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="txtLarg">Largo</label>
                                    <input type="number" class="form-control" id="txtLarg" name="txtLarg" step="0.01">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtAnch">Ancho</label>
                                    <input type="number" class="form-control" id="txtAnch" name="txtAnch" step="0.01">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtAlto">Alto</label>
                                    <input type="number" class="form-control" id="txtAlto" name="txtAlto" step="0.01">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtPunt">Puntos Hidráulicos</label>
                                    <input type="number" class="form-control" id="txtPunt" name="txtPunt">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="txtVivi">Tipo Vivienda</label>
                                    <select class="form-control" id="txtVivi" name="txtVivi"
                                        onchange="fntVivienda(this.value)">
                                        <option value="">Seleccione...</option>
                                        <option value="CASA UNIFAMILIAR">CASA UNIFAMILIAR</option>
                                        <option value="APARTAMENTO">APARTAMENTO</option>
                                        <option value="CASA LOTE">CASA LOTE</option>
                                        <option value="MEJORA">MEJORA</option>
                                        <option value="OTRO">OTRO</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtDevi">Cuál (Otro)</label>
                                    <input type="text" class="form-control" id="txtDevi" name="txtDevi" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-primary">Estructura y Zona</h5>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="txtTama">Tamaño (m²)</label>
                                    <input type="number" class="form-control" id="txtTama" name="txtTama" step="0.01">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="txtCuar">Nro. Cuartos</label>
                                    <select class="form-control" id="txtCuar" name="txtCuar">
                                        <option value="">Seleccione...</option>
                                        <option value="UNA">UNA</option>
                                        <option value="DOS">DOS</option>
                                        <option value="TRES">TRES</option>
                                        <option value="MAS DE TRES">MAS DE TRES</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="txtBani">Nro. Baños</label>
                                    <select class="form-control" id="txtBani" name="txtBani">
                                        <option value="">Seleccione...</option>
                                        <option value="UNO">UNO</option>
                                        <option value="DOS">DOS</option>
                                        <option value="TRES">TRES</option>
                                        <option value="MAS DE TRES">MAS DE TRES</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtZona">Tiene Zonas Verdes</label>
                                    <select class="form-control" id="txtZona" name="txtZona"
                                        onchange="fntZonasVerdes(this.value)">
                                        <option value="">Seleccione...</option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="txtFren">Frente (mts)</label>
                                    <input type="number" class="form-control" id="txtFren" name="txtFren" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="txtFond">Fondo (mts)</label>
                                    <input type="number" class="form-control" id="txtFond" name="txtFond" disabled>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="txtUsos">Usos</label>
                                    <select class="form-control" id="txtUsos" name="txtUsos">
                                        <option value="">Seleccione...</option>
                                        <option value="RESIDENCIAL">RESIDENCIAL</option>
                                        <option value="COMERCIAL">COMERCIAL</option>
                                        <option value="INDUSTRIAL">INDUSTRIAL</option>
                                        <option value="INSTITUCIONAL">INSTITUCIONAL</option>
                                        <option value="OTRO">OTRO</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtInst">¿Instalar Medidor?</label>
                                    <select class="form-control" id="txtInst" name="txtInst">
                                        <option value="">Seleccione...</option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="tile-footer text-center p-3">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i
                        class="fa fa-fw fa-lg fa-check-circle"></i><span
                        id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i
                        class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Carga CSV -->
<div class="modal fade" id="modalFormEspecialCSV" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalCSV">Cargar Archivo CSV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEspecialCSV" name="formEspecialCSV" class="form-horizontal">
                    <p class="text-primary">Asegúrese de que el archivo tenga el formato correcto (.csv separado por
                        punto y coma).</p>
                    <div class="form-group">
                        <label class="control-label">Seleccionar Archivo</label>
                        <input class="form-control-file" id="fileCSV" name="fileCSV" type="file" accept=".csv" required>
                    </div>
                    <div class="tile-footer text-center p-3">
                        <button id="btnActionFormCSV" class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                            <span id="btnTextCSV">Subir</span>
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-danger" type="button" data-dismiss="modal">
                            <i class="fa fa-fw fa-lg fa-times-circle"></i> Cerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php footerAdmin($data); ?>