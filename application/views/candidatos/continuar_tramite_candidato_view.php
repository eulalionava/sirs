<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Registro de solicitud de empleo</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>/solicitud-empleo">Solicitud de empleo</a></li>
                    <li>Continuar trámite</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="portlet">
                <div class="portlet-heading portlet-default">
                    <h3 class="portlet-title text-dark">
                        <?php echo $cuestionario_general[0]->vacante; ?>
                    </h3>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default" class="" aria-expanded="false"><i class="ion-minus-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-default" class="panel-collapse collapse" aria-expanded="false" style="">
                    <div class="portlet-body">
                        <?php echo nl2br($cuestionario_general[0]->descripcion_vacante); ?> <br><br>
                        <hr>
                        <b>Salario: </b><?php echo $cuestionario_general[0]->salario_propuesto; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="tabs-vertical-env tab-nach" style="background-color: transparent !important;">
                <ul class="nav tabs-vertical nav-nach">
                    <li class="tab active tab_control">
                        <a href="javascript:void(0);" data-contenido-tab="info-gral"> 
                            <span class="visible-xs"><i class="fa fa-user"></i></span> 
                            <span class="hidden-xs">
                                <i class="fa fa-user"></i>Información general.
                            </span> 
                        </a>
                    </li> 
                    <li class="tab tab_control"> 
                        <a href="javascript:void(0);" data-contenido-tab="cuestionario"> 
                            <span class="visible-xs"><i class="fa fa-question-circle"></i></span> 
                            <span class="hidden-xs">
                                <i class="fa fa-question-circle"></i>Cuestionario
                            </span> 
                        </a> 
                    </li> 
                    <li class="tab tab_control"> 
                        <a href="javascript:void(0);" data-contenido-tab="prueba-ortografia"> 
                            <span class="visible-xs"><i class="fa fa-text-height"></i></span> 
                            <span class="hidden-xs">
                                <i class="fa fa-text-height"></i>Prueba de ortografía
                            </span> 
                        </a> 
                    </li> 
                    <li class="tab tab_control"> 
                        <a href="javascript:void(0);" data-contenido-tab="prueba-typing"> 
                            <span class="visible-xs"><i class="fa fa-keyboard-o"></i></span> 
                            <span class="hidden-xs">
                                <i class="fa fa-keyboard-o"></i>Prueba de typing
                            </span> 
                        </a> 
                    </li> 
                    <li class="tab tab_control"> 
                        <a href="javascript:void(0);" data-contenido-tab="cargar-documentacion"> 
                            <span class="visible-xs"><i class="fa fa-file-archive-o"></i></span> 
                            <span class="hidden-xs">
                                <i class="fa fa-file-archive-o"></i>Cargar documentación
                            </span> 
                        </a> 
                    </li>                    
                </ul>

                <div class="tab-content" style="width: 100%; padding: 0px; background: none; padding-left: 10px;"> 
                    <div class="tab-pane active" id="info-gral">
                        <div class="panel panel-border panel-purple">
                            <div class="panel-heading"> 
                                <h3 class="panel-title border-bottom-1px">
                                    <i class="fa fa-file-pdf-o"></i> Terminar solicitud de empleo
                                </h3> 
                            </div> 
                            <div class="panel-body"> 
                                <div class="row">
                                    <div class="col-md-12 m-b-15">
                                        Aún no se ha llenado la información básica del solicitante, utiliza el siguiente formulario para seguir capturando tus datos generales, al terminar, haz clic en botón <b>Siguiente</b>.
                                    </div>
                                </div>

                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombres">Escriba su nombre: </label>
                                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombre(s)">
                                            </div>

                                            <div class="form-group">
                                                <label for="apellido_paterno">Escriba su apellido paterno: </label>
                                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno">
                                            </div>

                                            <div class="form-group">
                                                <label for="apellido_materno">Escriba su apellido materno: </label>
                                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rfc">Escriba su RFC con homoclave: </label>
                                                <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC">
                                            </div>

                                            <div class="form-group">
                                                <label for="numero_telefono">Teléfono a 10 dígitos: </label>
                                                <input type="text" class="form-control" id="numero_telefono" name="numero_telefono" placeholder="Número telefónico">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="<?php echo base_url($solicitud_cliente); ?>" target="_blank" class="btn btn-success btn-block">
                                                        <i class="fa fa-download"></i> Descargar solicitud
                                                    </a>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="btn btn-primary btn-block">
                                                        <i class="fa fa-upload"></i> Subir solicitud
                                                        <input type="file" name="cargar_solicitud" id="cargar_solicitud" style="display: none;">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">
                                <button type="button" data-ns="cuestionario" data-cs="info-gral" class="btn btn-purple pull-right btnAvanzarProceso">
                                    Siguiente
                                </button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="cuestionario">                        
                        <div class="panel panel-border panel-purple">
                            <div class="panel-heading"> 
                                <h3 class="panel-title border-bottom-1px">
                                    <i class="fa fa-question-circle"></i> <?php echo $cuestionario_general[0]->titulo_cuestionario; ?>
                                </h3> 
                            </div> 
                            <div class="panel-body"> 
                                <?php echo $cuestionario_general[0]->descripcion_cuestionario; ?>
                            </div>
                        </div>
                        
                        <?php if(count($cuestionario_general) > 0): ?>
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
                                                            <?php if($item->id_tipo_archivo == 1): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <img src="<?php echo $item->ruta_archivo; ?>" class="img-responsive">
                                                            <?php elseif($item->id_tipo_archivo == 2): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <video controls>
                                                                    <source src="<?php echo $item->ruta_archivo; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                                                                </video>
                                                            <?php elseif($item->id_tipo_archivo == 3): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <div class="container-audio">
                                                                    <audio controls>
                                                                        <source src="<?php echo $item->ruta_archivo; ?>" type="audio/ogg">
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
                        
                        <div class="panel panel-border panel-purple">
                            <div class="panel-footer">
                                <button type="button" data-ns="prueba-ortografia" data-cs="cuestionario" class="btn btn-purple pull-right btnAvanzarProceso">
                                    Siguiente
                                </button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="prueba-ortografia">
                        <div class="panel panel-border panel-purple">
                            <div class="panel-heading"> 
                                <h3 class="panel-title border-bottom-1px">
                                    <i class="fa fa-text-height"></i> <?php echo $cuestionario_ortografia[0]->titulo_cuestionario; ?>
                                </h3> 
                            </div> 
                            <div class="panel-body"> 
                                <?php echo $cuestionario_ortografia[0]->descripcion_cuestionario; ?>
                            </div>
                        </div>
                        
                        <?php if(count($cuestionario_ortografia) > 0): ?>
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
                                                            <?php if($item->id_tipo_archivo == 1): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <img src="<?php echo $item->ruta_archivo; ?>" class="img-responsive">
                                                            <?php elseif($item->id_tipo_archivo == 2): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <video controls>
                                                                    <source src="<?php echo $item->ruta_archivo; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                                                                </video>
                                                            <?php elseif($item->id_tipo_archivo == 3): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <div class="container-audio">
                                                                    <audio controls>
                                                                        <source src="<?php echo $item->ruta_archivo; ?>" type="audio/ogg">
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
                        <div class="panel panel-border panel-purple">
                            <div class="panel-footer">
                                <button type="button" data-ns="prueba-typing" data-cs="prueba-ortografia" class="btn btn-purple pull-right btnAvanzarProceso">
                                    Siguiente
                                </button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="prueba-typing">
                        <div class="panel panel-border panel-purple">
                            <div class="panel-heading"> 
                                <h3 class="panel-title border-bottom-1px">
                                    <i class="fa fa-keyboard-o"></i> <?php echo $cuestionario_typing[0]->titulo_cuestionario; ?>
                                </h3> 
                            </div> 
                            <div class="panel-body"> 
                                <?php echo $cuestionario_typing[0]->descripcion_cuestionario; ?>
                            </div>
                        </div>
                        
                        <?php if(count($cuestionario_typing) > 0): ?>
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
                                                            <?php if($item->id_tipo_archivo == 1): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <img src="<?php echo $item->ruta_archivo; ?>" class="img-responsive">
                                                            <?php elseif($item->id_tipo_archivo == 2): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <video controls>
                                                                    <source src="<?php echo $item->ruta_archivo; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                                                                </video>
                                                            <?php elseif($item->id_tipo_archivo == 3): ?>
                                                                <b class="text-success"><i class="fa fa-clipboard"></i> Archivo adjunto: </b> <?php echo $item->archivo; ?>
                                                                <div class="container-audio">
                                                                    <audio controls>
                                                                        <source src="<?php echo $item->ruta_archivo; ?>" type="audio/ogg">
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
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" rows="3" data-iq="<?php echo $item->id_pregunta; ?>" placeholder="Redacte su respuesta..."></textarea>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <b>Inicia: </b> <span id="text_inicia_test_<?php echo $respuesta->id_pregunta; ?>">00:00</span><br>
                                                                <b>Finaliza: </b> <span id="text_finaliza_test_<?php echo $respuesta->id_pregunta; ?>">00:00</span><br>
                                                                <b>Tiempo: </b> <span id="text_total_tiempo_test_<?php echo $respuesta->id_pregunta; ?>">00:00</span><br>
                                                                <b>Total dígitos: </b> <span id="text_total_digitios_test_<?php echo $respuesta->id_pregunta; ?>">0</span><br>
                                                            </div>
                                                        </div>
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
                        
                        <div class="panel panel-border panel-purple">
                            <div class="panel-footer">
                                <button type="button" data-ns="cargar-documentacion" data-cs="prueba-typing" class="btn btn-purple pull-right btnAvanzarProceso">
                                    Siguiente
                                </button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="cargar-documentacion">
                        <div class="panel panel-border panel-purple">
                            <div class="panel-heading"> 
                                <h3 class="panel-title border-bottom-1px">
                                    <i class="fa fa-file-zip-o"></i> Cargar documentos
                                </h3> 
                            </div> 
                            <div class="panel-body"> 
                                Haz clic en cada recuadro y seleccione el documento que se te solicita. Se aceptan archivos de imagen como JPG y PNG, documentos PDF, DOC o DOCX y archivos de texto.
                            </div>
                        </div>
                        
                        <div class="row">
                            <?php if(count($solicitar_documentos) > 0): ?>
                                <?php foreach($solicitar_documentos as $documento): ?>
                                    <div class="col-md-3" data-id-documento="<?php echo $documento->id_documento; ?>">
                                        <label class="subir_documento">
                                            <div class="panel panel-border panel-purple">                            
                                                <div class="panel-body text-center">                                        
                                                    <h2><i class="fa fa-file-picture-o"></i></h2>
                                                    <small><?php echo $documento->nombre_doc; ?></small>
                                                </div>
                                            </div>
                                            <input type="file" name="subir_documento_<?php echo $documento->id_documento; ?>" id="subir_documento_<?php echo $documento->id_documento; ?>">
                                        </label>
                                    </div>
                                <?php endforeach; ?>                                
                            <?php else: ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        No se encontraron resultados.
                                    </div>
                                </div>                                
                            <?php endif; ?>                            
                        </div>
                        
                        
                        <div class="panel panel-border panel-purple">
                            <div class="panel-footer">
                                <button type="button" class="btn btn-purple pull-right btnFinalizarProceso">
                                    Finalizar
                                </button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

<link href="<?php echo base_url(); ?>dist/js/candidatos_panel/tabsCandidatos.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>dist/css/audio-styles.css" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url(); ?>dist/js/candidatos_panel/candidatos_panel_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/candidatos_panel/candidatos_panel_view.min.js" type="text/javascript"></script>
