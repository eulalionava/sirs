<?php

class ReclutamientoModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * obtnerInformacionUsuario
     * Se obtienen los datos necesarios para realizar validaciones y comprobaciones de identidad del usuario ingresado.
     * @param Array  $la_credentials user's credentiasl
     * @param String $lp_password passwords's user
     * @return int users'id
     */
    public function guardarHorario($arg_dataIn) {
        try {

            $la_where = {
                'id_usuario_entrevistador'  :7,
                'id_persona_entidad'        :0,
                'fecha_entrevista'          :$arg_dataIn['fecha'],
                'hora_entrevista'           :$arg_dataIn['hora']

            };
        } catch (Exception $exc) {
            $arg_mensaje = 'obtnerInformacionUsuario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
}
