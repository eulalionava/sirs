<?php

class InformacionCandidatos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * consultarDocumentos
     * Se obtienen los documentos almacenados del candidato.
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function consultarDocumentos($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn['id_persona_entidad']);
            $ls_where = "";
            $ls_query = "";
            
            if(strlen(trim($arg_dataIn["id_cliente"])) > 0){
                $ls_query = "";
            }else{
                $ls_query = "";
            }
            
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
     * guardarDocumentosCandidato
     * Se guardan los documentos del candidato.
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function guardarDocumentosCandidato($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array();
            $ls_query = "";
            
            if($arg_dataIn["solicitud"] == 1){
                $la_where = array($arg_dataIn["id_cliente"], $arg_dataIn["id_persona_entidad"]);
                $ls_query = "SELECT COUNT(1) AS existe_archivo FROM solicitud_empleo WHERE (id_cliente = ?) AND (id_persona_entidad  = ?) ";
            }else{
                $la_where = array($arg_dataIn["id_documento"], $arg_dataIn["id_candidato"]);
                $ls_query = "SELECT COUNT(1) AS existe_archivo FROM documentos_candidatos WHERE (id_documento = ?) AND (id_candidato  = ?) ";
            }
            
            $statement = $this->db->query($ls_query, $la_where);
            $la_dataInsert = array();
            $la_dataUpdate = array();
            $la_dataWhere = array();
            
            if ($statement) {
                $la_dataExiste = $statement->result();
                $li_existe_archivo = $la_dataExiste[0]->existe_archivo;
                
                if($arg_dataIn["solicitud"] == 1){
                    if($li_existe_archivo > 0){
                        $la_dataUpdate = array(
                            "solicitud_empleo" => $arg_dataIn["solicitud_empleo"]
                        );
                        
                        $la_dataWhere = array(
                            "id_cliente" => $arg_dataIn["id_cliente"],
                            "id_persona_entidad" => $arg_dataIn["id_persona_entidad"]                            
                        );
                        $this->db->update('solicitud_empleo', $la_dataUpdate, $la_dataWhere);
                    }else{
                        $la_dataInsert = array(
                            "id_cliente" => $arg_dataIn["id_cliente"],
                            "id_persona_entidad" => $arg_dataIn["id_persona_entidad"],
                            "solicitud_empleo" => $arg_dataIn["solicitud_empleo"]
                        );
                        $this->db->insert('solicitud_empleo', $la_dataInsert);
                    }
                }else{
                    if($li_existe_archivo > 0){
                        $la_dataUpdate = array(
                            "nombre_archivo" => $arg_dataIn["nombre_archivo"],
                            "ruta_archivo" => $arg_dataIn["ruta_archivo"]
                        );
                        
                        $la_dataWhere = array(
                            "id_documento" => $arg_dataIn["id_documento"],
                            "id_candidato" => $arg_dataIn["id_candidato"]                           
                        );
                        
                        $this->db->update('documentos_candidatos', $la_dataUpdate, $la_dataWhere);
                    }else{
                        $la_dataInsert = array(
                            "id_documento" => $arg_dataIn["id_documento"],
                            "id_candidato" => $arg_dataIn["id_candidato"],
                            "nombre_archivo" => $arg_dataIn["nombre_archivo"],
                            "ruta_archivo" => $arg_dataIn["ruta_archivo"]
                        );
                        $this->db->insert('documentos_candidatos', $la_dataInsert);
                    }
                }
            }            
        } catch (Exception $exc) {
            $arg_mensaje = 'guardarDocumentosCandidato method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    
    /**
     * guardarRespuestasCuestionario
     * Se guardan las respuestas para sr calificadas por un administrador.
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function guardarRespuestasCuestionario($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn[0]["id_pregunta"], $arg_dataIn[0]["id_usuario"]);
            $ls_query = "SELECT 
                            IFNULL(MAX(intento), 0) + 1 AS intento
                         FROM 
                            respuestas
                         WHERE
                            (id_pregunta = ?)
                            AND(id_usuario = ?)"; 
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $la_dataMax = $statement->result();
                $li_intento_max = $la_dataMax[0]->intento;
                
                foreach($arg_dataIn as $data){
                    $data["intento"] = $li_intento_max;
                    $this->db->insert('respuestas', $data);
                }                
            }            
        } catch (Exception $exc) {
            $arg_mensaje = 'guardarRespuestasCuestionario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
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
                            vacantes.id_campana,
                            campana.id_cliente,
                            campanas_documentos.id_documento,
                            catalogo_docs_expediente.nombre_doc,
                            catalogo_docs_expediente.descripcion,
                            clientes.solicitud
                        FROM 
                            vacantes
                        INNER JOIN campana
                            ON(campana.id_campana = vacantes.id_campana)
                        INNER JOIN campanas_documentos
                            ON(campanas_documentos.id_campana = vacantes.id_campana)
                        INNER JOIN catalogo_docs_expediente
                            ON(catalogo_docs_expediente.id = campanas_documentos.id_documento)
                        INNER JOIN clientes
                            ON(clientes.id_cliente = campana.id_cliente)
                    WHERE 
                        (MD5(vacantes.id_vacante) = ?)
                    ORDER BY campanas_documentos.id_documento DESC ";
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
                            vacantes.id_campana AS id_campania,
                            vacantes.vacante,
                            vacantes.descripcion_vacante,
                            vacantes.salario_propuesto,
                            vacantes.estatus,
                            campana.id_cliente,
                            campana.campana,
                            campana.descripcion_campana,
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
                            INNER JOIN campana
                                ON(campana.id_campana = vacantes.id_campana)
                            INNER JOIN clientes
                                ON(clientes.id_cliente  = campana.id_cliente)
                            INNER JOIN cuestionarios
                                ON(cuestionarios.id_cuestionario = vacantes_cuestionarios.id_cuestionario)
                                AND(cuestionarios.id_cliente  = campana.id_cliente)
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
            $la_where = array($arg_dataIn['id_usuario'], $arg_dataIn['id_vacante_md5']);
            $ls_where = "";
            
            $ls_query = "SELECT
                            vacantes_cuestionarios.id_vacante,
                            vacantes_cuestionarios.id_cuestionario,
                            vacantes.vacante,
                            cuestionarios.titulo_cuestionario,
                            cuestionarios.descripcion_cuestionario,
                            cuestionarios.id_tipo_cuestionario,
                            cuestionarios.intentos,
                            (SELECT 
                                MAX(IFNULL(respuestas.intento, 0))
                            FROM 
                                respuestas
                                INNER JOIN preguntas
                                    ON(respuestas.id_pregunta = preguntas.id_pregunta)
                            WHERE 
                                (preguntas.id_cuestionario = cuestionarios.id_cuestionario)
                                AND(respuestas.id_usuario = ?) ) AS cantidad_intentos
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
                            vacantes.id_campana,
                            vacantes.vacante,
                            vacantes.descripcion_vacante,
                            campana.campana,
                            campana.id_cliente,
                            clientes.nombre,
                            clientes.descripcion_cliente,
                            clientes.logo,
                            clientes.solicitud
                        FROM 
                            personas_vacantes
                            INNER JOIN vacantes
                                ON(vacantes.id_vacante  = personas_vacantes.id_vacante)
                            INNER JOIN campana
                                ON(campana.id_campana  = vacantes.id_campana)
                            INNER JOIN clientes
                                ON(clientes.id_cliente = campana.id_cliente)
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
                            campanas_documentos.id_documento,
                            catalogo_docs_expediente.nombre_doc,
                            descripcion
                        FROM 
                            campanas_documentos
                            INNER JOIN catalogo_docs_expediente
                                ON(catalogo_docs_expediente.id = campanas_documentos.id_documento)
                        WHERE
                            (campanas_documentos.id_campana = ?)";
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
                            vacantes.id_campana AS id_campania,
                            vacantes.vacante,
                            vacantes.descripcion_vacante,
                            vacantes.salario_propuesto,
                            vacantes.estatus,
                            campana.id_cliente,
                            campana.campana,
                            campana.descripcion_campana,
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
                            INNER JOIN campana
                                ON(campana.id_campana = vacantes.id_campana)
                            INNER JOIN clientes
                                ON(clientes.id_cliente  = campana.id_cliente)
                            INNER JOIN cuestionarios
                                ON(cuestionarios.id_cuestionario = vacantes_cuestionarios.id_cuestionario)
                                AND(cuestionarios.id_cliente  = campana.id_cliente)
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
