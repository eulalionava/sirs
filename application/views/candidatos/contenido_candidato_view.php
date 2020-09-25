<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Registro de solicitud de empleo</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>solicitud-empleo">Solicitud de empleo</a></li>
                    <li>Continuar trámite</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="tabs-vertical-env tab-nach">
                <ul class="nav tabs-vertical nav-nach">
                    <li class="tab">
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
                        <a href="#contrato" data-toggle="tab" aria-expanded="false"> 
                            <span class="visible-xs"><i class="fa fa-check"></i></span> 
                            <span class="hidden-xs">
                                <i class="fa fa-check"></i>Contrato
                            </span> 
                        </a> 
                    </li>
                </ul>

                <div class="tab-content" style="width: 100%; padding-top: 5px;"> 
                    <div class="tab-pane active" id="info-gral">
                        {informacion_general}
                    </div>
                    <div class="tab-pane" id="cuestionario">
                        {cuestionario}
                    </div>

                    <div class="tab-pane" id="prueba-ortografia">
                        {pruba_ortografia}
                    </div>

                    <div class="tab-pane" id="prueba-typing">
                        {prueba_typing}
                    </div>

                    <div class="tab-pane" id="cargar-documentacion">
                        {cargar_documentacion}
                    </div>

                    <div class="tab-pane" id="agendar-cita">
                        {agendar_cita}
                    </div>

                    <div class="tab-pane" id="entrevista-linea">
                        {entrevista_en_linea}
                    </div>

                    <div class="tab-pane" id="examen-psicometrico">
                        {examen_psicometrico}
                    </div>

                    <div class="tab-pane" id="vo-bo">
                        {vo_bo}
                    </div>

                    <div class="tab-pane" id="contrato">
                        {contrato}
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
