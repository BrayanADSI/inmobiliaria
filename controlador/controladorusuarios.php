<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/usuarios.php");

$opcion = $_POST["fEnviar"];
$idusuarios = $_POST["fidusuarios"];
$nombreusuario = $_POST["fnombreusuario"];
$emailusuario = $_POST["femailusuario"];
$claveusuario = $_POST["fclaveusuario"];
$celularusuario = $_POST["fcelularusuario"];
$fecharegistrousuario = $_POST["ffecharegistrousuario"];
$fechaultimaclave = $_POST["ffechaultimaclave"];
$idrolesusuarios = $_POST["fidrolesusuarios"];

$nombreusuario = htmlspecialchars($nombreusuario);
$emailusuario = htmlspecialchars($emailusuario);
$claveusuario = htmlspecialchars($claveusuario);
$celularusuario = htmlspecialchars($celularusuario);
$fecharegistrousuario = htmlspecialchars($fecharegistrousuario);
$fechaultimaclave = htmlspecialchars($fechaultimaclave);
$idrolesusuarios = htmlspecialchars($idrolesusuarios);

$objetousuarios = new usuarios($conexion,$idusuarios,$nombreusuario,$emailusuario, $claveusuario, $celularusuario, $fecharegistrousuario, $fechaultimaclave, $idrolesusuarios);

switch($opcion){
    case 'Ingresar':
        $objetousuarios->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetousuarios->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetousuarios->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);
header ("location:../vista/formulariousuarios.php?=$mensaje");
?>