<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/roles.php");

$opcion = $_POST["fEnviar"];
$idroles = $_POST["fidroles"];
$nombrerol = $_POST["fnombrerol"];
$clienteroles = $_POST["fclienteroles"];
$tipodearriendoroles = $_POST["ftipodearriendoroles"];
$abonosroles = $_POST["fabonosroles"];
$deudasroles = $_POST["fdeudasroles"];
$arriendoroles = $_POST["farriendoroles"];
$pagosroles = $_POST["fpagosroles"];
$inmobiliarioroles = $_POST["finmobiliarioroles"];
$canonroles = $_POST["fcanonroles"];
$usuariosroles = $_POST["fusuariosroles"];
$auditoriasroles = $_POST["fauditoriasroles"];
$rolesroles = $_POST["frolesroles"];

$nombrerol = htmlspecialchars($nombrerol);
$clienteroles = htmlspecialchars($clienteroles);
$tipodearriendoroles = htmlspecialchars($tipodearriendoroles);
$abonosroles = htmlspecialchars($abonosroles);
$deudasroles = htmlspecialchars($deudasroles);
$arriendoroles = htmlspecialchars($arriendoroles);
$pagosroles = htmlspecialchars($pagosroles);
$inmobiliarioroles = htmlspecialchars($inmobiliarioroles);
$canonroles = htmlspecialchars($canonroles);
$usuariosroles = htmlspecialchars($usuariosroles);
$auditoriasroles = htmlspecialchars($auditoriasroles);
$rolesroles= htmlspecialchars($rolesroles);


$objetoroles = new roles($conexion,$idroles,$nombrerol,$clienteroles,$tipodearriendoroles,$abonosroles,$deudasroles,$arriendoroles,$pagosroles,$inmobiliarioroles,$canonroles,$usuariosroles,$auditoriasroles,$rolesroles);

switch($opcion){
    case 'Ingresar':
        $objetoroles->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetoroles->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetoroles->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);
header ("location:../vista/formularioroles.php?=$mensaje");
?>