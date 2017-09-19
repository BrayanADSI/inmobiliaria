<?php

$emailusuario = $_POST ["femailusuario"];
$claveusuario = $_POST ["fclaveusuario"];
     
include_once("../modelo/conexion.php");
$objetoConexion =new conexion();
$conexion =$objetoConexion->conectar();

$emailusuario =mysqli_real_escape_string ($conexion, $emailusuario);

include_once ("../modelo/login.php");
$objetoLogin = new Login($conexion, $emailusuario, $claveusuario);
 $usuarioEsValido = $objetoLogin-> verificarusuarios();

if ($usuarioEsValido==true){
	session_start ();

	$_SESSION ['id']      = $objetoLogin->getidusuarios();
	$_SESSION ['nombre']  = $objetoLogin->getnombreusuario();
	$_SESSION ['rol']     = $objetoLogin->getrolesusuarios();
	$objetoConexion->desconectar($conexion);
   header ("location:../vista/formularioCliente.php");
} else{
	$objetoConexion->desconectar($conexion);
    header ("location:../index.php?mensaje=incorrecto");
}
?>


    

     
     
     
    