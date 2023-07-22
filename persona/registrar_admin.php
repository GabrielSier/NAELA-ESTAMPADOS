<?php

include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data['nombre'];
$apellido = $data['apellido'];
$cedula = $data['cedula'];
$email = $data['email'];
$password = $data['password'];
$direccion = $data['direccion'];
$codigo = $data['codigo'];
$turno = $data['turno'];

/* $nombre = "Juan";
$apellido = "Lopez";
$cedula = "49876543";
$email = "loju@correo.com";
$password = "123456";
$direccion = "Cra 13# 45";
$codigo = "ADM1001";
$turno = "Tarde"; */

$passwordX = md5($password);

$consulta = "INSERT INTO administrador(nombre, apellido, cedula, email, password, direccion, codigo, turno)
   VALUES('" . $nombre . "','" . $apellido . "','" . $cedula . "','" . $email . "','" . $passwordX . "','" . $direccion . "','" . $codigo .  "','" . $turno . "')";

mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

mysqli_close($conexion);
