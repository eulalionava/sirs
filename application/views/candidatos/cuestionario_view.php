<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Contestar cuestionario</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones">Mis postulacinoes</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones/ver-vacantes">Ver vacantes</a></li>
                    <li>Contestar cuestionario</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <?php if(count($detalle_cuestionario) > 0): ?>
                    <div class="panel panel-border panel-purple">
                        <div class="panel-heading"> 
                            <h3 class="panel-title border-bottom-1px">
                                <i class="fa fa-question-circle"></i> <?php echo $detalle_cuestionario[0]->titulo_cuestionario; ?>
                            </h3> 
                        </div> 
                        <div class="panel-body"> 
                            <?php echo $detalle_cuestionario[0]->descripcion_cuestionario; ?>
                        </div>
                    </div>
                    <?php if($detalle_cuestionario[0]->id_tipo_cuestionario == 0 OR $detalle_cuestionario[0]->id_tipo_cuestionario == 3): ?>
                        <?php 
                        /*Conocimientos generales*/
                        $cuestionario_general = $detalle_cuestionario;
                        if(count($cuestionario_general) > 0): ?>
                            <?php $li_id_pregunta_diferente = 0; $li_index = 1;?>
                            <?php foreach($cuestionario_general as $item): ?>
                                <?php if($li_id_pregunta_diferente <> $item->id_pregunta): ?>
                                    <div class="panel panel-border panel-purple">                            
                                        <div class="panel-body panel-nach-pregunta" data-tq="<?php echo $item->tipo_pregunta; ?>" data-iq="<?php echo $item->id_pregunta; ?>"> 
                                            <h5><?php echo $li_index.'. '.$item->pregunta; ?> </h5>
                                            <?php if(strlen(trim($item->indicaciones)) > 0): ?>
                                                <blockquote>
                                                    <small>
                                                        <?php echo $item->indicaciones; ?>
                                                        <?php if(strlen(trim($item->archivo)) > 0): ?>
                                                            <hr>
                                                            <?php if($item->id_tipo_archivo == 0): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <img src="<?php echo base_url($item->ruta_archivo); ?>" class="img-responsive">
                                                            <?php elseif($item->id_tipo_archivo == 1): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <video controls>
                                                                    <source src="<?php echo base_url($item->ruta_archivo); ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                                                                </video>
                                                            <?php elseif($item->id_tipo_archivo == 2): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <div class="container-audio">
                                                                    <audio controls>
                                                                        <source src="<?php echo base_url($item->ruta_archivo); ?>" type="audio/ogg">
                                                                        Your browser dose not Support the audio Tag
                                                                    </audio>
                                                                </div>
                                                            <?php else: ?>
                                                                <a href="<?php echo $item->ruta_archivo; ?>" target="_blank">
                                                                    <b class="text-success"><i class="fa fa-globe"></i> Abrir enlace </b>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </small>
                                                </blockquote>                                            
                                            <?php endif; ?>

                                            <?php foreach($cuestionario_general as $respuesta): ?>
                                                <?php if($respuesta->id_pregunta == $item->id_pregunta): ?>
                                                    <?php if($item->tipo_pregunta == 1): ?>
                                                        <textarea class="form-control" rows="3" data-iq="<?php echo $item->id_pregunta; ?>" placeholder="Redacte su respuesta..."></textarea>
                                                    <?php elseif($item->tipo_pregunta == 2): ?>
                                                        <div class="radio radio-primary m-b-10">
                                                            <input type="radio" id="respuesta_<?php echo $respuesta->id_clave; ?>" data-iq="<?php echo $item->id_pregunta; ?>" value="<?php echo $respuesta->id_clave; ?>" name="respuesta_<?php echo $respuesta->id_pregunta; ?>">
                                                            <label for="respuesta_<?php echo $respuesta->id_clave; ?>"> <?php echo $respuesta->opcion; ?> </label>
                                                        </div>
                                                    <?php elseif($item->tipo_pregunta == 3): ?>
                                                        <div class="checkbox checkbox-primary m-b-10">
                                                            <input type="checkbox" id="respuesta_<?php echo $respuesta->id_clave; ?>" data-iq="<?php echo $item->id_pregunta; ?>" value="<?php echo $respuesta->id_clave; ?>" name="respuesta_<?php echo $respuesta->id_pregunta; ?>">
                                                            <label for="respuesta_<?php echo $respuesta->id_clave; ?>"> <?php echo $respuesta->opcion; ?> </label>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php $li_index++; ?>
                                <?php endif; ?>

                                <?php $li_id_pregunta_diferente = $item->id_pregunta;?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-danger">
                                No se encontraron resultados.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if($detalle_cuestionario[0]->id_tipo_cuestionario == 1): ?>
                        <?php 
                            $cuestionario_ortografia = $detalle_cuestionario;
                            if(count($cuestionario_ortografia) > 0): ?>
                            <?php $li_id_pregunta_diferente = 0; $li_index = 1;?>
                            <?php foreach($cuestionario_ortografia as $item): ?>
                                <?php if($li_id_pregunta_diferente <> $item->id_pregunta): ?>
                                    <div class="panel panel-border panel-purple">                            
                                        <div class="panel-body panel-nach-pregunta-ortografia" data-tq="<?php echo $item->tipo_pregunta; ?>" data-iq="<?php echo $item->id_pregunta; ?>"> 
                                            <h5><?php echo $li_index.'. '.$item->pregunta; ?> </h5>
                                            <?php if(strlen(trim($item->indicaciones)) > 0): ?>
                                                <blockquote>
                                                    <small>
                                                        <?php echo $item->indicaciones; ?>
                                                        <?php if(strlen(trim($item->archivo)) > 0): ?>
                                                            <hr>
                                                            <?php if($item->id_tipo_archivo == 0): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <img src="<?php echo base_url($item->ruta_archivo); ?>" class="img-responsive">
                                                            <?php elseif($item->id_tipo_archivo == 1): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <video controls>
                                                                    <source src="<?php echo base_url($item->ruta_archivo); ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                                                                </video>
                                                            <?php elseif($item->id_tipo_archivo == 2): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <div class="container-audio">
                                                                    <audio controls>
                                                                        <source src="<?php echo base_url($item->ruta_archivo); ?>" type="audio/ogg">
                                                                        Your browser dose not Support the audio Tag
                                                                    </audio>
                                                                </div>
                                                            <?php else: ?>
                                                                <a href="<?php echo $item->ruta_archivo; ?>" target="_blank">
                                                                    <b class="text-success"><i class="fa fa-globe"></i> Abrir enlace </b>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </small>
                                                </blockquote>                                            
                                            <?php endif; ?>
                                            
                                            <?php foreach($cuestionario_ortografia as $respuesta): ?>
                                                <?php if($respuesta->id_pregunta == $item->id_pregunta): ?>
                                                    <?php if($item->tipo_pregunta == 1): ?>
                                                        <textarea class="form-control" rows="3" data-iq="<?php echo $item->id_pregunta; ?>" placeholder="Redacte su respuesta..."></textarea>
                                                    <?php elseif($item->tipo_pregunta == 2): ?>
                                                        <div class="radio radio-primary m-b-10">
                                                            <input type="radio" id="respuesta_<?php echo $respuesta->id_clave; ?>" data-iq="<?php echo $item->id_pregunta; ?>" value="<?php echo $respuesta->id_clave; ?>" name="respuesta_<?php echo $respuesta->id_pregunta; ?>">
                                                            <label for="respuesta_<?php echo $respuesta->id_clave; ?>"> <?php echo $respuesta->opcion; ?> </label>
                                                        </div>
                                                    <?php elseif($item->tipo_pregunta == 3): ?>
                                                        <div class="checkbox checkbox-primary m-b-10">
                                                            <input type="checkbox" id="respuesta_<?php echo $respuesta->id_clave; ?>" data-iq="<?php echo $item->id_pregunta; ?>" value="<?php echo $respuesta->id_clave; ?>" name="respuesta_<?php echo $respuesta->id_pregunta; ?>">
                                                            <label for="respuesta_<?php echo $respuesta->id_clave; ?>"> <?php echo $respuesta->opcion; ?> </label>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php $li_index++; ?>
                                <?php endif; ?>

                                <?php $li_id_pregunta_diferente = $item->id_pregunta;?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-danger">
                                No se encontraron resultados.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if($detalle_cuestionario[0]->id_tipo_cuestionario == 2): ?>
                        <?php
                            $cuestionario_typing = $detalle_cuestionario;
                            if(count($cuestionario_typing) > 0): ?>
                            <?php $li_id_pregunta_diferente = 0; $li_index = 1;?>
                            <?php foreach($cuestionario_typing as $item): ?>
                                <?php if($li_id_pregunta_diferente <> $item->id_pregunta): ?>
                                    <div class="panel panel-border panel-purple">                            
                                        <div class="panel-body panel-nach-pregunta-typing" data-tq="<?php echo $item->tipo_pregunta; ?>" data-iq="<?php echo $item->id_pregunta; ?>"> 
                                            <h5><?php echo $li_index.'. '.$item->pregunta; ?> </h5>
                                            <?php if(strlen(trim($item->indicaciones)) > 0): ?>
                                                <blockquote>
                                                    <small>
                                                        <?php echo $item->indicaciones; ?>
                                                        <?php if(strlen(trim($item->archivo)) > 0): ?>
                                                            <hr>
                                                            <?php if($item->id_tipo_archivo == 0): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <img src="<?php echo base_url($item->ruta_archivo); ?>" class="img-responsive">
                                                            <?php elseif($item->id_tipo_archivo == 1): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <video controls>
                                                                    <source src="<?php echo base_url($item->ruta_archivo); ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                                                                </video>
                                                            <?php elseif($item->id_tipo_archivo == 2): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <div class="container-audio">
                                                                    <audio controls class="audio_typing" data-iq="<?php echo $item->id_pregunta; ?>">
                                                                        <source src="<?php echo base_url($item->ruta_archivo); ?>" type="audio/ogg">
                                                                        Your browser dose not Support the audio Tag
                                                                    </audio>
                                                                </div>
                                                            <?php else: ?>
                                                                <a href="<?php echo $item->ruta_archivo; ?>" target="_blank">
                                                                    <b class="text-success"><i class="fa fa-globe"></i> Abrir enlace </b>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </small>
                                                </blockquote>                                            
                                            <?php endif; ?>
                                            
                                            <?php foreach($cuestionario_typing as $respuesta): ?>
                                                <?php if($respuesta->id_pregunta == $item->id_pregunta): ?>
                                                    <?php if($item->tipo_pregunta == 1): ?>
                                                        <?php if($item->id_tipo_archivo == 2): ?>
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <textarea class="form-control form_control_typing" rows="3" id="a<?php echo $item->id_pregunta; ?>" disabled data-iq="<?php echo $item->id_pregunta; ?>" placeholder="Redacte su respuesta..."></textarea>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <b>Inicia: </b> <span id="text_inicia_test_<?php echo $respuesta->id_pregunta; ?>">00:00:00</span><br>
                                                                    <b>Finaliza: </b> <span id="text_finaliza_test_<?php echo $respuesta->id_pregunta; ?>">00:00:00</span><br>
                                                                    <b>Tiempo: </b> <span id="text_total_tiempo_test_<?php echo $respuesta->id_pregunta; ?>">0s</span><br>
                                                                    <b>Total dígitos: </b> <span id="text_total_digitios_test_<?php echo $respuesta->id_pregunta; ?>">0</span><br>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea class="form-control" rows="3" id="a<?php echo $item->id_pregunta; ?>"  data-iq="<?php echo $item->id_pregunta; ?>" placeholder="Redacte su respuesta..."></textarea>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php elseif($item->tipo_pregunta == 2): ?>
                                                        <div class="radio radio-primary m-b-10">
                                                            <input type="radio" id="respuesta_<?php echo $respuesta->id_clave; ?>" data-iq="<?php echo $item->id_pregunta; ?>" value="<?php echo $respuesta->id_clave; ?>" name="respuesta_<?php echo $respuesta->id_pregunta; ?>">
                                                            <label for="respuesta_<?php echo $respuesta->id_clave; ?>"> <?php echo $respuesta->opcion; ?> </label>
                                                        </div>
                                                    <?php elseif($item->tipo_pregunta == 3): ?>
                                                        <div class="checkbox checkbox-primary m-b-10">
                                                            <input type="checkbox" id="respuesta_<?php echo $respuesta->id_clave; ?>" data-iq="<?php echo $item->id_pregunta; ?>" value="<?php echo $respuesta->id_clave; ?>" name="respuesta_<?php echo $respuesta->id_pregunta; ?>">
                                                            <label for="respuesta_<?php echo $respuesta->id_clave; ?>"> <?php echo $respuesta->opcion; ?> </label>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php $li_index++; ?>
                                <?php endif; ?>

                                <?php $li_id_pregunta_diferente = $item->id_pregunta;?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-danger">
                                No se encontraron resultados.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="panel panel-border panel-purple">
                        <div class="panel-footer text-center">
                            <button type="button" data-tqy="<?php echo $detalle_cuestionario[0]->id_tipo_cuestionario;?>" class="btn btn-purple btn-custom waves-effect waves-light m-b-5 btn_finalizar_cuestionario">
                                <i class="fa fa-check-circle"></i> Finalizar cuestionario
                            </button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        No se encontraron resultados
                    </div>
                <?php endif; ?>                
            </div>            
        </div>
    </div>
</div>
<link href="<?php echo base_url(); ?>dist/js/candidatos_panel/tabsCandidatos.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>dist/css/audio-styles.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>dist/js/candidatos_panel/candidatos_panel_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/candidatos_panel/candidatos_panel_view.min.js" type="text/javascript"></script>
