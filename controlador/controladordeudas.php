<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/deudas.php");

$opcion = $_POST["fEnviar"];
$idDeudas = $_POST["fidDeudas"];
$valorDeuda = $_POST["fvalorDeuda"];
$fechaDeuda = $_POST["ffechaDeuda"];
$saldoDeuda = $_POST["fsaldoDeuda"];
$idPagosDeudas = $_POST["fidPagosDeudas"];

$valorDeuda = htmlspecialchars($valorDeuda);
$fechaDeuda = htmlspecialchars($fechaDeuda);
$saldoDeuda = htmlspecialchars($saldoDeuda);
$idPagosDeudas = htmlspecialchars($idPagosDeudas);


$objetodeudas= new deudas($conexion,$idDeudas,$valorDeuda,$fechaDeuda,$saldoDeuda, $idPagosDeudas);

switch($opcion){
    case 'Ingresar':
        $objetodeudas->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetodeudas->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetodeudas->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);
header ("location:../vista/formulariodeudas.php?=$mensaje");
?>