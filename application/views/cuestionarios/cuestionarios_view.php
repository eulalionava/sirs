<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color:#413c5d;">
                <h3 class="panel-title">CUESTIONARIOS</h3>
            </div>
            <div class="panel-body">
                <div class="form-group" style="float:right">
                <button class="btn btn-success btnNuevaVacante" data-toggle="modal" data-target="#modalNuevo">
                    <b>Nuevo Cuestionario</b>
                </button>
                </div>
                <?php if(count($cuestionarios) > 0):?>
                <table id="tablaUsuarios" class="table">
                    <thead>
                        <th>CLIENTE</th>
                        <th>CUESTIONARIO</th>
                        <th>DESCRIPCION</th>
                        <th>TIPO CUESTIONARIO</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach($cuestionarios as $cuest):?>
                            <tr>
                                <td><?=$cuest->nombre?></td>
                                <td><?=$cuest->titulo_cuestionario?></td>
                                <td><?=$cuest->descripcion_cuestionario?></td>
                                <td><?=$cuest->tipo_cuestionario?></td>
                                <td>
                                    <div class="input-group">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal<?=$cuest->id_cuestionario?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal<?=$cuest->id_cuestionario?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="box-shadow: 0px 5px 5px 2px #191863;padding-bottom:3rem;padding-top: 1rem;">
                                            <div class="col-md-10 col-sm-10">
                                                <h4 class="modal-title"><i class="fa fa-chevron-right"></i> EDITAR CUESTIONARIO </h4> 
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
                                                                <label for="">Cuestionario:</label>
                                                                <input type="text" class="form-control txtCuestionario<?=$cuest->id_cuestionario?>" value="<?=$cuest->titulo_cuestionario?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Descripcion:</label>
                                                                <textarea class="form-control txtDescripcion<?=$cuest->id_cuestionario?>"><?=$cuest->descripcion_cuestionario?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">N. intentos:</label>
                                                                <input type="text" class="form-control txtIntento<?=$cuest->intentos?>" value="<?=$cuest->intentos?>">
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary btnGuardarCambiosCuestionario" data-hash="<?=$cuest->id_cuestionario?>"><b>Guardar cambios</b></button>
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
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="box-shadow: 0px 5px 5px 2px #191863;padding-bottom:3rem;padding-top: 1rem;">
                                <div class="col-md-10 col-sm-10">
                                    <h4 class="modal-title"><i class="fa fa-chevron-right"></i> NUEVO CUESTIONARIO</h4> 
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
                                                    <label for="">Cuestionario:</label>
                                                    <input type="text" class="form-control txtCuestionario" placeholder="Nombre del nuevo documento">
                                                </div>
                                                <div class="form-group">
                                                <label for="">Descripcion:</label>
                                                <textarea rows="10" cols="10" class="form-control txtDescripcion" placeholder="Descripcion documento" style="height: 10rem;"></textarea>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary btnGuardarCuestionario"><b>Guardar nuevo cuestionario</b></button>
                            </div>
                        </div>
                    </div>
                </div><!--fin modal-->
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/cuestionarios/cuestionarios_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/cuestionarios/cuestionario_model.min.js" type="text/javascript"></script>
