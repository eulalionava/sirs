<?php

class InformacionCandidatos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    /**
     * obtenerDocumentos
     * Se obtienen los documentos configurados al cliente que pertecene la vacante.
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerDocumentos($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn['id_vacante_md5']);
            $ls_where = ""; 
            
            $ls_query = "SELECT 
                            vacantes.id_vacante,
                            vacantes.id_campaña,
                            campaña.id_cliente,
                            campañas_documentos.id_documento,
                            catalogo_docs_expediente.nombre_doc,
                            catalogo_docs_expediente.descripcion,
                            clientes.solicitud
                        FROM 
                            vacantes
                        INNER JOIN campaña
                            ON(campaña.id_campaña = vacantes.id_campaña)
                        INNER JOIN campañas_documentos
                            ON(campañas_documentos.id_campaña = vacantes.id_campaña)
                        INNER JOIN catalogo_docs_expediente
                            ON(catalogo_docs_expediente.id = campañas_documentos.id_documento)
                        INNER JOIN clientes
                            ON(clientes.id_cliente = campaña.id_cliente)
                    WHERE 
                        (MD5(vacantes.id_vacante) = ?)
                    ORDER BY campañas_documentos.id_documento DESC ";
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerDocumentos method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    
    /**
     * obtenerDetalleCuestionario
     * Se obtienen las preguntas configuradas al cuestionario
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerDetalleCuestionario($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn['id_persona_entidad'], $arg_dataIn['id_cuestionario_md5']);
            $ls_where = "";            
            $ls_query = "SELECT 
                            personas_vacantes.id_persona_entidad,
                            personas_vacantes.id_vacante,
                            vacantes.id_campaña AS id_campania,
                            vacantes.vacante,
                            vacantes.descripcion_vacante,
                            vacantes.salario_propuesto,
                            vacantes.estatus,
                            campaña.id_cliente,
                            campaña.campaña,
                            campaña.descripcion_campaña,
                            clientes.nombre AS nombre_cliente,
                            clientes.solicitud AS solicitud_cliente,
                            clientes.rfc AS rfc_cliente,
                            vacantes_cuestionarios.id_cuestionario,
                            cuestionarios.titulo_cuestionario,
                            cuestionarios.descripcion_cuestionario,
                            cuestionarios.id_tipo_cuestionario,
                            preguntas.id_pregunta,
                            preguntas.pregunta,
                            preguntas.indicaciones,
                            preguntas.tipo_pregunta,
                            preguntas.archivo,
                            preguntas.ruta_archivo,
                            preguntas.id_tipo_archivo,
                            claves.id_clave,
                            claves.opcion    
                        FROM 
                            personas_vacantes
                            INNER JOIN vacantes
                                ON(vacantes.id_vacante = personas_vacantes.id_vacante)
                            INNER JOIN vacantes_cuestionarios
                                ON(vacantes_cuestionarios.id_vacante = vacantes.id_vacante)	
                            INNER JOIN campaña
                                ON(campaña.id_campaña = vacantes.id_campaña)
                            INNER JOIN clientes
                                ON(clientes.id_cliente  = campaña.id_cliente)
                            INNER JOIN cuestionarios
                                ON(cuestionarios.id_cuestionario = vacantes_cuestionarios.id_cuestionario)
                                AND(cuestionarios.id_cliente  = campaña.id_cliente)
                            INNER JOIN preguntas
                                ON(preguntas.id_cuestionario  = cuestionarios.id_cuestionario)
                            INNER JOIN claves
                                ON(claves.id_pregunta = preguntas.id_pregunta)
                        WHERE 
                            (personas_vacantes.id_persona_entidad = ?)
                            AND(MD5(cuestionarios.id_cuestionario) = ?)
                            ORDER BY vacantes.id_vacante DESC, 
                            cuestionarios.id_cuestionario ASC, 
                            preguntas.id_pregunta ASC, 
                            claves.id_clave ASC; ";
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerDetalleCuestionario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    
    /**
     * obtenerCuestionariosVacante
     * Se obtienen los cuestionarios asinados a las vacantes
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerCuestionariosVacante($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn['id_vacante_md5']);
            $ls_where = "";
            
            $ls_query = "SELECT
                            vacantes_cuestionarios.id_vacante,
                            vacantes_cuestionarios.id_cuestionario,
                            vacantes.vacante,
                            cuestionarios.titulo_cuestionario,
                            cuestionarios.descripcion_cuestionario,
                            cuestionarios.id_tipo_cuestionario
                        FROM 	
                            vacantes_cuestionarios
                            INNER JOIN vacantes
                                ON(vacantes.id_vacante = vacantes_cuestionarios.id_vacante)
                            INNER JOIN cuestionarios
                                ON(cuestionarios.id_cuestionario = vacantes_cuestionarios.id_cuestionario)
                        WHERE 
                            (MD5(vacantes_cuestionarios.id_vacante) = ?)
                            ORDER BY vacantes_cuestionarios.id_vacante_cuestionario DESC";
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerCuestionariosVacante method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    
    /**
     * obtenerVacantesCandidato
     * Se obtienen las vacantes asignadas a los candidatos
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerVacantesCandidato($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn['id_persona_entidad']);
            $ls_where = "";
            if(isset($arg_dataIn['id_vacante_md5'])){
                $la_where[] = $arg_dataIn['id_vacante_md5'];
                $ls_where .= " AND(MD5(personas_vacantes.id_vacante) = ?)";
            }
            $ls_query = "SELECT 
                            personas_vacantes.id_persona_entidad,
                            personas_vacantes.id_vacante,
                            personas_vacantes.id_status,
                            vacantes.salario_propuesto,
                            vacantes.id_campaña,
                            vacantes.vacante,
                            vacantes.descripcion_vacante,
                            campaña.campaña,
                            campaña.id_cliente,
                            clientes.nombre,
                            clientes.descripcion_cliente,
                            clientes.logo,
                            clientes.solicitud
                        FROM 
                            personas_vacantes
                            INNER JOIN vacantes
                                ON(vacantes.id_vacante  = personas_vacantes.id_vacante)
                            INNER JOIN campaña
                                ON(campaña.id_campaña  = vacantes.id_campaña)
                            INNER JOIN clientes
                                ON(clientes.id_cliente = campaña.id_cliente)
                        WHERE 
                            (personas_vacantes.id_persona_entidad = ?) ".$ls_where."
                        ORDER BY personas_vacantes.id_persona_vacante DESC";
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerVacantesCandidato method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    
    /**
     * obtenerSolicitarDocumentos
     * Se obtienen los documentos parametrizados a un cliente, los cuales son requeridos a los candidatos.
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerSolicitarDocumentos($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn['id_campania']);
            $ls_query = "SELECT 
                            campañas_documentos.id_documento,
                            catalogo_docs_expediente.nombre_doc,
                            descripcion
                        FROM 
                            campañas_documentos
                            INNER JOIN catalogo_docs_expediente
                                ON(catalogo_docs_expediente.id = campañas_documentos.id_documento)
                        WHERE
                            (campañas_documentos.id_campaña = ?)";
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerSolicitarDocumentos method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    
    /**
     * obtenerEstructuraCompletaCandidato
     * Se obtienen los datos necesarios para realizar validaciones y comprobaciones de identidad del usuario ingresado, así como cuestionarios asignados a la vacante en cuestión.
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerEstructuraCompletaCandidato($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn['id_persona_entidad']);
            $ls_query = "SELECT 
                            personas_vacantes.id_persona_entidad,
                            personas_vacantes.id_vacante,
                            vacantes.id_campaña AS id_campania,
                            vacantes.vacante,
                            vacantes.descripcion_vacante,
                            vacantes.salario_propuesto,
                            vacantes.estatus,
                            campaña.id_cliente,
                            campaña.campaña,
                            campaña.descripcion_campaña,
                            clientes.nombre AS nombre_cliente,
                            clientes.solicitud AS solicitud_cliente,
                            clientes.rfc AS rfc_cliente,
                            vacantes_cuestionarios.id_cuestionario,
                            cuestionarios.titulo_cuestionario,
                            cuestionarios.descripcion_cuestionario,
                            cuestionarios.id_tipo_cuestionario,
                            preguntas.id_pregunta,
                            preguntas.pregunta,
                            preguntas.indicaciones,
                            preguntas.tipo_pregunta,
                            preguntas.archivo,
                            preguntas.ruta_archivo,
                            preguntas.id_tipo_archivo,
                            claves.id_clave,
                            claves.opcion    
                        FROM 
                            personas_vacantes
                            INNER JOIN vacantes
                                ON(vacantes.id_vacante = personas_vacantes.id_vacante)
                            INNER JOIN vacantes_cuestionarios
                                ON(vacantes_cuestionarios.id_vacante = vacantes.id_vacante)	
                            INNER JOIN campaña
                                ON(campaña.id_campaña = vacantes.id_campaña)
                            INNER JOIN clientes
                                ON(clientes.id_cliente  = campaña.id_cliente)
                            INNER JOIN cuestionarios
                                ON(cuestionarios.id_cuestionario = vacantes_cuestionarios.id_cuestionario)
                                AND(cuestionarios.id_cliente  = campaña.id_cliente)
                            INNER JOIN preguntas
                                ON(preguntas.id_cuestionario  = cuestionarios.id_cuestionario)
                            INNER JOIN claves
                                ON(claves.id_pregunta = preguntas.id_pregunta)
                        WHERE 
                            (personas_vacantes.id_persona_entidad = ?)
                            ORDER BY vacantes.id_vacante DESC, 
                            cuestionarios.id_cuestionario ASC, 
                            preguntas.id_pregunta ASC, 
                            claves.id_clave ASC; ";
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
