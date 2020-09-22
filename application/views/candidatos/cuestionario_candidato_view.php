<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <?php if(count($data) > 0): ?>
        <?php $li_id_pregunta_diferente = 0; $li_index = 1;?>
        <?php foreach($data as $item): ?>
            <?php if($li_id_pregunta_diferente <> $item->id_pregunta): ?>    
                <div class="panel panel-border panel-inverse panel-nach-pregunta">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">
                            <?php echo $li_index.'. '.$item->pregunta; ?>
                        </h3> 
                    </div> 
                    <div class="panel-body">
                        <?php foreach($data as $respuesta): ?>
                            <?php if($respuesta->id_pregunta == $item->id_pregunta): ?>
                                <?php if($item->tipo_pregunta == 1): ?>
                                    <textarea class="form-control" rows="2" placeholder="Redacte su respuesta..."></textarea>
                                <?php elseif($item->tipo_pregunta == 2): ?>
                                    <div class="radio radio-primary radio-inline">
                                        <input type="radio" id="respuesta_<?php echo $respuesta->id_clave; ?>" value="<?php echo $respuesta->id_clave; ?>" name="respuesta_<?php echo $respuesta->id_pregunta; ?>">
                                        <label for="respuesta_<?php echo $respuesta->id_clave; ?>"> <?php echo $respuesta->opcion; ?> </label>
                                    </div>
                                <?php elseif($item->tipo_pregunta == 3): ?>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="respuesta_<?php echo $respuesta->id_clave; ?>" value="<?php echo $respuesta->id_clave; ?>">
                                        <label for="respuesta_<?php echo $respuesta->id_clave; ?>"> <?php echo $respuesta->opcion; ?> </label>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div> 
                </div>
                <?php $li_index++; ?>
            <?php endif; ?>
    
            <?php $li_id_pregunta_diferente = $item->id_pregunta;?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-danger">
            No se encontraron resultados.
        </div>
    <?php endif; ?>
</div>