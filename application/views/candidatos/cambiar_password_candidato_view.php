<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Modificar datos personales</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>mi-cuenta">Mi cuenta</a></li>
                    <li>Cambiar contraseña</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-border panel-purple">
                    <div class="panel-heading"> 
                        <h3 class="panel-title border-bottom-1px">
                            <i class="fa fa-edit"></i> Modificar contraseña
                        </h3> 
                    </div> 
                    <div class="panel-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pass_anterior">Contraseña anterior: </label>
                                        <input type="password" class="form-control" id="pass_anterior" name="pass_anterior" placeholder="*****">
                                    </div>

                                    <div class="form-group">
                                        <label for="pass_nueva">Contraseña nueva: </label>
                                        <input type="password" class="form-control" id="pass_nueva" name="pass_nueva" placeholder="*****">
                                    </div>

                                    <div class="form-group">
                                        <label for="pass_repetir">Repetir contraseña: </label>
                                        <input type="password" class="form-control" id="pass_repetir" name="pass_repetir" placeholder="*****">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="panel panel-border panel-purple">
                    <div class="panel-footer text-center">
                        <button type="button" class="btn btn-purple btn-custom waves-effect waves-light m-b-5 btn_guardar_cambio_pass">
                            <i class="fa fa-check-circle"></i> Guardar información
                        </button>
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
