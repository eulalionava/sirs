<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Nueva Vacante</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>catalogo-general/ver-vacantes">Vacantes</a></li>
                    <li>Nueva vacante</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading"> 
                        <h3 class="panel-title"><i class="fa fa-chevron-right"></i></h3> 
                    </div> 
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="vacante">Campaña:</label>
                                <select name="" id="selCampania" class="form-control">
                                    <?php foreach($campañas as $camp):?>
                                        <option value="<?=$camp->id_campana?>"><?=$camp->campana?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="vacante">Lugar:</label>
                                <input type="text" id="txtLugar" class="form-control" placeholder="Lugar de la vacante">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="vacante">Solicita:</label>
                                <input type="text" id="txtVacante" class="form-control" placeholder="Nombre de vacante">
                            </div>
                            <div class="col-md-6">
                                <label for="vacante">Salario:</label>
                                <input type="text" id="txtSalario" class="form-control" placeholder="Salario">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vacante">Funciones:</label>
                            <input type="text" class="form-control" id="txtFunciones" placeholder="Escribe las funciones" style="margin-bottom:1rem;">
                            <input type="button" class="btn btn-primary btn-sm" id="btnFunciones" value="agregar">
                        </div>   
                        <div class="form-group">
                            <label for="vacante">Requisitos:</label>
                            <input type="text" class="form-control" id="txtRequisitos" placeholder="Escribe los requisitos" style="margin-bottom:1rem;">
                            <input type="button" class="btn btn-primary btn-sm" id="btnRequisitos" value="agregar">
                        </div>  
                        <div class="form-group">
                            <label for="vacante">Ofrecemos:</label>
                            <input type="text" class="form-control" id="txtOfrecemos" placeholder="Ofrecemos" style="margin-bottom:1rem;">
                            <input type="button" class="btn btn-primary btn-sm" id="btnOfrecemos" value="agregar">
                        </div>        
                    </div> 
                    <div class="panel-footer">
                        <button class="btn btn-success btnFinalizarVacante">
                            Finalizar vacante
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading"> 
                        <h3 class="panel-title"><i class="fa fa-bank"></i> Tu nueva vacante</h3> 
                    </div> 
                    <div class="panel-body">
                       <div class="contenidoF"></div>
                       <hr>
                       <div class="contenidoR"></div>
                       <hr>
                       <div class="contenidoO"></div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>