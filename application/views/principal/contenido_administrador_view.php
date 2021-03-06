<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Hola, <?php echo $this->session->userdata['nombres']; ?> <?php echo $this->session->userdata['apellido_paterno']; ?> <?php echo $this->session->userdata['apellido_materno']; ?>. ¡Bienvenido!</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li>Bienvenido administrador</li>
                </ol>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title text-warning">Solo el administrador puede ver este contenido</h4>        
            </div>
        </div>
    </div>
</div>