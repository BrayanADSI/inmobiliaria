<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/canon.php");

$opcion = $_POST["fEnviar"];
$idCanon = $_POST["fidCanon"];
$valorArriendoCanon = $_POST["fvalorArriendoCanon"];
$fechaCanon = $_POST["ffechaCanon"];
$Forma_Pago = $_POST["fForma_Pago"];
$idArriendoCanon = $_POST["fidArriendoCanon"];


$valorArriendoCanon = htmlspecialchars($valorArriendoCanon);
$fechaCanon = htmlspecialchars($fechaCanon);
$Forma_Pago = htmlspecialchars ($Forma_Pago);
$idArriendoCanon = htmlspecialchars($idArriendoCanon);



$objetocanon = new canon($conexion,$idCanon,$valorArriendoCanon,$fechaCanon,$Forma_Pago,$idArriendoCanon);

switch($opcion){
    case 'Ingresar':
        $objetocanon->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetocanon->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetocanon->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);

header ("location:../vista/formulariocanon.php?=$mensaje");
?>