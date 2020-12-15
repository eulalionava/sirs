<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">        
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Documentos que requiere la vacante</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones">Mis postulacinoes</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones/ver-vacantes">Ver vacantes</a></li>
                    <li>Documentación</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="panel panel-border panel-purple">
                    <div class="panel-heading"> 
                        <h3 class="panel-title border-bottom-1px">
                            <i class="fa fa-file-pdf-o"></i> Currículum vitae
                        </h3> 
                    </div>
                    <div class="panel-body">
                        Utiliza este apartado para subir tu currículum vitae, haz clic en "Cargar CV" y elige tu archivo, se aceptan archivos con extensión PDF, .DOC y DOCX.
                    </div>
                </div>                
            </div>
        </div>
        
        <div class="row documentos_candidato">
            <div class="col-md-3 text-center">
                <label class="subir_documento">
                    <div class="panel panel-border panel-purple m-b-0">                            
                        <div class="panel-body text-center">                                        
                            <h2><i class="fa fa-file-pdf-o"></i></h2>
                            <small>Cargar CV</small>
                        </div>
                    </div>
                    <input type="file" name="subir_documento_0" id="subir_documento_0" class="area_cargar_archivo" data-ic="0">
                </label>
                
                <a href="javascript:void(0);" class="btn btn-warning waves-effect waves-light btn-xs m-b-5 ddc" download data-ic="0" id="df_0" target="_blank">Descargar</a>
            </div>
        </div>
        
        <div class="panel panel-border panel-purple">
            <div class="panel-footer text-center">
                <button type="button" class="btn btn-purple btn-custom waves-effect waves-light m-b-5 btn_cargar_documentos" data-la="documentos_candidato" data-idc="0">
                    <i class="fa fa-check-circle"></i> Cargar currículum
                </button>
            </div>
        </div>

        <?php if(strlen(trim($detalle_documentos[0]->solicitud)) > 0): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-border panel-purple">
                        <div class="panel-heading"> 
                            <h3 class="panel-title border-bottom-1px">
                                <i class="fa fa-file-pdf-o"></i> Solicitud de empleo
                            </h3> 
                        </div>
                        <div class="panel-body"> 
                            La empresa contratante requiere que descargues la solicitud de empleo adjunta a esta vacante, la llenes y la subas a este mismo apartado.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row documentos_cliente">
                <div class="col-md-3" >
                    <a href="<?php echo base_url($detalle_documentos[0]->solicitud); ?>" target="_blank">
                        <label class="subir_documento">
                            <div class="panel panel-border panel-purple">                            
                                <div class="panel-body text-center">                                        
                                    <h2><i class="fa fa-download"></i></h2>
                                    <small>Descargar solicitud</small>
                                </div>
                            </div>
                        </label>
                    </a>
                </div>

                <div class="col-md-3 text-center">
                    <label class="subir_documento">
                        <div class="panel panel-border panel-purple m-b-0">                            
                            <div class="panel-body text-center">                                        
                                <h2><i class="fa fa-upload"></i></h2>
                                <small>Cargar solicitud</small>
                            </div>
                        </div>
                        <input type="file" name="subir_solicitud" id="subir_solicitud" class="area_cargar_archivo" data-ic="<?php echo $detalle_documentos[0]->id_cliente; ?>">
                    </label>
                    <a href="javascript:void(0);" class="btn btn-warning waves-effect waves-light btn-xs m-b-5 ddc" data-ic="<?php echo $detalle_documentos[0]->id_cliente; ?>" id="df_-1" target="_blank">Descargar</a>
                </div>
            </div>
            
            <div class="panel panel-border panel-purple">
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-purple btn-custom waves-effect waves-light m-b-5 btn_cargar_documentos" data-la="documentos_cliente" data-idc="0">
                        <i class="fa fa-check-circle"></i> Cargar solicitud
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <?php if(count($detalle_documentos) > 0): ?>            
            <div class="row">
                <div class="col-md-12">
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
                </div>
            </div>
        
            <div class="row documentos_vacante">
                 <?php foreach($detalle_documentos as $documento): ?>
                    <div class="col-md-3 text-center" data-id-documento="<?php echo $documento->id_documento; ?>">
                        <label class="subir_documento">
                            <div class="panel panel-border panel-purple m-b-0">                            
                                <div class="panel-body text-center">                                        
                                    <h2><i class="fa fa-file-picture-o"></i></h2>
                                    <small><?php echo $documento->nombre_doc; ?></small>
                                </div>
                            </div>
                            <input type="file" name="subir_documento_<?php echo $documento->id_documento; ?>" id="subir_documento_<?php echo $documento->id_documento; ?>" data-idc="<?php echo $documento->id_documento; ?>" class="area_cargar_archivo" data-ic="0">
                        </label>
                        <a href="javascript:void(0);" class="btn btn-warning waves-effect waves-light btn-xs m-b-5 ddc">Documento</a>
                    </div>
                <?php endforeach; ?>
            </div>
        
            <div class="panel panel-border panel-purple">
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-purple btn-custom waves-effect waves-light m-b-5 btn_cargar_documentos" data-la="documentos_vacante">
                        <i class="fa fa-check-circle"></i> Cargar documentos
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

<style>
    .m-b-0{
        margin-bottom: 0px !important;
    }
</style>
<link href="<?php echo base_url(); ?>dist/js/candidatos_panel/tabsCandidatos.css" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url(); ?>dist/js/documentos_candidatos/documento_candidato_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/documentos_candidatos/documento_candidato_view.min.js" type="text/javascript"></script>