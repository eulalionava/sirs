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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Mi agenda de entrevistas</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive" id="entrevistas">
                    <table class="table table-hover">
                        <thead>
                            <th>Fecha de entrevista</th>
                            <th>Hora de entrevista</th>
                            <th>Candidato</th>
                        </thead>
                        <tbody>
                            <?php foreach($data as $item):?>
                            <?php $filtro = explode('-',$item->fecha_entrevista);?>
                                <tr>
                                    <td style="display:none;"><?=$item->id_entrevista?></td>
                                    <td><?=formatofecha($filtro[0],$filtro[1],$filtro[2])?></td>
                                    <td><?=$item->hora_entrevista?> hrs</td>
                                    <td>
                                        <?php if($item->id_persona_entidad != 0):?>
                                            <i class="fa fa-check fa-2x"></i>
                                        <?php else:?>
                                            <i class="fa fa-times fa-2x"></i>
                                        <?php endif;?>
                                    </td>
                                    <td>
                                        <?php if($item->id_persona_entidad != 0):?>
                                            <a href="javascript:void(0);"class="btn btn-primary detalle" data-hash="<?=$item->id_entrevista?>">
                                                <i class="fa fa-eye"></i> Ver
                                            </a>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>dist/js/seleccionador/seleccionador_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/seleccionador/seleccionador_model.min.js" type="text/javascript"></script>