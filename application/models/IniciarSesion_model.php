<?php

class IniciarSesion_model extends CI_Model {

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
    public function obtnerInformacionUsuario($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn["usuario"]);
            $ls_query = "SELECT 
                            usuarios.id_usuario,
                            usuarios.id_perfil_acceso,
                            perfiles_accesos.titulo_perfil,
                            usuarios.usuario,
                            usuarios.password,
                            usuarios_personas_entidades.id_persona_entidad,
                            personas_entidades.nombres,
                            personas_entidades.apellido_paterno,
                            personas_entidades.apellido_materno,
                            personas_entidades.tipo_persona_entidad,
                            personas_entidades.ruta_foto, 
                            CASE
                                WHEN personas_entidades.tipo_persona_entidad = 1 THEN 'Administrador'
                                WHEN personas_entidades.tipo_persona_entidad = 2 THEN 'Reclutador'
                                WHEN personas_entidades.tipo_persona_entidad = 3 THEN 'Seleccionador'
                                WHEN personas_entidades.tipo_persona_entidad = 4 THEN 'Cliente'
                                WHEN personas_entidades.tipo_persona_entidad = 5 THEN 'Candidato'
                                ELSE 'Welcome'
                            END AS tipo_persona_desc
                        FROM 
                            usuarios 
                            INNER JOIN perfiles_accesos
                                ON(perfiles_accesos.id_perfil_acceso = usuarios.id_perfil_acceso)
                            INNER JOIN usuarios_personas_entidades
                                ON(usuarios_personas_entidades.id_usuario = usuarios.id_usuario)
                            INNER JOIN personas_entidades
                                ON(personas_entidades.id_persona_entidad = usuarios_personas_entidades.id_persona_entidad)
                        WHERE 
                                (usuarios.status = 1) 
                            AND(UPPER(usuarios.usuario) = UPPER(?))";
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
