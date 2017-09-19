<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/tipodearriendo.php");

$opcion = $_POST["fEnviar"];
$idtipodearriendo = $_POST["fidtipodearriendo"];
$descripcionarriendo = $_POST["fdescripcionarriendo"];

$idtioipodearriendo = htmlspecialchars($idtipodearriendo);
$descripcionarriendo = htmlspecialchars($descripcionarriendo);

$objetotipoarriendo = new tipoarriendo($conexion,$idtipodearriendo,$descripcionarriendo);

switch($opcion){
    case 'Ingresar':
        $objetotipoarriendo->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetotipoarriendo->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetotipoarriendo->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);
//header ("location:../vista/formulariotipodearriendo.php?=$mensaje");
?>