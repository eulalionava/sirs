<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Agenda de horarios para entrevistas</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    
                    <div class="panel panel-default" id="manual">
                        <div class="panel-heading">
                            <h5 class="title">Manual</h5>
                        </div>

                        <div class="col-md-12 col-sm-12" style="margin-bottom:2rem;margin-top:2rem;">
                            <div class="col-md-2">
                                <input type="radio" name="agenda" value="1" checked class="agendaManual" style="width:20px;height: 20px;">
                                <label for="agenda">Manual</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="agenda" value="2" class="agendaAuto" style="width:20px;height: 20px;">
                                <label for="agenda">Automatico</label>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-4 col-sm-4">
                                <label for="intervalo">Intervalo:</label>
                                <input type="text" class="form-control inter" placeholder="minutos" id="intManual" >
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label for="intervalo">Inicio:</label>
                                <select name="" id="inicioManual" class="form-control">
                                    <option value="9">9:00</option>
                                    <option value="10">10:00</option>
                                    <option value="11">11:00</option>
                                    <option value="12">12:00</option>
                                    <option value="13">13:00</option>
                                    <option value="14">14:00</option>
                                    <option value="15">15:00</option>
                                    <option value="16">16:00</option>
                                    <option value="17">17:00</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label for="intervalo">Fin:</label>
                                <select name="" id="finManual" class="form-control">
                                    <option value="9">9:00</option>
                                    <option value="10">10:00</option>
                                    <option value="11">11:00</option>
                                    <option value="12">12:00</option>
                                    <option value="13">13:00</option>
                                    <option value="14">14:00</option>
                                    <option value="15">15:00</option>
                                    <option value="16">16:00</option>
                                    <option value="17">17:00</option>
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <label for="intervalo">Dias semana</label> 
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <input type="date" class="form-control" id="fechaInicioManual">
                            </div>
                            <div class="col-md-1">
                                <label for="intervalo">Hasta</label>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <input type="date" class="form-control" id="fechaFinManual">
                            </div>
                            <input type="button" class="btn btn-success" value="Aceptar" id="btnManual">

                        </div>
                    </div>

                    <div class="panel panel-default verpanel" style="display:none;">
                        <div class="panel-body">

                            <div style="margin-bottom:10px;">
                                <select name="" id="" class="form-control form-control-lg entrevistador">
                                    <option value="0">Selecciona entrevistador</option>
                                    <?php
                                    foreach($data as $item){
                                        ?>
                                            <option value="<?=$item->id_persona_entidad?>"><?=$item->nombres.' '.$item->apellido_paterno.' '.$item->apellido_materno?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="tablaDinamica">

                            </div>

                        </div>
                    </div>

                    <!-- <div class="col-md-6 ms-6">
                        <div class="form-group">
                            <label for="fecha">Seleccionar fecha:</label>
                            <input type="date" id="btnFecha" class="form-control" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                        </div>
                    </div>
                    <div class="col-md-6 ms-6">
                        <div class="form-group">
                            <label for="fecha">Seleccionar Horario:</label>
                            <select class="form-control" id="selectHorario">
                                <option value="9:00:00">9:00:00</option>
                                <option value="10:00:00">10:00:00</option>
                                <option value="11:00:00">11:00:00</option>
                                <option value="12:00:00">12:00:00</option>
                                <option value="13:00:00">13:00:00</option>
                                <option value="14:00:00">14:00:00</option>
                                <option value="15:00:00">15:00:00</option>
                                <option value="16:00:00">16:00:00</option>
                                <option value="17:00:00">17:00:00</option>
                            </select>
                        </div>
                    </div>
                    <input type="button" class="btn btn-success" id="btnAgendarHorario" value="Agendar horario"> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment.min.js"></script>
<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_model.min.js" type="text/javascript"></script>
