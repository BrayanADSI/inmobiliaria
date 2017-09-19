<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/inmobiliario.php");

$opcion = $_POST["fEnviar"];
$idInmobiliario = $_POST["fIdInmobiliario"];
$descripcionInmobiliario = $_POST["fDescripcionInmobiliario"];
$direccionInmobiliario = $_POST["fDireccionInmobiliario"];
$GpsInmobiliario = $_POST["fGpsInmobiliario"];

$descripcionInmobiliario = htmlspecialchars($descripcionInmobiliario);
$direccionInmobiliario = htmlspecialchars($direccionInmobiliario);
$direccionInmobiliario = htmlspecialchars ($direccionInmobiliario);
$GpsInmobiliario = htmlspecialchars($GpsInmobiliario);


$objetoInmobiliario = new inmobiliario($conexion,$idInmobiliario,$descripcionInmobiliario,$direccionInmobiliario,$GpsInmobiliario);

switch($opcion){
    case 'Ingresar':
        $objetoInmobiliario->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetoInmobiliario->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetoInmobiliario->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);

header ("location:../vista/formularioInmobiliario.php?=$mensaje");
?>