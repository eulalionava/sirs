<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'IniciarSesion';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/***********************INICIAR SESIÓN*****************************************/
$route['restaurar-password']    = 'IniciarSesion/restaurarPassword';
$route['iniciar-sesion']        = 'IniciarSesion/procesarSesion';
$route['finalizar-sesion']      = 'IniciarSesion/finalizarSesion';


/**********************SOLICITUD EMPLEO****************************************/
$route['solicitud-empleo'] = 'SolicitudEmpleo';
$route['solicitud-empleo/continuar-tramite'] = 'SolicitudEmpleo/continuarTramite';
$route['solicitud-empleo/finalizar-proceso-solicitud'] = 'SolicitudEmpleo/finalizarProcesoSolicitud';
$route['solicitud-empleo/guardar-respuestas-cuestionario'] = 'SolicitudEmpleo/guardarRespuestasCuestinario';


/************************POSTULACIONES******************************************/
$route['mis-postulaciones']                         = 'MisPostulaciones';
$route['mis-postulaciones/ver-vacantes']            = 'MisPostulaciones/vacantesCandidato';
$route['mis-postulaciones/detalle-vacante']         = 'MisPostulaciones/detalleVacante';
$route['mis-postulaciones/cuestionarios-vacante']   = 'MisPostulaciones/cuestionariosVacante';
$route['mis-postulaciones/notificaciones']          = "MisPostulaciones/notificacionEntrevistas";

/*********************POSTULACIONES - CUESTIONARIOS*****************************/
$route['mis-postulaciones/detalle-cuestionario'] = 'MisPostulaciones/detalleCuestionario';

/*********************POSTULACIONES - DOCUMENTOS*********************************/
$route['mis-postulaciones/mostrar-documentos']      = 'MisPostulaciones/mostrarDocumentos';
$route['mis-postulaciones/cargar-documentos']       = 'MisPostulaciones/cargarDocumentos';
$route['mis-postulaciones/consultar-documentos']    = 'MisPostulaciones/consultarDocumentos';
$route['descargar-documento-candidato/(:any)']      = 'MisPostulaciones/descargarDocumento/$1';

/*********************POSTULACIONES - ENTREVISTA*********************************/
$route['mis-postulaciones/agendar-entrevista'] = 'MisPostulaciones/agendarEntrevista';
$route['mis-postulaciones/guardar-entrevista'] = 'MisPostulaciones/guardarEntrevista';


/*********************MI CUENTA*********************************/
$route['mi-cuenta'] = 'MiCuenta';
$route['mi-cuenta/datos-personales'] = 'MiCuenta/datosPersonales';
$route['mi-cuenta/cambiar-password'] = 'MiCuenta/cambiarPassword';
$route['mi-cuenta/cambiar-datos']    = 'MiCuenta/cambiarDatosPersonales';
$route['mi-cuenta/cambiar-pass']     = 'MiCuenta/passwordChange';


/************RECLUTAMIENTO Y SELECCIÓN***************************/
$route['reclutamiento-seleccion']                   = 'ReclutamientoSeleccion';
$route['reclutamiento-seleccion/generar-tokens']    = 'ReclutamientoSeleccion/generarTokens';


/**********************PANEL PRINCIPAL*****************************************/
$route['panel-principal'] = 'Principal';

/**********************RECLUTAMIENTO *********************************************/
$route['reclutamiento-general']                         = "Reclutamiento";
$route['reclutamiento-general/agendar-horario']         = "Reclutamiento/agenda";
$route['reclutamiento-general/ver-horario']             = 'Reclutamiento/verHorarios';
$route['reclutamiento-general/agenda-seleccionador']    = 'Reclutamiento/seleccionadores';
$route['reclutamiento-general/alta-entrevistador']      = "Reclutamiento/altaEntrevistador";
$route['reclutamiento-general/mostrar-seleccionadores'] = "Reclutamiento/showEntrevistadores";
$route['reclutamiento-general/editar-seleccionador']    = "Reclutamiento/bajaSeleccionador";
$route['reclutamiento-general/agenda-horarios']         = "Reclutamiento/agendarHorarios";

/********************* SELECCIONADORES****************************************** */
$route['seleccionadores/mi-agenda']                     = "Seleccionador/verMiAgenda";
$route['seleccionadores/entrevista-detalle']            = "Seleccionador/entrevistaDetalle";
$route['seleccionadores/agregar-comentario']            = "Seleccionador/agregarComentario";

/*********************** SEGUIMIENTO CANDIDATOS         ************************ */
$route['mis-candidatos/ver-candidatos']                 = "Reclutamiento/misCandidatos";
$route['mis-candidatos/vacantes-candidatos']            = "Reclutamiento/vacantesCandidatos";
$route['mis-candidatos/candidatos-cuestionarios']       = "Reclutamiento/cuestionariosCandidatos";
$route['mis-candidatos/candidatos-documentos']          = "Reclutamiento/documentosCandidatos";
$route['mis-candidatos/segimiento-vacante']             = "Reclutamiento/segimientoVacante";
$route['mis-candidatos/guardar-segimiento']             = "Reclutamiento/guardarSegimiento";




/*************************  ADMIN USUARIOS ****************************************** */
$route['admin-usuarios/ver-usuarios']                   = "AdminUsuarios/verUsuarios";
$route['admin-usuarios/nuevo-usuario']                  = "AdminUsuarios/nuevoUsuario";
$route['admin-usuarios/borrar-usuario']                 = "AdminUsuarios/borrarUsuario";
$route['admin-usuarios/editar-usuario']                 = "AdminUsuarios/editarUsuario";
$route['admin-usuarios/docs-candidatos']                = "AdminUsuarios/candidatosDocs";
$route['admin-usuarios/vacante-candidato']              = "AdminUsuarios/vacanteCandidato";
$route['admin-usuarios/docs-candidato']                 = "AdminUsuarios/guardarDocumentosCandidato";


/*************************VACANTES********************************************** */
$route['catalogo-general/ver-vacantes']                 ="Catalogos/verVacantes";
$route['catalogo-general/nueva-vacante']                = "Catalogos/vacante";
$route['catalogo-general/new-vacante']                  = "Catalogos/nuevaVacante";
$route['catalogo-general/eliminar-vacante']             = "Catalogos/eliminarVacante";
$route['catalogo-general/editar-vacante']               ="Catalogos/editarVacante";
$route['catalogo-general/asignar-vacante']              = "Catalogos/asignarViewVacante";
$route['catalogo-general/ver-documentos']               = "Catalogos/obtenerCuestionarios";
$route['catalogo-general/guardar-cuestionario']         = "Catalogos/guardarCuestionarios";


/*********************************** DOCUMENTOS ************************************* */
$route['catalogo-general/tipo-documento']               = "Documentos/documentos";
$route['catalogo-general/nuevo-documento']              = "Documentos/nuevoDocumento";
$route['catalogo-general/editar-documento']             = "Documentos/editarDocumento";


/************************************* CUESTIONARIOS ***************************************** */
$route['catalogo-general/tipo-cuestionario']            = "Cuestionarios/cuestionarios";
$route['catalogo-general/edit-cuestionario']            = "Cuestionarios/editarCuestionario";
$route['catalogo-general/nuevo-cuestionario']           = "Cuestionarios/nuevoCuestionario";
$route['catalogo-general/delete-cuestionario']          = "Cuestionarios/eliminarCuestionario";

/*************************************  ARCHIVOS ********************************************** */
$route['catalogo-general/tipo-archivos']      = "Archivos/verArchivos";
$route['catalogo-general/nuevo-tipo-archivo'] = "Archivos/nuevoTipoArchivo";

/**************************************** TOKENS ********************************************* */
$route['mis-candidatos/ver-tokes']                      = "ReclutamientoSeleccion/generarTokens";
$route['miscandidatos/generartoken']                    = "ReclutamientoSeleccion/crearToken";


/**************************************** DOCUMENTOS CAMPAÑAS ***************************************/
$route['admon-clientes/campana-documentos'] = "Documentos_campanas/getDocumentosCampanas";
$route['admon-clientes/guardar-campana-documentos'] = "Documentos_campanas/guardarDocumentosCampana";
