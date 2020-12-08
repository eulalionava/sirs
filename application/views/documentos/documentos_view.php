<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">DOCUMENTOS</h3>
            </div>
            <div class="panel-body">
                <div class="form-group" style="float:right">
                <button class="btn btn-success btnNuevaVacante" data-toggle="modal" data-target="#modalNuevo">
                    <b>Nuevo Documento</b>
                </button>
                </div>
                <?php if(count($documentos) > 0):?>
                <table id="tablaUsuarios" class="table">
                    <thead>
                        <th>DOCUMENTO</th>
                        <th>DESCRIPCION</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach($documentos as $docs):?>
                            <tr>
                                <td><?=$docs->nombre_doc?></td>
                                <td><?=$docs->descripcion?></td>
                                <td>
                                    <div class="input-group">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal<?=$docs->id?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal<?=$docs->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class="fa fa-chevron-right"></i>EDITAR DOCUMENTO </h4> 
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="panel panel-default panel-fill">
                                                        <div class="panel-heading"> 

                                                        </div> 
                                                        <div class="panel-body"> 
                                                            <div class="form-group">
                                                                <label for="">Documento:</label>
                                                                <input type="text" class="form-control txtDocumento<?=$docs->id?>" value="<?=$docs->nombre_doc?>">
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="">Descripcion:</label>
                                                            <textarea class="form-control txtDescripcion<?=$docs->id?>"><?=$docs->descripcion?></textarea>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary btnGuardarCambiosVacante" data-hash="<?=$docs->id?>"><b>Guardar cambios</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!--fin modal-->

                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php else:?>
                    <div class="alert alert-danger">No se encontraron resultados</div>
                <?php endif;?>
                
                <!-- Modal -->
                <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="panel-title"><i class="fa fa-chevron-right"></i>Nuevo Documento</h4> 
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="panel panel-default panel-fill">
                                            <div class="panel-heading"> 
                                                
                                            </div> 
                                            <div class="panel-body"> 
                                                <div class="form-group">
                                                    <label for="">Documento:</label>
                                                    <input type="text" class="form-control txtDocumento" placeholder="Nombre del nuevo documento">
                                                </div>
                                                <div class="form-group">
                                                <label for="">Descripcion:</label>
                                                <textarea class="form-control txtDescripcion" placeholder="Descripcion documento"></textarea>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary btnGuardarNuevoDocumento"><b>Guardar nuevo documento</b></button>
                            </div>
                        </div>
                    </div>
                </div><!--fin modal-->
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/documentos/documentos_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/documentos/documentos_model.min.js" type="text/javascript"></script>
