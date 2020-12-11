<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href="<?php echo base_url(); ?>dist/css/personalizados.css">
<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color:#05274c;">
                <h3 class="panel-title">TIPOS DE ARCHIVO</h3>
            </div>
            <div class="panel-body">
                <div class="form-group" style="float:right">
                    <button class="btn btn-success btnNuevaVacante" data-toggle="modal" data-target="#modalNuevo">
                        <b>Nuevo archivo</b>
                    </button>
                </div>
                <div class="col-md-12 col-sm-12"></div>
                <?php if(count($tipos) > 0):?>
                    <?php foreach($tipos as $tipo):?>
                        <div class="col-md-4 col-md-4">
                            <div class="panel" style="box-shadow: 0px 0px 4px 0px #a7a1a1;">
                                <div class="panel-body">

                                </div>
                                <div class="panel-footer">
                                    <h4><?=$tipo->tipo_archivo?></h4>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else:?>
                    <div class="alert alert-danger">No se encontraron resultados</div>
                <?php endif;?>
                
                <!-- Modal -->
                <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding-bottom:3rem;padding-top: 1rem;">
                                <div class="col-md-10 col-sm-10">
                                    <h4 class="modal-title"><i class="fa fa-chevron-right"></i> NUEVO TIPO DE ARCHIVO</h4> 
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="txtArchivo" placeholder="Nombre tipo de archivo"
                                    style="height: 5rem;border-radius: 10px;border: 2px solid #e2dfdf;color: black;font-size: 15px;font-family: 'FontAwesome';">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary btnGuardarTipoArchivo"><b>Guardar</b></button>
                            </div>
                        </div>
                    </div>
                </div><!--fin modal-->
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/archivos/archivos_panel_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/archivos/archivos_panel_model.min.js" type="text/javascript"></script>
