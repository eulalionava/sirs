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
                    <li>Mis datos personales</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-border panel-purple">
                    <div class="panel-heading"> 
                        <h3 class="panel-title border-bottom-1px">
                            <i class="fa fa-edit"></i> Modificar datos personales
                        </h3> 
                    </div> 
                    <div class="panel-body">
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
                                    
                                    <div class="form-group">
                                        <label for="genero_sexual">Género sexual: </label>
                                        <select class="form-control" id="genero_sexual" name="genero_sexual">
                                            <option value="0">Sin definir</option>
                                            <option value="1">Mujer</option>
                                            <option value="2">Hombre</option>
                                            <option value="3">Otro</option>
                                        </select>
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
                                    
                                    <div class="form-group">
                                        <label for="correo_electronico">Correo electrónico: </label>
                                        <input type="text" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="Correo electrónico">
                                    </div>
                                    
                                    <label class="btn btn-primary btn-block">
                                        <i class="fa fa-refresh"></i> Cambiar foto
                                        <input type="file" name="cargar_foto" id="cargar_foto" style="display: none;">
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="panel panel-border panel-purple">
                    <div class="panel-footer text-center">
                        <button type="button" class="btn btn-purple btn-custom waves-effect waves-light m-b-5 btn_guardar_datos_personales">
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
