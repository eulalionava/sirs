<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Vacantes</h3>
            </div>
            <div class="panel-body">
                <div class="form-group" style="float:right">
                <button class="btn btn-success btnNuevaVacante">
                    <b>Nueva Vacante</b>
                </button>
                </div>
                <?php if(count($vacantes) > 0):?>
                <table id="tablaUsuarios" class="table">
                    <thead>
                        <th>Vacante</th>
                        <th>Cliente</th>
                        <th>Campaña</th>
                        <th>Salario</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach($vacantes as $vacante):?>
                            <tr>
                                <td><?=$vacante->vacante?></td>
                                <td><?=$vacante->nombre?></td>
                                <td><?=$vacante->campana?></td>
                                <td><?=$vacante->salario_propuesto?></td>
                                <td>
                                    <div class="input-group">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal<?=$vacante->id_vacante?>">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?=$vacante->id_vacante?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btnDeleteVacante" data-hash="<?=$vacante->id_vacante?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-secondary btnAsignarVacante" data-hash="<?=$vacante->id_vacante?>" data-vac="<?=$vacante->vacante?>">
                                            <i class="fa fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal<?=$vacante->id_vacante?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Información vacante</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="panel panel-default panel-fill">
                                                        <div class="panel-heading"> 
                                                            <h3 class="panel-title"><i class="fa fa-chevron-right"></i>  <?php echo $vacante->vacante; ?></h3> 
                                                        </div> 
                                                        <div class="panel-body"> 
                                                            <?php echo nl2br($vacante->descripcion_vacante); ?>
                                                        </div> 
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="panel panel-default panel-fill">
                                                        <div class="panel-heading"> 
                                                            <h3 class="panel-title"><i class="fa fa-bank"></i> Acerca de la empresa</h3> 
                                                        </div> 
                                                        <div class="panel-body">
                                                            <img src="<?php echo base_url($vacante->logo); ?>" class="img-responsive center-block">
                                                            <h5><?php echo $vacante->nombre; ?></h5>
                                                            <p><?php echo $vacante->descripcion_cliente; ?></p>
                                                        </div> 
                                                    </div>
                                                    
                                                    <div class="panel panel-default panel-fill">
                                                        <div class="panel-heading"> 
                                                            <h3 class="panel-title"><i class="fa fa-info-circle"></i> Datos vacante</h3> 
                                                        </div> 
                                                        <div class="panel-body">
                                                            <h5>Salario:</h5>
                                                            <p>$<?php echo number_format($vacante->salario_propuesto,2); ?></p>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--fin modal-->

                            <!-- Modal -->
                            <div class="modal fade" id="modalEdit<?=$vacante->id_vacante?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel">Editar vacante</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form name="formulario">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="vacante">Vacante:</label>
                                                            <input type="text" name="vacante" class="form-control editVacante<?=$vacante->id_vacante?>" placeholder="Vacante" 
                                                            value="<?=$vacante->vacante?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <label for="descripcion">Descripcion:</label>
                                                        <div class="form-group">
                                                            <textarea name="salario" cols="30" rows="10" class="form-control editDescripcion<?=$vacante->id_vacante?>"><?=$vacante->descripcion_vacante?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="salario">Salario:</label>
                                                            <input type="text" name="salario" class="form-control editSalario<?=$vacante->id_vacante?>" placeholder="Sueldo salarial" 
                                                            value="<?=$vacante->salario_propuesto?>"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary btnGuardarCambiosVacante" data-hash="<?=$vacante->id_vacante?>"><b>Guardar cambios</b></button>
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

            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/catalogos/catalogos_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/catalogos/catalogos_model.min.js" type="text/javascript"></script>
