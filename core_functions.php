<?php
//Funcion para el manejo de la fecha y hora
/**
* Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script 
*/
date_default_timezone_set('America/Guatemala');

/**
* Funcion para verificar un cadena json
*/

function isJson($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}

/**
* Funcion para sanear (Limpiar) cadenas de texto
*/

function sanear_string($strString) {
    $strString = trim($strString); 
    $strString = str_replace( array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $strString );
    $strString = str_replace( array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $strString );
    $strString = str_replace( array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $strString );
    $strString = str_replace( array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $strString );
    $strString = str_replace( array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $strString );
    $strString = str_replace( array('ñ', 'Ñ', 'ç', 'Ç', '*', 'select', 'insert', 'update', ';', '/*', '*/', 'delete', 'create', '--', 'execute', 'exect', 'backup', 'restore'), array('n', 'N', 'c', 'C', '', '', '', '', '', '', '', '', '', '', '', '', '', ''), $strString );
    $strString = str_replace(array('UPDATE', 'INSERT', 'DELETE', 'CREATE', 'EXECUTE', 'EXECT', 'BACKUP', 'RESTORE'), array('','','','','','','',''), $strString);
	$strString = str_replace("'", "", $strString);
	$strString = strtoupper($strString);

    return $strString;
}

function _sanearEstadisticas($strString) {
    $strString = trim($strString); 
    $strString = str_replace( array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $strString );
    $strString = str_replace( array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $strString );
    $strString = str_replace( array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $strString );
    $strString = str_replace( array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $strString );
    $strString = str_replace( array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $strString );
    $strString = str_replace( array('ñ', 'Ñ', 'ç', 'Ç', '*', 'select', 'insert', 'update', ';', '/*', '*/', 'delete', 'create', '--', 'execute', 'exect', 'backup', 'restore', ' '), array('n', 'N', 'c', 'C', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'), $strString );
    $strString = strtolower($strString);
    return $strString;
}

/**
* Aplica un formato de fecha 
*/
function _dateFormat($strFecha = ""){

    $date = date_create($strFecha);
    return date_format($date, 'd/m/Y');
}

function _dateFormatAlter($strFecha = ""){

    $date = date_create($strFecha);
    return date_format($date, 'd-m-Y H:i:s');
}

//Funciones de desarrollo
/**
* Muestra información estructurada sobre una o más expresiones incluyendo su tipo y valor. 
*/
function _debug($strContenido = ""){
    if($strContenido == "" or $strContenido == null or $strContenido == false){
         var_dump($strContenido);
    }
    else {
        echo "<pre>";
        var_dump($strContenido);
        echo "</pre>";
    }
}

//Funciones para manejo de sesiones
/**
* Inicia la sesion
*/
function _sessionStart(){
    session_start();
}

/**
* Cierra la sesion
*/
function _sessionClose(){
    session_destroy();
}

//Funciones para OCI8
/**
* Conecta a una base de datos de Oracle
*/
function _connectDB(){
    //$remoto = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.200.9.207)(PORT = 1521)) (CONNECT_DATA = (SID = COMBEXDESA)))"; //COMBEXDESA //COMBEXIM
    $remoto = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)) (CONNECT_DATA = (SID = ORCL)))"; //COMBEXDESA //COMBEXIM
	$conexion = oci_connect("fernando", "guatemala", $remoto, 'AL32UTF8');

	if (!$conexion) {
		$strError = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	} else {
		return $conexion;
	}

}
/**
* Cierra una conexión a Oracle
*/
function _coleConnectDB() {
	global $conexion;
	oci_close($conexion);
}
	
/**
* Realiza una consulta cualquiera a la base de datos
*/
function _query($strConsulta = ""){
    
    $conexion = _connectDB();
    
   

    $consulta = oci_parse($conexion, $strConsulta); 
    oci_execute($consulta);

    $arrData = array();

    while($arrTMP = oci_fetch_array($consulta)){
        $arrData[] = $arrTMP;
        
    }
    return $arrData;
}
/**
* Devuelve la siguiente fila de una consulta como un array asociativo o numérico
*/
function _fetchArray($qTMP = ""){
    if($qTMP){
        return oci_fetch_array($qTMP);
    }
    else{
        return false;
    }
}

 //Utilizar en combinacion con _queryNoCommit para realizar consultas dentro de transacciones. 
function _fetch($strConsulta = "", $conexion){
    $consulta = oci_parse($conexion, $strConsulta); 
    oci_execute($consulta, OCI_NO_AUTO_COMMIT);
    $arrData = array();
    while($arrTMP = oci_fetch_array($consulta)){
        $arrData[] = $arrTMP;
    }
    return $arrData;
}
 //Utilizar para hacer consultas que no se confirmarán para realizar transacciones.
function _queryNoCommit($strConsulta = "", $conexion){
    $consulta = oci_parse($conexion, $strConsulta); 
    $r = oci_execute($consulta, OCI_NO_AUTO_COMMIT);
   if (!$r) {    
        $e = oci_error($consulta);
        throw new Exception($e['message']);
    }
}


function _queryRollback($conexion){
    oci_rollback($conexion);
    oci_close($conexion);
}
function _queryCommit($conexion){
    oci_commit($conexion);	
    oci_close($conexion);
}

function _insert($strConsulta)
{
    $conexion = _connectDB();
    $consulta = oci_parse($conexion, $strConsulta); 
    //$r = oci_execute($consulta);
	$r = oci_execute($consulta,OCI_DEFAULT);
	if (!$r) {
		$e = oci_error($consulta);  // Para errores de oci_execute, pase el gestor de sentencia
		oci_rollback($conexion);
		oci_close($conexion);
		throw new Exception($e['message']);
	}
	oci_commit($conexion);	
	oci_close($conexion);
}

function cleanObject($object){
	$returnObject = [];
	foreach ($object as $key => $value) {
		$returnObject[$key] = sanear_string($value);
    }
	return (object)$returnObject;
}



function sanear_parametro($strString) {

    $strString = strtoupper(trim($strString));
    $strString = strip_tags($strString); 
    $strString = filter_var($strString,FILTER_SANITIZE_STRING); 

    $strString = str_replace(array('UPDATE', 'INSERT', 'DELETE', 'CREATE', 'EXECUTE', 'EXECT', 'BACKUP', 'RESTORE'
                                   ,'NOT'  , 'ALL'   , '='     , '<'     , '>'      , ';'    , '/*'    , '*/' 
                                   ,'--'   , '*')
                            , array('','','','','','','','','','','','','','','','','',''), $strString);

    $strString = str_replace("'", "", $strString);

    return $strString;
}

/*

include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/usuarios/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/formularios/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/marcajes/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/estadisticas/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/gafetes/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/pagos/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/manifiestos/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/guias/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/peatonal/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/home.php"; //03-06-2016
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/reports/function.php"; //03-06-2016
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/sat/function.php"; //17-02-2017
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/cafeteria/function.php"; //20-03-2017
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/autorizaciones/function.php"; //23-06-2017
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/preferencias/function.php"; //22-08-2017
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/gth/function.php"; //22-08-2017
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/encuesta/function.php"; //27-10-2017 JorgeChete
include_once $_SERVER['DOCUMENT_ROOT']."/consultas/module/activosfijos/function.php"; 
*/
?>