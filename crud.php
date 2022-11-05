<?php 

    include("core_functions.php");

    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");
	header('Content-Type: application/json; charset=utf-8');


    try {
        if (isset($_GET["FUNC"])) {
            $tipo = $_GET["FUNC"];
            if($tipo==1){
                echo consultar1();
            }else if($tipo==2){
                echo consultar2();
            }else if($tipo=="cursos"){
                echo cursos();
            }else{
                $message = array(
                    "error" => "No existe este tipo de funcion"
                );
        
                http_response_code(500);
                echo json_encode($message);
            }
          
        }else{
            $message = array(
                "error" => "No trae parametro"
            );
    
            http_response_code(500);
            echo json_encode($message);

        }
      } catch (Exception $e) {
          echo $e->getMessage();
      }



    function consultar1(){

    $conexion = _connectDB();
    $strConsulta = "SELECT
    hola,
    adios
FROM
    table1 order by hola desc";
    
		$arrConsulta = _query($strConsulta);

		$consulta = oci_parse($conexion, $strConsulta);
		$r = oci_execute($consulta);
		
		if (!$r){
			$e = oci_error($consulta);
			throw new Exception($e['message']);
		}

        $data = array(
			"data" => $arrConsulta,
            "otra"=> $arrConsulta,
		);
		
		echo json_encode($data,JSON_NUMERIC_CHECK);
    }

    function consultar2(){

        $conexion = _connectDB();
        $strConsulta = "SELECT 'SIMON PUTA' HOLA FROM DUAL";
        
            $arrConsulta = _query($strConsulta);
    
            $consulta = oci_parse($conexion, $strConsulta);
            $r = oci_execute($consulta);
            
            if (!$r){
                $e = oci_error($consulta);
                throw new Exception($e['message']);
            }
    
            $data = array(
                "data" => $arrConsulta
            );
            
            echo json_encode($data,JSON_NUMERIC_CHECK);
        }

        function cursos(){

            $conexion = _connectDB();
            $strConsulta = "SELECT
            id_curso,
            nombre,
            descripcion,
            id_ciclo
        FROM
            curso";
            
                $arrConsulta = _query($strConsulta);
        
                $consulta = oci_parse($conexion, $strConsulta);
                $r = oci_execute($consulta);
                
                if (!$r){
                    $e = oci_error($consulta);
                    throw new Exception($e['message']);
                }
        
                $data = array(
                    "data" => $arrConsulta
                );
            
            echo json_encode($data,JSON_NUMERIC_CHECK);
        }


?>