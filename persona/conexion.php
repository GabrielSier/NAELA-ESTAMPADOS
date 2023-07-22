<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$hostname='localhost';
$database='persona';
$username='root';
$password='';

$conexion=new mysqli($hostname,$username,$password,$database);

if($conexion->connect_errno){
    echo "El sitio web está experimentando problemas";
}

?>