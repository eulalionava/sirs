 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
if( !function_exists('fecha_espanol') ){     
    function fecha_espanol($arg_dia_semana, $arg_dia, $arg_mes, $arg_anio) {
        $la_diasSemana = array("","Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $la_mesesAnio = array("","enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        
        $ls_fecha_espaniol = $la_diasSemana[$arg_dia_semana].", ".$arg_dia." de ".$la_mesesAnio[$arg_mes]." del ".$arg_anio;
        return $ls_fecha_espaniol;
    }
}
?>