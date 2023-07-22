<?php

include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data['nombre'];
$apellido = $data['apellido'];
$cedula = $data['cedula'];
$email = $data['email'];
$password = $data['password'];
$municipio = $data['municipio'];
$direccion = $data['direccion'];
$telefono = $data['telefono'];

/* $nombre = "Pepito";
$apellido = "Perez";
$cedula = "98765435";
$email = "pep@correo.com";
$password = "123456";
$municipio = "Cerete";
$direccion = "Cra 5# 45";
$telefono = "3008765678"; */

$passwordX = md5($password);

$consulta = "INSERT INTO cliente(nombre, apellido, cedula, email, password, municipio, direccion, telefono)
   VALUES('" . $nombre . "','" . $apellido . "','" . $cedula . "','" . $email . "','" . $passwordX . "','" . $municipio . "','" . $direccion . "','" . $telefono . "')";

mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

mysqli_close($conexion);
