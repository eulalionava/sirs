<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Agendar entrevista </h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones">Mis postulaciones</a></li>
                    <li>Agendar entrevista</li>
                </ol>
            </div>
        </div>
        
        <?php if(count($data_entrevista) > 0): ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-border panel-success">
                        <div class="panel-heading"> 
                            <h3 class="panel-title border-bottom-1px">
                                <i class="fa fa-check-circle"></i> Entrevista agendada
                            </h3> 
                        </div> 
                        <div class="panel-body">
                            <p><b>Ya tienes una entrevista agendada, los datos son los singuientes:</b></p>
                            <p><b>Cuándo:</b> <?php echo fecha_espanol($data_entrevista[0]->dia_semana, $data_entrevista[0]->dia, $data_entrevista[0]->mes, $data_entrevista[0]->anio); ?></p>
                            <p><b>A qué hora:</b> <?php echo $data_entrevista[0]->hora_entrevista; ?> h</p>
                            <p><b>Detalles:</b>  <?php echo $data_entrevista[0]->descripcion_entrevista; ?></p>
                        </div>
                    </div>                
                </div>
                
                <div class="col-md-4">
                    <div class="panel panel-border panel-success">
                        <div class="panel-heading"> 
                            <h3 class="panel-title border-bottom-1px">
                                <i class="fa fa-user-md"></i> Entrevistador
                            </h3> 
                        </div> 
                        <div class="panel-body">
                            <img src="<?php echo base_url($data_entrevista[0]->ruta_foto); ?>" class="img-responsive center-block img-circle">
                            <p></p>
                            <p><b><?php echo $data_entrevista[0]->entrevistador; ?></b></p>
                            <p><b>Teléfono:</b> <?php echo $data_entrevista[0]->numero_telefono; ?></p>
                            <p><b>E-mail:</b> <?php echo $data_entrevista[0]->correo_electronico; ?></p>
                        </div>
                    </div>                
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-border panel-purple">
                        <div class="panel-heading"> 
                            <h3 class="panel-title border-bottom-1px">
                                <i class="fa fa-calendar"></i> Agendar cita
                            </h3> 
                        </div> 
                        <div class="panel-body">
                            <p><b>Atención: </b> haz clic sobre el recuadro del día en que el podrás asistir a una entrevista, la plataforma te asignará al entrevistador con el horario disponible.</p>
                        </div>
                    </div>                
                </div>
            </div>
        
            <?php if(count($data_horarios) > 0): ?>
                <?php $ls_fecha_diferente = ""; ?>
                <?php foreach($data_horarios as $fecha): ?>
                    <?php if($ls_fecha_diferente <> $fecha->fecha_entrevista): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-border panel-success">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title border-bottom-1px">
                                            <i class="fa fa-calendar-o"></i> <?php echo fecha_espanol($fecha->dia_semana, $fecha->dia, $fecha->mes, $fecha->anio); ?>
                                        </h3> 
                                    </div>
                                </div>                
                            </div>
                        </div>

                        <div class="row">
                            <?php foreach($data_horarios as $horario): ?>
                                <?php if($horario->fecha_entrevista == $fecha->fecha_entrevista): ?>
                                    <div class="col-md-3" class="area_asignar_horario" data-ii="<?php echo $horario->id_entrevista; ?>">
                                        <div class="panel panel-border panel-success asignar_horario">
                                            <div class="panel-body text-center">
                                                <p><i class="fa fa-clock-o"></i></p>
                                                <p><b><?php echo $horario->hora_entrevista; ?> h</b></p>
                                            </div>
                                        </div>                
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>                            
                    <?php endif; ?>
                    <?php $ls_fecha_diferente = $fecha->fecha_entrevista;  ?>
                <?php endforeach; ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-border panel-purple">
                            <div class="panel-footer text-center">
                                <button type="button" class="btn btn-purple btn-custom waves-effect waves-light m-b-5 btn_guardar_entrevista">
                                    <i class="fa fa-check-circle"></i> Guardar información
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">No se encontraron resultados</div>
                    </div>
                </div>                
            <?php endif; ?>
        <?php endif; ?>        
    </div>
</div>
<script src="<?php echo base_url(); ?>dist/js/entrevista_candidato/entrevista_candidato_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/entrevista_candidato/entrevista_candidato_view.min.js" type="text/javascript"></script>

