<?php

class InformacionCandidtos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * PARA EFECTOS DE AVANCE: obtenerCuestionario
     * Se obtienen los datos necesarios para realizar validaciones y comprobaciones de identidad del usuario ingresado.
     * @param Array  $la_credentials user's credentiasl
     * @param String $lp_password passwords's user
     * @return int users'id
     */
    public function obtenerCuestionario($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array();
            $ls_query = "SELECT 
                            cuestionarios.id_cuestionario, 
                            cuestionarios.descripcion_cuestionario,
                            preguntas.id_pregunta, 
                            preguntas.pregunta,
                            preguntas.tipo_pregunta,
                            claves.id_clave,
                            claves.opcion
                        FROM 
                            cuestionarios
                            INNER JOIN preguntas
                                ON(preguntas.id_cuestionario = cuestionarios.id_cuestionario)
                            INNER JOIN claves
                                ON(claves.id_pregunta = preguntas.id_pregunta)
                        ORDER BY cuestionarios.id_cuestionario ASC, preguntas.id_pregunta ASC, claves.id_clave ASC;";
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtnerInformacionUsuario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
}
