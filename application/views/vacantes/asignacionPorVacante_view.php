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
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading" style="background-color:#05274c;color:white;border-radius:5px;">
                                    <h4 class="panel-title">Asignar candidato</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <h4>Vacante</h4>
                                        <div class="alert alert-success"><b><?=$vacante?></b></div>
                                    </div>
                                    <div class="form-group">
                                        <h4>Candidato</h4>
                                        <select name="" id="sleCandidato" class="form-control">
                                            <?php foreach($entidades as $item):?>
                                                <option value="<?=$item->id_persona_entidad?>"><?=$item->nombres.' '.$item->apellido_paterno.' '.$item->apellido_materno?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="button" class="btn btn-primary btn-lg asigarCandidato" value="Asiganar vacante" data-hash="<?=$vacante?>" 
                                        style="display: block;width:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default panel-fill">
                                <div class="panel-heading" style="background-color:#05274c;color:white;border-radius:5px;">
                                    <h4 class="panel-title">Asignar cuestionarios</h4>
                                </div>
                                <div class="panel-body">
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