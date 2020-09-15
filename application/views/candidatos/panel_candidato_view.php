<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Hola, <?php echo $this->session->userdata['nombres']; ?> <?php echo $this->session->userdata['apellido_paterno']; ?> <?php echo $this->session->userdata['apellido_materno']; ?>. ¡Bienvenido!</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li>Bienvenido candidato</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url(); ?>dist/js/candidatos_panel/candidatos_panel_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/candidatos_panel/candidatos_panel_view.min.js" type="text/javascript"></script>
