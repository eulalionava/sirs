<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                        <li><a href="<?php echo base_url(); ?>mis-candidatos/ver-candidatos">Candidatos</a></li>
                        <li>Mis postulaciones</li>
                    </ol>
                </div>
            </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Mis postulaciones</h3>
            </div>
            <div class="panel-body">
                <?php if( count($vacantes) > 0 ):?>
                    <?php foreach($vacantes as $vacante):?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h4 class="panel-title"><?=$vacante->vacante?></h4>
                                        <p><?=$vacante->nombre?></p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="button-group">
                                            <button class="btn btn-success btnSeguimientoVacante" title="Dar seguimiento" data-hash="<?=$vacante->id_persona_vacante?>">
                                                <i class='fa fa-check'></i>
                                            </button>
                                            <button class="btn btn-primary btn-validar-cuestionario" title="Cuestionarios" data-hash="<?=$vacante->id_vacante?>" 
                                            data-us="<?=$vacante->id_persona_entidad?>">
                                                <i class="fa fa-question-circle"></i>
                                            </button>

                                            <button class="btn btn-warning btn-validar-documentos" title="Documentos" data-hash="<?=$vacante->id_vacante?>" data-us="<?=$vacante->id_persona_entidad?>">
                                                <i class="fa fa-file"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach;?>
                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="labelTitle">Cuestionarios</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="info_model">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        No se encontraron resultados
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_model.min.js" type="text/javascript"></script>
