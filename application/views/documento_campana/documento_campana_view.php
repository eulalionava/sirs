<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color:#05274c;">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="panel-title">DOCUMENTOS CAMPAÑAS</h3>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btnNuevaVacante" data-toggle="modal" data-target="#modalNuevo">
                            <b>Nueva campaña</b>
                        </button>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Campaña</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($campanias as $campana):?>
                                <tr>
                                    <td><?=$campana->nombre?></td>
                                    <td><?=$campana->campana?></td>
                                    <td><?=$campana->descripcion_campana?></td>
                                    <td>
                                        <button class="btn btn-warning btn_documentos" title="Asignar documentos" data-hash="<?=$campana->id_campana?>">
                                            <i class="fa fa-file"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="box-shadow: 0px 3px 1px 2px #191863;padding-bottom:3rem;padding-top: 1rem;">
                                <div class="col-md-10 col-sm-10">
                                    <h4 class="modal-title"><i class="fa fa-chevron-right"></i> NUEVA CAMPAÑA</h4> 
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="panel panel-default panel-fill">
                                            <div class="panel-body"> 
                                                <div class="form-group">
                                                    <label for="">Cliente:</label>
                                                    <select id="txt_cliente" class="form-control">
                                                    <?php foreach($clientes as $cliente):?>
                                                        <option value="<?=$cliente->id_cliente?>"><?=$cliente->nombre?></option>
                                                    <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Campaña:</label>
                                                    <input type="text" id="txt_campana" class="form-control" placeholder="Nombre de campaña">
                                                </div>
                                                <div class="form-group">
                                                    <label>Descripción:</label>
                                                    <textarea  id="txt_descripcion" class="form-control"></textarea>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary btnGuardarCampana"><b>Guardar</b></button>
                            </div>
                        </div>
                    </div>
                </div><!--fin modal-->
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/documento_campanas/doc_campanias_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/documento_campanas/doc_campanias_model.min.js" type="text/javascript"></script>
