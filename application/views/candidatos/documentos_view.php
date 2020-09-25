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
        <?php if(count($detalle_documentos) > 0): ?>
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
        
            <div class="row">
                <div class="col-md-3" >
                    <label class="subir_documento">
                        <div class="panel panel-border panel-purple">                            
                            <div class="panel-body text-center">                                        
                                <h2><i class="fa fa-download"></i></h2>
                                <small>Descargar solicitud</small>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="col-md-3" >
                    <label class="subir_documento">
                        <div class="panel panel-border panel-purple">                            
                            <div class="panel-body text-center">                                        
                                <h2><i class="fa fa-upload"></i></h2>
                                <small>Cargar solicitud</small>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        
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
        
            <div class="row">
                 <?php foreach($detalle_documentos as $documento): ?>
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
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                No se encontraron resultados
            </div>
        <?php endif; ?>
    </div>
</div>

<link href="<?php echo base_url(); ?>dist/js/candidatos_panel/tabsCandidatos.css" rel="stylesheet" type="text/css"/>