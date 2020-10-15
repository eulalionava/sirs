<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">        
        <!-- Page-Title -->        
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Generar tokens para candidatos</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Panel principal</a></li>
                    <li><a href="<?php echo base_url(); ?>reclutamiento-seleccion">Reclutamiento y selección</a></li>
                    <li>Generar tokens</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-border  panel-purple">
                    <div class="panel-heading">
                        <h3 class="panel-title">Listado de tokens generados</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-condensed table-striped table-hover table-small-font">
                                        <thead>
                                            <tr>
                                                <th style="width: 1px;"></th>
                                                <th>#</th>
                                                <th>Reclutador</th>
                                                <th>Candidato</th>
                                                <th>Estatus</th>
                                                <th>Fecha alta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($data_tokens) > 0): ?>
                                                <?php foreach($data_tokens as $token): ?>
                                                    <tr>
                                                        <td nowrap>
                                                            <div class="radio radio-primary m-b-0 m-t-0">
                                                                <input type="radio" id="registro<?php echo $token->id_token; ?>" value="<?php echo $token->id_token; ?>" name="registro">
                                                                <label for="registro<?php echo $token->id_token; ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td nowrap><?php echo $token->id_token; ?></td>
                                                        <td nowrap><?php echo $token->reclutador; ?></td>
                                                        <td nowrap><?php echo $token->candidato; ?></td>
                                                        <td nowrap><?php echo $token->status; ?></td>
                                                        <td nowrap><?php echo $token->fecha_alta; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5">No se encontraron resultados</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/reclutamiento_seleccion/reclutamiento_seleccion_model.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/reclutamiento_seleccion/reclutamiento_seleccion_view.min.js" type="text/javascript"></script>
