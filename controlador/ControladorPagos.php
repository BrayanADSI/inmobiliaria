<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/pagos.php");

$opcion = $_POST["fEnviar"];
$idPagos = $_POST["fidPagos"];
$valorPago = $_POST["fvalorPago"];
$fechaPago = $_POST["ffechaPago"];
$idCanonPagos = $_POST["fidCanonPagos"];



$valorPago = htmlspecialchars($valorPago);
$fechaPago = htmlspecialchars($fechaPago);
$idCanonPagos = htmlspecialchars ($idCanonPagos);




$objetoPagos = new pagos($conexion,$idPagos,$valorPago,$fechaPago,$idCanonPagos);

switch($opcion){
    case 'Ingresar':
        $objetoPagos->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetoPagos->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetoPagos->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);

header ("location:../vista/formularioPagos.php?=$mensaje");
?>