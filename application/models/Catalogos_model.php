<?php

class Catalogos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * obtnerVacantes
     * Se obtienen todo el registro de vacantes 
     */
    public function obtnerVacantes(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                            vacantes.id_vacante,
                            vacantes.id_campana,
                            vacantes.vacante,
                            vacantes.descripcion_vacante,
                            vacantes.salario_propuesto,
                            vacantes.estatus,
                            camp.campana,
                            clientes.nombre,
                            clientes.descripcion_cliente,
                            clientes.logo
                        FROM vacantes 
                        INNER JOIN campana as camp 
                            ON vacantes.id_campana=camp.id_campana
                        INNER JOIN clientes 
                            ON camp.id_cliente = clientes.id_cliente
                        where vacantes.estatus = 1; ";

            $statement = $this->db->query($ls_query);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'obtnerVacantes method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * getCampañas
     * Se obtienen todas las campañas 
     */

    public function getCampañas(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                            id_campana,
                            id_cliente,
                            campana,
                            descripcion_campana
                        FROM campana";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getCampañas method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * nuevaVacante
     * Realiza el registro de una nueva vacante 
     */
    public function nuevaVacante($dataIn,&$arg_mensaje){
        try {

            $vacante = Array(
                "id_campana"          =>intval($dataIn['campana']),
                "vacante"             =>$dataIn['vacante'],
                "descripcion_vacante" =>$dataIn['descripcion'],
                "salario_propuesto"   =>$dataIn['salario'],
                "estatus"             =>$dataIn['estatus']
            );

            $this->db->insert("vacantes",$vacante);

        } catch (Exception $exc) {
            $arg_mensaje = 'nuevaVacante method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * borrarVacante
     * Baja de un registro
     */
    public function borrarVacante($id_vacante,&$arg_mensaje){
        try {

            $la_where = Array(
                "id_vacante" => $id_vacante,
            );

            $la_update = Array(
                "estatus" => 2
            );

            $this->db->update("vacantes",$la_update,$la_where);

        } catch (Exception $exc) {
            $arg_mensaje = 'borrarVacante method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * edicionVacante
     * Editar un registro
     */
    public function edicionVacante($dataIn,&$arg_mensaje){
        try {

            $la_where = Array(
                "id_vacante" => $dataIn['id_vacante'],
            );

            $la_update = Array(
                "vacante"               =>$dataIn['vacante'],
                "descripcion_vacante"   =>$dataIn['descripcion'],
                "salario_propuesto"     =>$dataIn['salario']
            );

            $this->db->update("vacantes",$la_update,$la_where);

        } catch (Exception $exc) {
            $arg_mensaje = 'edicionVacante method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * getCandidatos
     * Obtiene todos los registros de tipo candidato
     */
    public function getCandidatos(&$dataOut,&$arg_mensaje){
        try {

            $ls_query = "SELECT 
                            id_persona_entidad,
                            nombres,
                            apellido_paterno,
                            apellido_materno
                        FROM personas_entidades
                        WHERE tipo_persona_entidad = 5 ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'edicionVacante method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * Verifica si el candidato tiene la vacante asignada
     */
    public function buscarAsiganacion($dataIn,&$dataOut, &$arg_mensaje){
        try {

            $ls_query = "SELECT 
                            id_persona_vacante,
                            id_persona_entidad,
                            id_vacante,
                            id_status
                        FROM personas_vacantes
                        WHERE id_persona_entidad = '".$dataIn['id_candidato']."' 
                        AND id_vacante ='".$dataIn['id_vacante']."' ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'buscarAsiganacion method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * Asigna vacante a un candidato
     */
    public function asiganacionCandidatoVacante($dataIn,&$dataOut, &$arg_mensaje){
        try {

            $la_data = array(
                "id_persona_entidad"=>intval($dataIn['id_candidato']),
                "id_vacante"=>intval($dataIn['id_vacante']),
                "id_status"=>$dataIn['id_entidad']
            ); 

            $this->db->insert("personas_vacantes",$la_data);

        } catch (Exception $exc) {
            $arg_mensaje = 'asiganacionCandidatoVacante method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * getClientes
     * Obtiene todos los clientes
     */
    public function getClientes(&$dataOut,&$arg_mensaje){
        try {

            $ls_query = "SELECT 
                            id_cliente,
                            nombre,
                        FROM clientes";
            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getClientes method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * getCuestionarios
     * Obtiene todos los cuestionarios por cliente
     */
    public function getCuestionarios(&$dataOut,&$arg_mensaje){
        try {

            $ls_query = "SELECT 
                            id_cuestionario,
                            titulo_cuestionario
                        FROM cuestionarios
                        WHERE id_cliente = 1
                        AND estatus = 1 ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getCuestionarios method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * getDocumentos
     * Obtiene el catalogo de documentos (expedientes)
     */
    public function getDocumentos(&$dataOut,&$arg_mensaje){
        try {

            $ls_query = "SELECT 
                            id,
                            nombre_doc,
                            descripcion
                        FROM catalogo_docs_expediente";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getCuestionarios method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

}
