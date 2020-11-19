<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    function formatofecha($anio,$mes,$dia){
        $meses = array(
            "01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto",
            "09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre"
        );

        echo $dia.' de '.$meses[$mes].' '.$anio;
    }
?>

<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>seleccionadores/mi-agenda">Mi agenda</a></li>
                    <li>Detalle entrevista</li>
                </ol>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Detalle de entrevista</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php foreach($data as $item): ?>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img src="<?php echo base_url($item->ruta_foto) ?>" class="img-responsive center-block img-circle">
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><b>Nombre:</b></td><td><?=$item->nombres.' '.$item->apellido_paterno.' '.$item->apellido_materno?></td>
                                            </tr>
                                            <tr>
                                                <td><b>RFC:</b></td><td><?=$item->rfc?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Coreo Electronico:</b></td><td><?=$item->correo_electronico?></td>
                                            </tr>
                                            <?php if($item->descripcion_entrevista != null || $item->descripcion_entrevista != ""):?>
                                            <tr>
                                                <td><b>Comentario:</b></td><td><?=$item->descripcion_entrevista?></td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <?php if($item->descripcion_entrevista == null || $item->descripcion_entrevista == ""):?>
                                        <input type="button" class="btn btn-default btn-sm" value="Reliazar comentario" id="btnHacer">
                                    <?php endif; ?>
                                    <hr>
                                    <div class="comentario panelComentario" style="display:none;">
                                        <div class="form-group">
                                            <label for="comentario">Realizar comentario</label>
                                            <textarea name="comentario" id="textComentario" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <a href="javascript:void(0);" class="btn btn-success btnCometario" data-hash="<?=$item->id_entrevista?>">
                                                Aceptar
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="panel panel-default">
                                <div class="panel-body" style="text-aling:center;">
                                    <p><i class="fa fa-clock-o fa-5x"></i></p>
                                    <p><?=$item->hora_entrevista?></p>
                                </div>
                                <div class="panel-footer">
                                    <?=$item->fecha_entrevista?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>dist/js/seleccionador/seleccionador_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/seleccionador/seleccionador_model.min.js" type="text/javascript"></script>