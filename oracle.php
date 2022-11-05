<?php 
 //echo "ss";
    include("http://10.238.20.206/consultas/php/core_functions.php");
    //readfile("https://globalbmgt.com/gbm/conexion.php");
    //$file = include('https://globalbmgt.com/gbm/conexion.php');
//echo $file[0];

//$arr = token_get_all(file_get_contents('http://10.238.20.206/consultas/php/core_functions.php'));
//var_dump($arr);
// output: array[ 0 => "test_func"]

    $conn=_connectDB();
    //$conn = oci_connect('3.138.128.128', 'username', 'password') ;

    //echo file_get_contents("https://globalbmgt.com/gbm/conexion.php");
    $stid = oci_parse($conn, 'SELECT * FROM employees');
//oci_execute($stid);
?>
