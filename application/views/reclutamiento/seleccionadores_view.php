<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Alta de entrevistadores</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <label for="seleccionador">Entrevistador:</label>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <select name="selectEntrevistadores" id="selectEntrevistadores" class="form-control">
                                    <option value="0">Selecciona</option>
                                        <?php
                                            foreach($data as $item){
                                                ?>
                                                <option value="<?=$item->id_persona_entidad?>"><?=$item->nombres .' '.$item->apellido_paterno.' '.$item->apellido_materno?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">Seleccionados</h5>
                            </div>
                            <div class="panel-body" id="seleccionados">

                            </div>
                        </div>
                    </div>
                    
                </div> 
                <div class="row">
                    <div class="col-md-3">
                        <input type="button" value="Alta" id="btnAltaEntrevistadores" class="btn btn-success">
                    </div>   
                </div>
                <div class="w-100">
                <hr>
                
                <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body" id="altasS">

                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_model.min.js" type="text/javascript"></script>
