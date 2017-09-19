<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/arriendo.php");

$opcion = $_POST["fEnviar"];
$id_Arriendo = $_POST["fid_Arriendo"];
$Fecha_Arriendo = $_POST["fFecha_Arriendo"];
$id_Cedula_Cliente_Arriendo = $_POST["fid_Cedula_Cliente_Arriendo"];
$id_inmobiliario_Arriendo = $_POST["fid_inmobiliario_Arriendo"];
$id_Tipo_Arriendo = $_POST["fid_Tipo_Arriendo"];

$Fecha_Arriendo = htmlspecialchars($Fecha_Arriendo);
$id_Cedula_Cliente_Arriendo = htmlspecialchars($id_Cedula_Cliente_Arriendo);
$id_inmobiliario_Arriendo = htmlspecialchars($id_inmobiliario_Arriendo);
$id_Tipo_Arriendo = htmlspecialchars($id_Tipo_Arriendo);


$objetoarriendo = new arriendo($conexion,$id_Arriendo,$Fecha_Arriendo,$id_Cedula_Cliente_Arriendo,$id_inmobiliario_Arriendo,$id_Tipo_Arriendo);

switch($opcion){
    case 'Ingresar':
        $objetoarriendo->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetoarriendo->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetoarriendo->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);
header ("location:../vista/formularioarriendo.php?=$mensaje");
?>