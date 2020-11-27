<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Mis candidatos</h3>
            </div>
            <div class="panel-body">
                <?php if( count($data) > 0 ):?>
                    <table id="tablaCandidatos">
                        <thead>
                            <th>Nombre</th>
                            <th>Rfc</th>
                            <th>Correo</th>
                            <th>Detalles</th>
                        </thead>
                        <tbody>
                            <?php foreach($data as $item):?>
                                <tr>
                                    <td><?=$item->nombres.' '.$item->apellido_paterno.' '.$item->apellido_materno?></td>
                                    <td><?=$item->rfc?></td>
                                    <td><?=$item->correo_electronico?></td>
                                    <td>
                                        <a href="javascript:void(0);" data-hash="<?=$item->id_persona_entidad?>" title="Dar seguimiento" class="btn btn-primary btn-detalle">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
