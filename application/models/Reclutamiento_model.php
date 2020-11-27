<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reclutamiento_model extends CI_Model {    
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

     /**
      * guardarHorario
      * Guarda los horarios establecidos para entrevista
      */
    public function guardarHorario($datos,&$arg_mensaje){

        try{

            foreach($datos as $item){

                $la_data = array(
                    'id_usuario_entrevistador'  =>$item['id_entrevistador'],
                    'id_persona_entidad'        =>0,
                    'fecha_entrevista'          =>$item['fecha'],
                    'hora_entrevista'           =>$item['hora']
                );
    
                $this->db->insert('entrevista',$la_data);
            }

            $la_update = Array(
                "status_persona_entidad"=>1
            );
            $la_where = Array(
                "id_persona_entidad"=>$datos[0]['id_entrevistador']
            );

            $this->db->update("personas_entidades",$la_update,$la_where);


        }catch(Exception $e){

            $arg_mensaje = 'guardarHorario method does not work. Exception: ' . $e->getTraceAsString();
            return -1;

        }

        return 1;
    }
    /**
     * verHorarios
     * Muestra todos los horarios
     */

    public function verHorariosAgendados($fecha,&$arg_data,&$arg_mensaje){
        try {
            $ls_query = "SELECT * FROM entrevista WHERE fecha_entrevista = '".$fecha."'
                        AND id_persona_entidad = 0 
                        ORDER BY hora_entrevista ;";  
                                  
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
     * getEntrevistadores
     * Obtiene todos lo entrevistadores que son de tipo seleccionador
     */
    public function getEntrevistadores(&$arg_data,&$arg_mensaje){

        try {
            $ls_query = "SELECT 
                            pe.id_persona_entidad,
                            pe.nombres,
                            pe.apellido_paterno,
                            pe.apellido_materno,
                            pe.rfc,
                            pe.correo_electronico,
                            pe.genero_sexual,
                            pe.ruta_foto,
                            pe.numero_telefono,
                            pe.status_persona_entidad
                            FROM personas_entidades pe 
                            INNER JOIN perfiles_accesos pa 
                                ON pe.tipo_persona_entidad = pa.id_perfil_acceso 
                            WHERE pe.tipo_persona_entidad = 3";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_data = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getEntrevistadores method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    public function getSeleccionados(&$arg_data,&$arg_mensaje){

        try {
            $ls_query = "SELECT 
                        pe.id_persona_entidad,
                        pe.nombres,
                        pe.apellido_paterno,
                        pe.apellido_materno,
                        pe.rfc,
                        pe.correo_electronico,
                        pe.genero_sexual,
                        pe.ruta_foto,
                        pe.numero_telefono,
                        pe.status_persona_entidad
                        FROM personas_entidades pe 
                        INNER JOIN perfiles_accesos pa 
                            ON pe.tipo_persona_entidad = pa.id_perfil_acceso 
                        WHERE pe.tipo_persona_entidad = 3 
                        AND pe.status_persona_entidad = 3 ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_data = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getEntrevistadores method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * agregarEntre
     * Se agregaran entrevistadores que estaran antentos a entrevistas pendientes
     */
    public function agregarEntre($arg_data,&$arg_mensaje){
        try{

            foreach($arg_data as $valor){
                $la_update = Array(
                    "status_persona_entidad"=>3
                );
                $la_where = Array(
                    "id_persona_entidad"=>$valor
                );
    
                $this->db->update("personas_entidades",$la_update,$la_where);
    
            }

        }catch(Exception $e){
            $arg_mensaje = 'agregarEntre method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
    }
    /**
     * bajaSeleccinador
     * Cambia de estatus ,despues de agendar sus horarios de entrevista
     */
    public function bajaSeleccinador($id,&$arg_mensaje){
        try{

            $la_update = Array(
                "status_persona_entidad"=>1
            );
            $la_where = Array(
                "id_persona_entidad"=>$id
            );

            $this->db->update("personas_entidades",$la_update,$la_where);
    

        }catch(Exception $e){
            $arg_mensaje = 'bajaSeleccinador method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
    }

    /**
     * getAllCandidatos
     * Obtiene todos los candidatos
     */

     public function getAllCandidatos(&$arg_data,&$arg_mensaje){
        try{

            $ls_query = "SELECT 
                            pe.id_persona_entidad,
                            pe.nombres,
                            pe.apellido_paterno,
                            pe.apellido_materno,
                            pe.rfc,
                            pe.correo_electronico,
                            pe.genero_sexual,
                            pe.tipo_persona_entidad,
                            pe.ruta_foto,
                            pe.status_persona_entidad
                        FROM personas_entidades pe
                        WHERE pe.tipo_persona_entidad = 5 
                        AND pe.status_persona_entidad = 1; ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_data = $statement->result();
            } else {
                return -1;
            }
    

        }catch(Exception $e){
            $arg_mensaje = 'getAllCandidatos method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;

     }

     public function vacantesPorCandidato($id_entidad,&$dataOut,&$arg_mensaje){
        try{

            $ls_query = "SELECT 
                            pe.id_persona_entidad,
                            vacantes.id_vacante,
                            vacantes.vacante,
                            clientes.nombre,
                            pv.id_persona_vacante,
                            pv.id_status
                        FROM personas_entidades pe 
                        INNER JOIN personas_vacantes pv 
                            ON pe.id_persona_entidad = pv.id_persona_entidad
                        INNER JOIN vacantes 
                            ON  pv.id_vacante=vacantes.id_vacante
                        INNER JOIN campana 
                            ON vacantes.id_campana=campana.id_campana
                        INNER JOIN clientes 
                            ON campana.id_cliente=clientes.id_cliente  
                        WHERE pe.id_persona_entidad = $id_entidad 
                        AND vacantes.estatus = 1; ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
                $arg_mensaje = $ls_query;
            } else {
                return -1;
            }
        }catch(Exception $e){
            $arg_mensaje = 'vacantesPorCandidato method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
     }

     /**
      * cuastionariosCandidato
      * Obtiene los cuastionarios del candidato por vacante
      */
    
    public function cuastionariosCandidato($dataIn,&$dataOut,&$arg_mensaje){
        try{

            $ls_query = "SELECT
                            vacantes_cuestionarios.id_vacante_cuestionario,
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
                                AND (respuestas.id_usuario = '".$dataIn['id_usuario']."' )) AS cantidad_intentos
                        FROM 	
                            vacantes_cuestionarios
                            INNER JOIN vacantes
                                ON(vacantes.id_vacante = vacantes_cuestionarios.id_vacante)
                            INNER JOIN cuestionarios
                                ON(cuestionarios.id_cuestionario = vacantes_cuestionarios.id_cuestionario)
                        WHERE 
                            vacantes_cuestionarios.id_vacante = '".$dataIn['id_vacante']."'
                            ORDER BY vacantes_cuestionarios.id_vacante_cuestionario DESC ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }
    

        }catch(Exception $e){
            $arg_mensaje = 'getAllCandidatos method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
    }

    public function obtenerDocumentosCandidato($dataIn,&$dataOut,&$arg_mensaje){
        try{

            $ls_query = "SELECT 
                            vacantes.id_vacante,
                            vacantes.id_campana,
                            campana.id_cliente,
                            campanas_documentos.id_documento,
                            documentos_candidatos.nombre_archivo,
                            documentos_candidatos.ruta_archivo,
                            catalogo_docs_expediente.nombre_doc,
                            catalogo_docs_expediente.descripcion,
                            clientes.solicitud
                        FROM 
                            vacantes
                        INNER JOIN campana
                            ON(campana.id_campana = vacantes.id_campana)
                        INNER JOIN campanas_documentos
                            ON(campanas_documentos.id_campana = vacantes.id_campana)
                        INNER JOIN documentos_candidatos
                            ON(campanas_documentos.id_documento = documentos_candidatos.id_documento)
                        INNER JOIN catalogo_docs_expediente
                            ON(catalogo_docs_expediente.id = campanas_documentos.id_documento)
                        INNER JOIN clientes
                            ON(clientes.id_cliente = campana.id_cliente)
                        WHERE 
                            (vacantes.id_vacante = '".$dataIn['id_vacante']."')
                        ORDER BY campanas_documentos.id_documento DESC ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }
    

        }catch(Exception $e){
            $arg_mensaje = 'getAllCandidatos method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
    }

    public function segimiento($dataIn,&$dataOut,&$arg_mensaje){
        try{

            $ls_query = "SELECT 
                            pe.id_persona_entidad,
                            pv.id_persona_vacante,
                            upe.id_usuario,
                            pe.nombres,
                            pe.apellido_paterno,
                            pe.apellido_materno,
                            vacantes.vacante 
                        FROM personas_vacantes pv 
                        INNER JOIN personas_entidades pe 
                            ON pv.id_persona_entidad = pe.id_persona_entidad
                        INNER JOIN usuarios_personas_entidades upe
							ON pe.id_persona_entidad = upe.id_persona_entidad
                        INNER JOIN vacantes 
                            ON pv.id_vacante = vacantes.id_vacante
                        WHERE pv.id_persona_vacante = '".$dataIn['id_persona_vacante']."';";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $dataOut = $statement->result();
            } else {
                return -1;
            }

        }catch(Exception $e){
            $arg_mensaje = 'getAllCandidatos method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
    }

    public function guardarSegimiento($dataIn,&$arg_mensaje){
        try{

            $la_data = Array(
                "id_persona_entidad"    => intval($dataIn['id_persona']),
                "id_vacante"            => intval($dataIn['id_vacante']),
                "id_usuario"            => intval($dataIn['id_usuario']),
                "estatus"               => intval($dataIn['estatus']),
                "fecha_hora"            => Date('Y-m-d: h:m:s')
            );

            $this->db->insert("seguimiento",$la_data);

        }catch(Exception $e){
            $arg_mensaje = 'guardarSegimiento method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
    }


    
}