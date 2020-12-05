<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>admin-usuarios/ver-usuarios">Usuarios</a></li>
                    <li>Asignar documentos</li>
                </ol>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Candidatos</h3>
            </div>
            <div class="panel-body">
                <?php if(count($candidatos) > 0):?>
                <table id="tablaUsuarios" class="table">
                    <thead>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>RFC</th>
                        <th>CORREO</th>
                        <th>TELEFONO</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach($candidatos as $candidato):?>
                            <tr>
                                <td><?=$candidato->nombres?></td>
                                <td><?=$candidato->apellido_paterno.' '.$candidato->apellido_materno?></td>
                                <td><?=$candidato->rfc?></td>
                                <td><?=$candidato->correo_electronico?></td>
                                <td><?=$candidato->numero_telefono?></td>
                                <td>
                                    <div class="input-group">
                                        <button class="btn btn-warning btnASignarDocumentos" data-hash="<?=$candidato->id_persona_entidad?>" data-toggle="modal" 
                                        data-target="#docs<?=$candidato->id_persona_entidad?>" title="Asignar documentos">
                                            <i class="fa fa-file"></i>
                                        </button>
                                        <button class="btn btn-secondary" data-hash="<?=$candidato->id_persona_entidad?>" data-toggle="modal" 
                                        data-target="#modal<?=$candidato->id_persona_entidad?>" title="Asignar vacante">
                                            <i class="fa fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal<?=$candidato->id_persona_entidad?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ASIGNAR VACANTE</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <select class="form-control txtvacante<?=$candidato->id_persona_entidad?>" style="height:5rem;">
                                                <?php foreach($vacantes as $vacante):?>
                                                    <option value="<?=$vacante->id_vacante?>"><?=$vacante->vacante?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="panel-footer">
                                            <button class="btn btn-primary asignarVacante" data-hash="<?=$candidato->id_persona_entidad?>"><b>Asignar vacante</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!--fin modal-->

                            <!-- Modal -->
                            <div class="modal fade" id="docs<?=$candidato->id_persona_entidad?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel">ASIGNACION DE DOCUMENTOS</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary btnGuardarDocumentos" data-hash="<?=$candidato->id_persona_entidad?>"><b>Asigar</b></button>
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
<script src="<?php echo base_url(); ?>dist/js/administrar_usuarios/admin_panel_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/administrar_usuarios/admin_panel_model.min.js" type="text/javascript"></script>
