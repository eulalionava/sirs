<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Agenda de horarios de entrevista</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <input type="radio" name="agenda" value="1" class="agendaManual">
                                <label for="agenda">Manual</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="agenda" value="2" class="agendaAuto">
                                <label for="agenda">Automatico</label>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default" id="manual" style="display:none;">
                        <div class="panel-heading">
                            <h5 class="title">Manual</h5>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-4 col-sm-4">
                                <label for="intervalo">Intervalo:</label>
                                <input type="text" class="form-control inter" placeholder="minutos" id="intManual" >
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label for="intervalo">Inicio:</label>
                                <select name="" id="inicioManual" class="form-control">
                                    <option value="9">9:00</option>
                                    <option value="10">10:00</option>
                                    <option value="11">11:00</option>
                                    <option value="12">12:00</option>
                                    <option value="13">13:00</option>
                                    <option value="14">14:00</option>
                                    <option value="15">15:00</option>
                                    <option value="16">16:00</option>
                                    <option value="17">17:00</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label for="intervalo">Fin:</label>
                                <select name="" id="finManual" class="form-control">
                                    <option value="9">9:00</option>
                                    <option value="10">10:00</option>
                                    <option value="11">11:00</option>
                                    <option value="12">12:00</option>
                                    <option value="13">13:00</option>
                                    <option value="14">14:00</option>
                                    <option value="15">15:00</option>
                                    <option value="16">16:00</option>
                                    <option value="17">17:00</option>
                                </select>
                            </div>
                            <div class="col-md-12 col-sm-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <label for="intervalo">Dias semana</label> 
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <input type="date" class="form-control" id="fechaInicioManual">
                            </div>
                            <div class="col-md-1">
                                <label for="intervalo">Hasta</label>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <input type="date" class="form-control" id="fechaFinManual">
                            </div>
                            <input type="button" class="btn btn-success" value="Aceptar" id="btnManual">

                        </div>
                    </div>

                    <div class="panel panel-default" id="automatico" style="display:none;">
                        <div class="panel-heading">
                            <h4 class="title">Automatico</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 col-sm-6">
                                <label for="">Intervalo:</label>
                                <input type="text" class="form-control" placeholder="minutos" style="margin-bottom:10px;">
                                <input type="button" class="btn btn-success" value="Aceptar">
                            </div>
                            <div class="col-md-6 col-sm-6">
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <th></th>
                                <th>11</th>
                                <th>12</th>
                                <th>13</th>
                                <th>14</th>
                                <th>15</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>9:00</td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>10:00</td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>11:00</td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>12:00</td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>13:00</td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

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
