<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/abonos.php");

$opcion = $_POST["fEnviar"];
$idabonos = $_POST["fidabonos"];
$valorabono = $_POST["fvalorabono"];
$fechaabono = $_POST["ffechaabono"];
$iddeudasabonos = $_POST["fiddeudasabonos"];


$valorabono = htmlspecialchars($valorabono);
$fechaabono = htmlspecialchars($fechaabono);
$iddeudasabonos = htmlspecialchars($iddeudasabonos);


$objetoabonos= new abonos($conexion,$idabonos,$valorabono,$fechaabono,$iddeudasabonos);

switch($opcion){
    case 'Ingresar':
        $objetoabonos->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetoabonos->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetoabonos->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);
header ("location:../vista/formularioabonos.php?=$mensaje");
?>