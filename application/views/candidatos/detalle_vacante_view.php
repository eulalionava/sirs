<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Detalle de la vacante</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones">Mis postulacinoes</a></li>
                    <li><a href="<?php echo base_url(); ?>mis-postulaciones/ver-vacantes">Ver vacantes</a></li>
                    <li>Detalle vacante</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading"> 
                        <h3 class="panel-title"><i class="fa fa-chevron-right"></i>  <?php echo $detalle_vacante[0]->vacante; ?></h3> 
                    </div> 
                    <div class="panel-body"> 
                        <?php echo nl2br($detalle_vacante[0]->descripcion_vacante); ?>
                    </div> 
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading"> 
                        <h3 class="panel-title"><i class="fa fa-bank"></i> Acerca de la empresa</h3> 
                    </div> 
                    <div class="panel-body">
                        <img src="<?php echo base_url($detalle_vacante[0]->logo); ?>" class="img-responsive center-block">
                        <h5><?php echo $detalle_vacante[0]->nombre; ?></h5>
                        <p><?php echo $detalle_vacante[0]->descripcion_cliente; ?></p>
                    </div> 
                </div>
                
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading"> 
                        <h3 class="panel-title"><i class="fa fa-info-circle"></i> Datos vacante</h3> 
                    </div> 
                    <div class="panel-body">
                        <h5>Salario:</h5>
                        <p>$<?php echo number_format($detalle_vacante[0]->salario_propuesto,2); ?></p>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>