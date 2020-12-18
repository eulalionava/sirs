<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color:#05274c;">
                <h3 class="panel-title">Administracion Usuarios</h3>
            </div>
            <div class="panel-body">
                <div class="form-group" style="float:right">
                    <button class="btn btn-primary btnAsignarDocs">
                        <b>Asignar vacante</b>
                    </button>
                <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    <b>Nuevo usuario</b>
                </button>
                </div>
                <?php if(count($data) > 0):?>
                    <div class="col-md-12 table-responsive">
                        <table id="tablaUsuarios" class="table">
                            <thead>
                                <th>NOMBRE</th>
                                <th>RFC</th>
                                <th>CORREO</th>
                                <th>SEXO</th>
                                <th>TELEFONO</th>
                                <th>FECHA ALTA</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php foreach($data as $item):?>
                                    <tr>
                                        <td><?=$item->nombres.' '.$item->apellido_paterno.' '.$item->apellido_materno?></td>
                                        <td><?=$item->rfc?></td>
                                        <td><?=$item->correo_electronico?></td>
                                        <?php if($item->genero_sexual == 1):?>
                                        <td>Femenino</td>
                                        <?php else:?>
                                        <td>Masculino</td>
                                        <?php endif;?>
                                        <td><?=$item->numero_telefono?></td>
                                        <td><?=$item->fecha_alta?></td>
                                        <td>
                                            <div class="input-group">
                                                <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal<?=$item->id_persona_entidad?>">
                                                    <i class="fa fa-eye"></i>
                                                </button> -->
                                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalEdit<?=$item->id_persona_entidad?>">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm btnDeleteUsuario" data-hash="<?=$item->id_persona_entidad?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
        
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal<?=$item->id_persona_entidad?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content ">
                                            <div class="modal-header" style="box-shadow: 0px 5px 5px 2px #191863;padding-bottom:3rem;padding-top: 1rem;">
                                                <div class="col-md-10 col-sm-10">
                                                    <h5 class="modal-title" id="exampleModalLabel">Información usuario</h5>
                                                </div>
                                                <div class="col-md-2 col-sm-2">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <form name="formulario">
                                                            <div class="col-md-12">
                                                                <label for="">Datos personales</label>
                                                            </div>
                                                            <hr>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" style="    border: 1px solid #d8d0d0;background-color: #fbf8f8;border-bottom-width: thick;border-bottom-color: #1a52b9;" 
                                                                    value="<?=$item->nombres.' '.$item->apellido_paterno.' '.$item->apellido_materno?>"  disabled/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" value="<?=$item->rfc?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" value="<?=$item->correo_electronico?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" value="<?=($item->nombres==1)?'Masculino':'Femenino'?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" value="<?=$item->numero_telefono?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" value="<?=$item->fecha_alta?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="">Tipo de acceso</label>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="form-group">
                                                                    <?php if($item->tipo_persona_entidad == 1):?>
                                                                        <input type="text" class="form-control" value="Administrador" disabled>
                                                                    <?php elseif($item->tipo_persona_entidad == 2):?>
                                                                        <input type="text" class="form-control" value="Reclutador" disabled>
                                                                    <?php elseif($item->tipo_persona_entidad == 3):?>
                                                                        <input type="text" class="form-control" value="Seleccionador" disabled>
                                                                    <?php elseif($item->tipo_persona_entidad == 4):?>
                                                                        <input type="text" class="form-control" value="Cliente" disabled>
                                                                    <?php else: ?>
                                                                        <input type="text" class="form-control" value="Candidato" disabled>
                                                                    <?php endif;?>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
        
                                                    <div class="col-md-6">
                                                        <div class="panel">
                                                            <div class="panel-heading">
                                                            <img src="<?php echo base_url(); ?>dist/images/avatar-1.jpg" style="display:block;width:100%">
                                                            <h4 style="text-align: center;">
                                                                <?=$item->nombres.' '.$item->apellido_paterno.' '.$item->apellido_materno?>
                                                            </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div><!--fin modal-->
        
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalEdit<?=$item->id_persona_entidad?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header" style="box-shadow: 0px 5px 5px 2px #191863;padding-bottom:3rem;padding-top: 1rem;">
                                                <div class="col-md-10 col-sm-10">
                                                    <h5 class="modal-title" id="exampleModalLabel">Información usuario</h5>
                                                </div>
                                                <div class="col-md-2 col-sm-2">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <form name="formulario">
                                                            <div class="col-md-12">
                                                                <h4>Datos personales</h4>
                                                            </div>
                                                            <hr>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control editNombre<?=$item->id_persona_entidad?>" placeholder="Nombre" 
                                                                    value="<?=$item->nombres?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="text"  class="form-control editAP<?=$item->id_persona_entidad?>" placeholder="Apellido Paterno" 
                                                                    value="<?=$item->apellido_paterno?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control editAM<?=$item->id_persona_entidad?>" placeholder="Apellido Materno" 
                                                                    value="<?=$item->apellido_materno?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control editRFC<?=$item->id_persona_entidad?>" placeholder="RFC" 
                                                                    value="<?=$item->rfc?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control editCorreo<?=$item->id_persona_entidad?>" placeholder="Correo Electronico" 
                                                                    value="<?=$item->correo_electronico?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                <select class="form-control editSexo<?=$item->id_persona_entidad?>">
                                                                    <option value="<?=$item->genero_sexual?>">Sexo</option>
                                                                    <option value="1">Femenino</option>
                                                                    <option value="2">Masculino</option>
                                                                </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control editNumero<?=$item->id_persona_entidad?>" placeholder="Numero telefonico" value="<?=$item->numero_telefono?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="">Tipo de acceso</label>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                <select name="" class="form-control editTipo<?=$item->id_persona_entidad?>">
                                                                    <option value="<?=$item->tipo_persona_entidad?>">Tipo Acceso</option>
                                                                    <option value="1">Administrador</option>
                                                                    <option value="2">Reclutador</option>
                                                                    <option value="3">Seleccionador</option>
                                                                    <option value="4">Cliente</option>
                                                                    <option value="5">Candidato</option>
                                                                </select>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
        
                                                    <div class="col-md-6">
                                                        <div class="panel">
                                                            <div class="panel-heading">
                                                            <img src="<?php echo base_url(); ?>dist/images/avatar-1.jpg" style="display:block;width:100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary" id="btnGuardarCambiosUsuario" data-hash="<?=$item->id_persona_entidad?>">Guardar cambios</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div><!--fin modal-->
        
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                <?php else:?>
                    <div class="alert alert-danger">No se encontraron resultados</div>
                <?php endif;?>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content ">
                        <div class="modal-header" style="box-shadow: 0px 5px 5px 2px #191863;padding-bottom:3rem;padding-top: 1rem;">
                            <div class="col-md-10 col-sm-10">
                                <h4 class="modal-title" id="exampleModalLabel">Alta Nuevo Usuario</h4>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <form name="formulario">
                                    <div class="col-md-6 col-sm-12">    
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Datos personales</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Nombre" class="form-control txtNombre txtcaja" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group" class="txtcampoerror">
                                                        <input type="text" placeholder="Apellido paterno" class="form-control txtAP txt_caja" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Apellido materno" class="form-control txtAM txt_caja">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="rfc" class="form-control txtrfc txt_caja" maxLenght="13">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control txtSexo">
                                                            <option value="0">Sexo</option>
                                                            <option value="1">Masculino</option>
                                                            <option value="2">Femenino</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Datos de ubicacion</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="email" placeholder="Correo Electronico" class="form-control txtCorreo txt_caja">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="number" placeholder="Numero de telefono" class="form-control txtNumero txt_caja">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Tipo de acceso</label>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <select name="" id="" class="form-control txtTipo">
                                                            <option value="0">Tipo Acceso</option>
                                                            <option value="1">Administrador</option>
                                                            <option value="2">Reclutador</option>
                                                            <option value="3">Seleccionador</option>
                                                            <option value="4">Cliente</option>
                                                            <option value="5">Candidato</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer mifooter">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success nuevoUsuario">Guardar</button>
                        </div>
                        </div>
                    </div>
                </div><!--fin modal-->

            </div>
        </div>
    </div>
</div>
<link href="<?php echo base_url(); ?>dist/css/personalizados.css">
<script src="<?php echo base_url(); ?>dist/js/administrar_usuarios/admin_panel_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/administrar_usuarios/admin_panel_model.min.js" type="text/javascript"></script>
