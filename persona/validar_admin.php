<?php

include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$password = $data['password'];

/* $email="loju@correo.com";
$password="123456"; */

$passwordX = md5($password);

$sentencia = $conexion->prepare("SELECT * FROM administrador WHERE email=? AND password=?");
$sentencia->bind_param('ss', $email, $passwordX);
$sentencia->execute();

$resultado = $sentencia->get_result();

if ($fila = $resultado->fetch_assoc()) {
         echo json_encode($fila,JSON_UNESCAPED_UNICODE);     
}

$sentencia->close();
$conexion->close();

?>