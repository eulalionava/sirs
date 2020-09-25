<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Vacantes en proceso de selección</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones">Mis postulacinoes</a></li>
                    <li>Ver vacantes</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <?php if(count($mis_vacantes) > 0): ?>
                <?php foreach($mis_vacantes as $vacante): ?>
                    <div class="list-group no-border">
                        <a href="javascript:void(0);" class="list-group-item" data-hash="<?php echo md5($vacante->id_vacante); ?>" >
                            <div class="row">
                                <div class="col-md-8">                                    
                                    <span class="titulo-vacante text-primary"><?php echo $vacante->vacante; ?></span>
                                    <span class="empresa-vacante"><?php echo $vacante->nombre; ?></span>
                                </div>
                                <div class="col-md-4 text-center">
                                    <button class="btn btn-icon waves-effect waves-light btn-purple m-b-5 btn_nach_detalle" title="Ver vacante"> <i class="fa fa-eye"></i> </button>
                                    
                                    <button class="btn btn-icon waves-effect waves-light btn-success m-b-5 btn_nach_continuar" title="Ver cuestionarios"> <i class="fa fa-question-circle"></i> </button>
                                    
                                    <button class="btn btn-icon waves-effect waves-light btn-warning m-b-5 btn_nach_docs" title="Subir documentación"> <i class="fa fa-upload"></i> </button>                                    
                                </div>                                
                            </div>
                            
                        </a>
                    </div>
                <?php endforeach; ?>                
            <?php else: ?>
                <div class="alert alert-danger">No se encontraron resultados</div>
            <?php endif; ?>            
        </div>        
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/vacantes_candidatos/vacantes_candidatos_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/vacantes_candidatos/vacantes_candidatos_view.min.js" type="text/javascript"></script>
