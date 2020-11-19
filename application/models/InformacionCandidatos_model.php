<?php

class InformacionCandidatos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * obtenerEntrevistaCandidato
     * Se obtienen los datos de la entrevista a la que aplicó el candidato.
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerEntrevistaCandidato($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn["id_persona_entidad"]);
            $ls_query = "SELECT 
                            entrevista.id_usuario_entrevistador,
                            entrevista.fecha_entrevista, 
                            YEAR(entrevista.fecha_entrevista) AS anio, 
                            MONTH(entrevista.fecha_entrevista) AS mes,
                            DAY(entrevista.fecha_entrevista) AS dia,
                            DAYOFWEEK(entrevista.fecha_entrevista) AS dia_semana,
                            DATE_FORMAT(entrevista.hora_entrevista, '%H:%i') AS hora_entrevista,
                            entrevista.descripcion_entrevista,
                            CONCAT(personas_entidades.nombres, ' ', personas_entidades.apellido_paterno, ' ', personas_entidades.apellido_materno) AS entrevistador,
                            personas_entidades.ruta_foto,
                            personas_entidades.numero_telefono,
                            personas_entidades.correo_electronico
                        FROM 
                            entrevista
                            INNER JOIN personas_entidades
                                ON(personas_entidades.id_persona_entidad  = entrevista.id_usuario_entrevistador)
                        WHERE
                            fecha_entrevista >= '".$arg_dataIn['fecha_entrevista']."'
                        AND
                            (entrevista.id_persona_entidad = ?) ";  
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerEntrevistaCandidato method does not work. Exception: ' . $exc->getTraceAsString();
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
    public function guardarEntrevistaCandidato($arg_dataIn,&$arg_dataOut, &$arg_mensaje) {
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
    
    /**
     * obtenerHorariosEntrevista
     * Se obtienen los horarios en que aplicarán entrevistas
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function obtenerHorariosEntrevista($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array();
            $ls_query = "SELECT 
                            SHA2(e.id_entrevista, 224) AS id_entrevista, 
                            e.fecha_entrevista, 
                            YEAR(e.fecha_entrevista) AS anio, 
                            MONTH(e.fecha_entrevista) AS mes,
                            DAY(e.fecha_entrevista) AS dia,
                            DAYOFWEEK(e.fecha_entrevista) AS dia_semana,
                            DATE_FORMAT(e.hora_entrevista, '%H:%i') AS hora_entrevista                            
                        FROM 
                            entrevista e, (SELECT DISTINCT  fecha_entrevista FROM entrevista WHERE id_persona_entidad=0 AND fecha_entrevista>=DATE(NOW()) GROUP BY fecha_entrevista ORDER BY fecha_entrevista LIMIT 2) e2
                        WHERE 
                            (e.id_persona_entidad = 0)
                            AND(e.fecha_entrevista IN(e2.fecha_entrevista) ) 
                        GROUP BY e.fecha_entrevista, e.hora_entrevista     
                        ORDER BY e.fecha_entrevista, e.hora_entrevista";
                      
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerHorariosEntrevista method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * Entrevistadores activos
     */
    public function entrevitadorsActivos(&$arg_data,&$arg_mensaje){
        try {
            $ls_query = "SELECT 
                        pe.id_persona_entidad
                        FROM personas_entidades pe INNER JOIN perfiles_accesos pa 
                            ON pe.tipo_persona_entidad = pa.id_perfil_acceso 
                        WHERE pe.tipo_persona_entidad = 3 
                        AND pe.status_persona_entidad = 3;";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_data = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'verHorarios method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * entrevistandoCandidato
     * Verificacion ,si se encuentra en entrevista el entrevistador
     */
    public function entrevistandoCandidato($datos,$entrevistador,&$arg_data,&$arg_mensaje){
        try {
            
            $ls_query = "SELECT *  FROM entrevista 
                        WHERE id_usuario_entrevistador = $entrevistador 
                        AND fecha_entrevista = '".$datos['fecha']."' ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_data = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'entrevistandoCandidato method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }
    
    /**
     * consultarDocumentoDescarga
     * Se obtienen el documento o solicitud para descargar
     * @param Array  $arg_dataIn parámetros para condicionar consultas.
     * @param String $arg_dataOut parámetro de salida para retornar datos.
     * @param String $arg_mensaje
     * @return int 
     */
    public function consultarDocumentoDescarga($arg_dataIn, &$arg_dataOut, &$arg_mensaje) {
        try {
            $la_where = array($arg_dataIn["id_archivo"]);
            if($arg_dataIn["tipo_archivo"] == 'S'){
                $ls_query = "SELECT 
                                solicitud_empleo AS ruta_archivo
                            FROM 
                                solicitud_empleo
                            WHERE 
                                (SHA2(id_solicitud_empleo, 224)  = ?)";  
            }else{
                $ls_query = "SELECT 
                                ruta_archivo AS ruta_archivo
                            FROM 
                                documentos_candidatos
                            WHERE 
                                (SHA2(id_documento_candidato , 224)  = ?)";  
            }
                      
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'consultarDocumentoDescarga method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
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
            $la_where = array();
            $ls_query = "SELECT 
                            -1 AS id_documento,
                            CONCAT(SHA2(solicitud_empleo.id_solicitud_empleo, 224),'S') AS hash_documento
                        FROM 
                            solicitud_empleo
                        WHERE 
                            (id_cliente = ".$arg_dataIn['id_cliente'].")
                            AND(id_persona_entidad  = ".$arg_dataIn['id_persona_entidad'].")
                    UNION
                        SELECT 
                            documentos_candidatos.id_documento AS id_documento,
                            CONCAT(SHA2(documentos_candidatos.id_documento_candidato, 224),'F') AS hash_documento
                        FROM 
                            documentos_candidatos
                        WHERE 
                            (documentos_candidatos.id_documento IN(".$arg_dataIn['id_documento']."))
                            AND(documentos_candidatos.id_candidato = ".$arg_dataIn['id_persona_entidad'].") ";            
            $statement = $this->db->query($ls_query, $la_where);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'consultarDocumentos method does not work. Exception: ' . $exc->getTraceAsString();
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
