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
                <h3 class="panel-title">Agenda de horarios</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php
                        if($ok){
                            foreach($data as $item){
                                $filtro = explode('-',$item->fecha_entrevista);
                                ?>
                                    <div class="col-md-3 col-sm-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="horario">
                                                            <?=$item->hora_entrevista?>
                                                            horas
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <div class="fecha">
                                                    <p class="text-success"><?=formatofecha($filtro[0],$filtro[1],$filtro[2])?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }else{
                            ?>
                                <div class="alert alert-danger">No se encontraron registros de horarios disponibles</div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_model.min.js" type="text/javascript"></script>
