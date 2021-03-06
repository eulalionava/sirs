<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Cuestionarios de la vacante</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones">Mis postulacinoes</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones/ver-vacantes">Ver vacantes</a></li>
                    <li>Cuestionarios vacante</li>
                </ol>
            </div>
        </div>
        <?php if(count($detalle_vacante) > 0): ?>
            <?php 
                $li_id_vacante_diferente = 0; 
                $la_iconsCuestionario = array(
                    "ion-ios7-keypad-outline",
                    "fa fa-text-width",
                    "fa fa-keyboard-o",
                    "fa fa-laptop"
                );
            ?>
            
            <?php foreach($detalle_vacante as $vacante): ?>
                    <?php if($li_id_vacante_diferente <> $vacante->id_vacante): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default panel-fill">
                                    <div class="panel-heading"> 
                                        <h3 class="panel-title"><?php echo $vacante->vacante; ?></h3> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <?php foreach($detalle_vacante as $cuestionario): ?>
                                
                                <?php if($cuestionario->id_vacante == $vacante->id_vacante): ?>
                                    <div class="col-md-4" data-hash="<?php echo md5($cuestionario->id_cuestionario); ?>">
                                        <div class="panel panel-default panel-fill">
                                            <div class="panel-heading text-center"> 
                                                <h3 class="panel-title">
                                                    <i class="<?php echo $la_iconsCuestionario[$cuestionario->id_tipo_cuestionario]; ?>"></i> <?php echo $cuestionario->titulo_cuestionario; ?>
                                                </h3> 
                                            </div>
                                            <div class="panel-body min-scroll">
                                                <p><?php echo $cuestionario->descripcion_cuestionario; ?></p>
                                            </div>
                                            <div class="panel-footer">

                                                <?php if($cuestionario->cantidad_intentos < $cuestionario->intentos): ?>
                                                    <button class="btn btn-purple btn-custom waves-effect waves-light m-b-5 btn_nach_cuestionario" data-hash="<?=$cuestionario->id_vacante_cuestionario?>" data-vt="<?=$vacante->id_vacante?>" data-ct="<?=$vacante->id_cuestionario?>">
                                                        <i class="fa fa-rocket"></i> <span>Contestar</span> 
                                                    </button>
                                                <?php else: ?>
                                                    <div style="margin-bottom:2rem;">
                                                        <strong>Puntos:</strong> <p><?=$cuestionarios[$cuestionario->id_cuestionario]['total']?></p>
                                                        <?php if( ($cuestionarios[$cuestionario->id_cuestionario]['totalpreguntas'] * 100) == $cuestionarios[$cuestionario->id_cuestionario]['total']):?>
                                                            <span class="badge badge-success">Aprovado</span>
                                                        <?php else:?>
                                                            <span class="badge badge-danger">No Aprovado</span>
                                                        <?php endif;?>
                                                    </div>
                                                    <button class="btn btn-success btn-custom waves-effect waves-light m-b-5">
                                                        <i class="fa fa-rocket"></i> <span>Terminado</span> 
                                                    </button>

                                                <?php endif; ?>
                                                <small class="pull-right">
                                                   <b>Intentos: </b> <?php echo (($cuestionario->cantidad_intentos == "")?0:$cuestionario->cantidad_intentos); ?> de <?php echo $cuestionario->intentos; ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>                                    
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>                
                <?php $li_id_vacante_diferente = $vacante->id_vacante; ?>
            <?php endforeach; ?>            
        <?php else: ?>
            <div class="alert alert-danger">
                No se encontraron resultados
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/cuestionarios_vacantes/cuestionario_vacante_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/cuestionarios_vacantes/cuestionario_vacante_view.min.js" type="text/javascript"></script>