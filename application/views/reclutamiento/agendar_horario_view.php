<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Agenda de horarios de entrevista</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 ms-6">
                        <div class="form-group">
                            <label for="fecha">Seleccionar fecha:</label>
                            <input type="date" id="btnFecha" class="form-control" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                        </div>
                    </div>
                    <div class="col-md-6 ms-6">
                        <div class="form-group">
                            <label for="fecha">Seleccionar Horario:</label>
                            <select class="form-control" id="selectHorario">
                                <option value="9:00:00">9:00:00</option>
                                <option value="10:00:00">10:00:00</option>
                                <option value="11:00:00">11:00:00</option>
                                <option value="12:00:00">12:00:00</option>
                                <option value="13:00:00">13:00:00</option>
                                <option value="14:00:00">14:00:00</option>
                                <option value="15:00:00">15:00:00</option>
                                <option value="16:00:00">16:00:00</option>
                                <option value="17:00:00">17:00:00</option>
                            </select>
                        </div>
                    </div>
                    <input type="button" class="btn btn-success" id="btnAgendarHorario" value="Agendar horario">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_view.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>dist/js/reclutamiento/reclutamiento_model.min.js" type="text/javascript"></script>
