<?php

class Admin_usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * obtnerUsuarios
     * Se obtienen todos los registros de usuarios 
     * @param Array  $la_credentials user's credentiasl
     * @param String $lp_password passwords's user
     * @return int users'id
     */
    public function obtnerUsuarios(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                            id_persona_entidad,
                            nombres,
                            apellido_paterno,
                            apellido_materno,
                            rfc,
                            correo_electronico,
                            genero_sexual,
                            tipo_persona_entidad,
                            ruta_foto,
                            numero_telefono,
                            status_persona_entidad,
                            fecha_alta
                        FROM personas_entidades 
                        WHERE status_persona_entidad = 1;";

            $statement = $this->db->query($ls_query);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'obtnerUsuarios method does not work. Exception: ' . $exc->getTraceAsString();
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
                            apellido_materno,
                            rfc,
                            correo_electronico,
                            numero_telefono
                        FROM personas_entidades
                        WHERE tipo_persona_entidad = 5 ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getCandidatos method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    /**
     * guardarUsuarios
     * Realiza un nuevo registro de usuarios 
     */
    public function guardarUsuarios($dataIn,&$dataOut,&$arg_mensaje){
        try {

            $la_data = Array(

                "nombres"               => $dataIn['nombre'],
                "apellido_paterno"      => $dataIn['ap'],
                "apellido_materno"      => $dataIn['am'],
                "rfc"                   => $dataIn['rfc'],
                "correo_electronico"    => $dataIn['correo'],
                "genero_sexual"         => intval($dataIn['sexo']),
                "tipo_persona_entidad"  => intval($dataIn['tipo']),
                "numero_telefono"       => $dataIn['numero'],
                "status_persona_entidad" => 1,
                "fecha_alta"            => date('Y-m-d: h:m:s'),
                "id_usuario_alta"       => $this->id_persona_entidad
            );

            $data_usuario = Array(
                "id_perfil_acceso"  =>intval($dataIn['tipo']),
                "usuario"           =>$dataIn['rfc'],
                "password"          =>md5($dataIn['rfc']),
                "status"            =>1,
                "fecha_alta"        =>date('Y-m-d: h:m:s'),
                "id_usuario_alta"   =>$this->id_persona_entidad
            );

            $this->db->insert("personas_entidades",$la_data);

            $this->db->insert("usuarios",$data_usuario);

            //RELACION CON LAS TABLAS
            $query_persona = "SELECT max(id_persona_entidad) as id_persona FROM personas_entidades";
            $statement1 = $this->db->query($query_persona);
            $arg_dataOut1 = $statement1->result();
    
            $query_usuario = "SELECT max(id_usuario) as id_usuario FROM usuarios";
            $statement2 = $this->db->query($query_usuario);
            $arg_dataOut2 = $statement2->result();

            $persona_usuario = Array(
                "id_persona_entidad"  =>$arg_dataOut1[0]->id_persona,
                "id_usuario"          =>$arg_dataOut2[0]->id_usuario,
                "fecha_alta"          =>date('Y-m-d: h:m:s'),
                "id_usuario_alta"     =>$this->id_persona_entidad
            );

            $this->db->insert("usuarios_personas_entidades",$persona_usuario);

        } catch (Exception $exc) {
            $arg_mensaje = 'obtnerUsuarios method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    public function borrarUsuario($id_persona,&$arg_mensaje){
        try {

            $la_where = Array(
                "id_persona_entidad" => $id_persona,
            );

            $la_update = Array(
                "status_persona_entidad" => 2
            );

            $this->db->update("personas_entidades",$la_update,$la_where);

        } catch (Exception $exc) {
            $arg_mensaje = 'borrarUsuario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    public function editarUsuario($dataIn,&$arg_mensaje){
        try {


            $la_update = Array(
                "nombres"           => $dataIn['nombre'],
                'apellido_paterno'  => $dataIn['ap'],
                'apellido_materno'  => $dataIn['am'],
                "rfc"               => $dataIn['rfc'],
                "correo_electronico"=> $dataIn['correo'],
                "genero_sexual"     => $dataIn['sexo'],
                "tipo_persona_entidad"  => $dataIn['tipo'],
                "numero_telefono"     => $dataIn['numero']
            );

            $la_where = Array(
                "id_persona_entidad" => $dataIn['id_persona'],
            );

            $this->db->update("personas_entidades",$la_update,$la_where);

        } catch (Exception $exc) {
            $arg_mensaje = 'borrarUsuario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    public function getVacantes(&$dataOut,&$arg_mensaje){
        try {

            $ls_query = "SELECT 
                            id_vacante,
                            vacante
                        FROM vacantes
                        WHERE estatus = 1 ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getVacantes method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    public function getDocumentos(&$dataOut,&$arg_mensaje){
        try {

            $ls_query = "SELECT 
                            id,
                            nombre_docs,
                            descripcion,
                            idsesion
                        FROM catalogo_docs_expediente ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getDocumentos method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    public function getPersonaVacante($dataIn,&$dataOut,&$arg_mensaje){
        try {

            $ls_query = "SELECT * FROM personas_vacantes 
                        WHERE id_persona_entidad = '".$dataIn['id_persona']."' 
                        and id_vacante = '".$dataIn['id_vacante']."'; ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getPersonaVacante method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    public function newPersonaVacante($dataIn,&$arg_mensaje){
        try {

            $data = Array(
                "id_persona_entidad" => $dataIn['id_persona'],
                "id_vacante"=>$dataIn['id_vacante'],
                'id_status'=>$this->id_persona_entidad
            );

            $this->db->insert("personas_vacantes",$data);

        } catch (Exception $exc) {
            $arg_mensaje = 'newPersonaVacante method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
}
