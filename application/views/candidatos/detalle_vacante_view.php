<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Detalle de la vacante</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>/mis-postulaciones">Mis postulacinoes</a></li>
                    <li><a href="<?php echo base_url(); ?>/mis-postulaciones/ver-vacantes">Ver vacantes</a></li>
                    <li>Detalle vacante</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading"> 
                        <h3 class="panel-title"><?php echo $detalle_vacante[0]->vacante; ?></h3> 
                    </div> 
                    <div class="panel-body"> 
                        <?php echo nl2br($detalle_vacante[0]->descripcion_vacante); ?>
                    </div> 
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Acerca de la empresa</h3> 
                    </div> 
                    <div class="panel-body">
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>