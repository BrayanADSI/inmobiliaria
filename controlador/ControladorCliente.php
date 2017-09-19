<?php
include_once ("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/cliente.php");

$opcion = $_POST["fEnviar"];
$idcedulaCliente = $_POST["fIdcedulaCliente"];
$nombreCliente = $_POST["fNombreCliente"];
$telefonoCliente = $_POST["fTelefonoCliente"];
$direccionCliente = $_POST["fDireccionCliente"];
$emailCliente = $_POST["fEmailCliente"];
$fechaRegistroCliente = $_POST["fFechaRegistroCliente"];

$nombreCliente = htmlspecialchars($nombreCliente);
$telefonoCliente = htmlspecialchars($telefonoCliente);
$direcionCliente = htmlspecialchars ($direccionCliente);
$emailCliente = htmlspecialchars($emailCliente);
$fechaRegistroCliente = htmlspecialchars($fechaRegistroCliente);


$objetoCliente = new cliente($conexion,$idcedulaCliente,$nombreCliente,$telefonoCliente,$direccionCliente,$emailCliente,$fechaRegistroCliente);

switch($opcion){
    case 'Ingresar':
        $objetoCliente->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetoCliente->modificar ();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetoCliente->eliminar();
        $mensaje = "Eliminar";
        break;
}
$objetoconexion->desconectar($conexion);

header ("location:../vista/formularioCliente.php?=$mensaje");
?>

<? 
function salir() 
{ 
$accion = $_POST['Accion']; 
if($accion=="salir") 
{ 
echo " <script>"; 
echo "<a href=index.php></a>"; 
echo "</script> "; 
}} 
?> 