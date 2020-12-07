<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h4 class="pull-left page-title"></h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>catalogo-general/ver-vacantes">Vacantes</a></li>
                    <li>Asignaciones</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel panel-default panel-fill" style="box-shadow: 0px -2px 0px 0px #05274c;">
                    <div class="panel-heading"> 
                        <h3 class="panel-title"><i class="fa fa-chevron-right"></i>Asignaciones por vacante</h3> 
                    </div> 
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="panel panel-default panel-fill">
                                <div class="panel-heading" style="background-color:#05274c;color:white;border-radius:5px;">
                                    <h4 class="panel-title">Asignar cuestionarios</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="cliente">Cliente:</label>
                                        <select name="" class="form-control txtCliente">
                                            <option value="0">Selecciona cliente</option>
                                            <?php foreach($clientes as $cliente):?>
                                                <option value="<?=$cliente->id_cliente?>"><?=$cliente->nombre?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <label for="cuestuionarios" style="margin-top: 2rem;margin-bottom: 2rem;">Cuestionarios:</label>
                                    <div class="form-group" id="tipo_cuestionarios">

                                    </div>
                                    <div class="col-md-12 col-sm-12" style="margin-bottom:2rem;"></div>
                                    <div class="form-group">
                                        <input type="button" value="Asigar cuestionarios" class="btn btn-primary asignandoCuestionario" data-hash="<?=$id_vacante?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="panel-footer">

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>