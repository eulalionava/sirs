<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="tabs-vertical-env tab-nach">
        <ul class="nav tabs-vertical nav-nach">
            <li class="tab active">
                <a href="#info-gral" data-toggle="tab"> 
                    <span class="visible-xs"><i class="fa fa-user"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-user"></i>Información general.
                    </span> 
                </a>
            </li> 
            <li class="tab"> 
                <a href="#cuestionario" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-question-circle"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-question-circle"></i>Cuestionario
                    </span> 
                </a> 
            </li> 
            <li class="tab"> 
                <a href="#prueba-ortografia" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-text-height"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-text-height"></i>Prueba de ortografía
                    </span> 
                </a> 
            </li> 
            <li class="tab"> 
                <a href="#prueba-typing" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-keyboard-o"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-keyboard-o"></i>Prueba de typing
                    </span> 
                </a> 
            </li> 
            <li class="tab"> 
                <a href="#cargar-documentacion" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-file-archive-o"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-file-archive-o"></i>Cargar documentación
                    </span> 
                </a> 
            </li>
            <li class="tab"> 
                <a href="#agendar-cita" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-calendar"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-calendar"></i>Agendar cita
                    </span> 
                </a> 
            </li>
            <li class="tab"> 
                <a href="#entrevista-linea" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-microphone"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-microphone"></i>Entrevista en línea
                    </span> 
                </a> 
            </li>
            <li class="tab"> 
                <a href="#examen-psicometrico" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-cubes"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-cubes"></i>Examen psicométrico
                    </span> 
                </a> 
            </li>            
            <li class="tab"> 
                <a href="#vo-bo" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-check-circle-o"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-check-circle-o"></i>Vo.Bo.
                    </span> 
                </a> 
            </li>
            <li class="tab"> 
                <a href="#contrato)" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-check"></i></span> 
                    <span class="hidden-xs">
                        <i class="fa fa-check"></i>Contrato
                    </span> 
                </a> 
            </li>
        </ul>

        <div class="tab-content" style="width: 100%; padding-top: 5px;"> 
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
                                            <a href="<?php echo base_url(); ?>archivos_generales/SOLICITUD_CC.pdf" target="_blank" class="btn btn-success btn-block">
                                                <i class="fa fa-download"></i> Descargar solicitud
                                            </a>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary btn-block">Subir archivo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div> 
                    
                    <div class="panel-footer">
                        <button type="button" class="btn btn-purple pull-right btnAvanzarProceso">
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
                            <i class="fa fa-question"></i> Resuelve el siguiente cuestionario
                        </h3> 
                    </div> 
                    <div class="panel-body"> 
                        <div class="row">
                            <div class="col-md-12 m-b-15">
                                Contesta sinceramente las siguientes preguntas. Selecciona la respuesta que consideres correcta para ti, al terminar, haz clic en botón <b>Siguiente</b>.
                            </div>
                        </div>
                        
                        <?php echo $extras['cuestionario']; ?>
                    </div> 
                    
                    <div class="panel-footer">
                        <button type="button" class="btn btn-purple pull-right btnAvanzarProceso">
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
                            <i class="fa fa-text-height"></i> Prueba de ortografía
                        </h3> 
                    </div> 
                    <div class="panel-body"> 
                        <div class="row">
                            <div class="col-md-12 m-b-15">
                                En esta prueba se comprobará su ortografía, sintaxis, gramática y estilo de redacción. Ponga atención al audio adjunto y redacte lo que dice el locutor.
                            </div>
                        </div>
                        
                        <form role="form">
                            <div class="container-audio">
                                <audio controls  loop>
                                    <source src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/9473/new_year_dubstep_minimix.ogg" type="audio/ogg">
                                    Your browser dose not Support the audio Tag
                                </audio>
                            </div>
                            <div class="form-group">
                                <label for="nombres">Redacte su respuesta: </label>
                                <textarea class="form-control" rows="7" placeholder="..."></textarea>
                            </div>
                        </form>
                    </div> 
                    
                    <div class="panel-footer">
                        <button type="button" class="btn btn-purple pull-right btnAvanzarProceso">
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
                            <i class="fa fa-keyboard-o"></i> Prueba de typing
                        </h3> 
                    </div> 
                    <div class="panel-body"> 
                        <div class="row">
                            <div class="col-md-12 m-b-15">
                                En esta prueba se comprobará su velocidad para escribir incluyendo su ortografía, sintaxis, gramática y estilo de redacción. Ponga atención al audio adjunto y redacte lo que dice el locutor. El contador iniciará al reproducir el audio adjunto.
                            </div>
                        </div>
                        
                        <form role="form">
                            <div class="container-audio">
                                <audio controls  loop>
                                    <source src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/9473/new_year_dubstep_minimix.ogg" type="audio/ogg">
                                    Your browser dose not Support the audio Tag
                                </audio>
                            </div>
                            <div class="form-group">
                                <label for="nombres">Redacte su respuesta: </label>
                                <textarea class="form-control" rows="7" placeholder="..."></textarea>
                            </div>
                            <small><b>Inicia: </b> 0s</small> / <small><b>Caracteres: </b> 0</small>
                        </form>
                    </div> 
                    
                    <div class="panel-footer">
                        <button type="button" class="btn btn-purple pull-right btnAvanzarProceso">
                            Siguiente
                        </button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane" id="cargar-documentacion">
                Cargar documentación
            </div>
            
            <div class="tab-pane" id="agendar-cita">
                Agendar cita
            </div>
            
            <div class="tab-pane" id="entrevista-linea">
                Entrevista en línea
            </div>
            
            <div class="tab-pane" id="examen-psicometrico">
                Examen psicométrico
            </div>
            
            <div class="tab-pane" id="vo-bo">
                Visto bueno por parte del cliente
            </div>
            
            <div class="tab-pane" id="contrato">
                Contratado
            </div>
        </div>
    </div>
    
</div>

<link href="<?php echo base_url(); ?>dist/js/candidatos_panel/tabsCandidatos.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>dist/css/audio-styles.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>dist/js/candidatos_panel/candidatos_panel_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/candidatos_panel/candidatos_panel_view.min.js" type="text/javascript"></script>
