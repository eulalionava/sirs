<div class="table-responsive">
    <?php
        if($ok){
            ?>
                <table class="table table-hover" id="tablaSeleccionadores">
                    <thead>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>RFC</th>
                        <th>TELEFONO</th>
                        <th>FOTO</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($data as $item){
                                ?>
                                <tr>
                                    <td style="display:none;"><?=$item->id_persona_entidad?></td>
                                    <td><?=$item->nombres?></td>
                                    <td><?=$item->apellido_paterno.' '.$item->apellido_materno?></td>
                                    <td><?=$item->rfc?></td>
                                    <td><?=$item->numero_telefono?></td>
                                    <td>
                                        <img src="<?php echo base_url($item->ruta_foto); ?>" alt="imagen" class="rounded mx-auto d-block" style="width: 50px;border-radius:100%;" />
                                    </td>
                                    <td>
                                        <input type="button" value="Baja" class="btn btn-danger btnBaja" >
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                        <a href="<?php echo base_url(); ?>reclutamiento-general/agendar-horario">                        
                            <button class="btn btn-warning">agendar horarios</button>
                        </a>
                    </tbody>
                </table>
            <?php
        }else{
            ?>
            <div class="alert alert-danger">No hay seleccionadores</div>
            <?php
        }
    ?>
</div>