<?php

class PanelPrincipal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * obtenerMenuUsuario
     * Se obtienen las opciones de menú del usuario en sesión.
     * @param Array  $arg_dataOut datos de privilegios.
     * @param String $arg_mensaje mensaje de error en caso de existir.
     * @return int 1 si finaliza con éxito, -1 en caso de error.
     */
    public function obtenerMenuUsuario($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn["id_usuario"]);
            $ls_query = "SELECT 
                            modulos.id_modulo,
                            modulos.titulo,
                            modulos.descripcion as descripcion_modulo,
                            modulos.icono, 
                            modulos.controlador,
                            modulos.ruta,
                            modulos_aplicativos.titulo_aplicativo,
                            modulos_aplicativos.descripcion_aplicativo,
                            modulos_aplicativos.ruta_aplicativo,
                            modulos_aplicativos.metodo_controlador,
                            perfiles_aplicativos.id_perfil_acceso,
                            perfiles_aplicativos.consultar,
                            perfiles_aplicativos.modificar,
                            perfiles_aplicativos.guardar,
                            perfiles_aplicativos.eliminar,
                            perfiles_aplicativos.procesar
                        FROM 
                                modulos
                            INNER JOIN modulos_aplicativos
                                        ON(modulos_aplicativos.id_modulo = modulos.id_modulo)
                                INNER JOIN perfiles_aplicativos
                                        ON(perfiles_aplicativos.id_modulo_aplicativo = modulos_aplicativos.id_modulo_aplicativo)
                                INNER JOIN usuarios
                                        ON(usuarios.id_perfil_acceso = perfiles_aplicativos.id_perfil_acceso)
                        WHERE 
                            (modulos.status = 1)
                            AND(modulos_aplicativos.status_aplicativo = 1)
                            AND(usuarios.id_usuario = ?)
                        ORDER BY modulos.id_modulo DESC, 
                        modulos_aplicativos.id_modulo_aplicativo DESC; ";
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerMenuUsuario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
}
