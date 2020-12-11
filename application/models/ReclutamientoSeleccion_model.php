<?php

class ReclutamientoSeleccion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * obtenerTokensGenerados
     * Se obtienen los tokens generados para los candidatos en cuestión
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerTokensGenerados($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array();
            $ls_where = "";
            
            if($arg_dataIn["tipo_persona"] > 0){
                $ls_where = " AND(personas_entidades.tipo_persona_entidad = ?) ";
                $la_where[] = $arg_dataIn["tipo_persona"];
            }
            
            $ls_query = "SELECT
                            tokens.id_token,
                            tokens.id_persona_asigna,
                            tokens.id_persona_entidad,
                            tokens.status,
                            tokens.fecha_alta,
                            CONCAT(personas_entidades.nombres, ' ', apellido_paterno, ' ' , apellido_materno) AS reclutador,
                            (SELECT 
                                CONCAT(per_ent.nombres,' ', per_ent.apellido_paterno, ' ',per_ent.apellido_materno)
                            FROM 
                                personas_entidades AS per_ent
                            WHERE 
                                (per_ent.id_persona_entidad = tokens.id_persona_entidad)
                                ) AS candidato
                            FROM 
                                tokens
                                INNER JOIN personas_entidades
                                    ON(personas_entidades.id_persona_entidad  = tokens.id_persona_asigna)
                            WHERE 
                                tokens.status = 1 ORDER BY tokens.id_token  DESC ";
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerTokensGenerados method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    
    /**
     * guardarEntrevistaCandidato
     * Se guardan el horario de la entrevista a la que asistirá el candidato.
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function guardarTokenCandidato($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array();
            $ls_query = "";
            $la_dataWhere = array("SHA2(id_entrevista, 224) = " => $arg_dataIn["id_entrevista"]);
            $la_dataUpdate = array("id_persona_entidad" => $arg_dataIn["id_persona_entidad"]);
            
            $this->db->update('entrevista', $la_dataUpdate, $la_dataWhere);
        } catch (Exception $exc) {
            $arg_mensaje = 'guardarEntrevistaCandidato method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }    
}
