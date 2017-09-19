<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/auditoria.php");

$opcion = $_POST["fEnviar"];
$idauditoria = $_POST["fidauditoria"];
$fechaauditoria = $_POST["ffechaauditoria"];
$descripcionauditoria = $_POST["fdescripcionauditoria"];
$idusuariosauditorias = $_POST["fidusuariosauditorias"];

$fechaauditoria = htmlspecialchars($fechaauditoria);
$descripcionauditoria = htmlspecialchars($descripcionauditoria);
$idusuariosauditorias = htmlspecialchars($idusuariosauditorias);


$objetoauditoria = new auditoria($conexion,$idauditoria,$fechaauditoria,$descripcionauditoria,$idusuariosauditorias);

switch($opcion){
    case 'Ingresar':
        $objetoauditoria->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetoauditoria->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetoauditoria->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);
header ("location:../vista/formularioauditoria.php?=$mensaje");
?>