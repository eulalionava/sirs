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

    
}