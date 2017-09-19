<!DOCTYPE html>
<?php
session_start ();
if (isset($_SESSION ['id'])){
?>
<html>
	<div class="container">
    <head>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <meta charset =  "utf-8">
        <title> Formulario Roles</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    
    <body>
        <header>
        <h1>Formulario Roles</h1>
          <?php
               $formulario = "roles";
               include_once("menu.php");
            ?>  
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr> 
                  <th scope = "col">nombrerol</th>
                  <th scope = "col">clienteroles</th>
                  <th scope = "col">tipodearriendoroles</th>
                  <th scope = "col">abonosroles</th>
                  <th scope = "col">deudasroles</th>
                  <th scope = "col">arriendoroles</th>
                  <th scope = "col">pagosroles</th>
                  <th scope = "col">inmobiliarioroles</th>
                  <th scope = "col">canonroles</th>
                  <th scope = "col">usuariosroles</th>
                  <th scope = "col">auditoriasroles</th>
                  <th scope = "col">rolesroles</th>
                   <th scope = "col">opciones</th>
                </tr>
                
 <?php
    include_once("../modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();

     include_once("../modelo/roles.php"); 
     $objetoroles =  new roles ($conexion,0,'nombrerol','clienteroles','tipodearriendoroles','abonosroles','deudasroles','arriendoroles','pagosroles','inmobiliarioroles','canonroles','usuariosroles','auditoriasroles','rolesroles');
      $listaroles = $objetoroles->listar(0);
	
	$permiso = $objetoroles->getRol($_SESSION['id']);
	
	if (stripos($permiso,"r")!==false){
		
    while($unRegistro = mysqli_fetch_array($listaroles)){
        echo '<tr><form idroles="fModificarroles"'.$unRegistro["idroles"].' action="../controlador/Controladorroles.php" method="post">';
        echo '<input type="hidden" name="fidroles"  value="'.$unRegistro['idroles'].'">';
        echo '<td><input type="text" name="fnombrerol"  value="'.$unRegistro['nombrerol'].'"></td>';
        echo '<td><input type="text" name="fclienteroles"  value="'.$unRegistro['clienteroles'].'"></td>';
        echo '<td><input type="text" name="ftipodearriendoroles"  value="'.$unRegistro['tipodearriendoroles'].'"></td>';
        echo '<td><input type="text" name="fabonosroles"  value="'.$unRegistro['abonosroles'].'"></td>';
        echo '<td><input type="text" name="fdeudasroles"  value="'.$unRegistro['deudasroles'].'"></td>';
        echo '<td><input type="text" name="farriendoroles"  value="'.$unRegistro['arriendoroles'].'"></td>';
        echo '<td><input type="text" name="fpagosroles"  value="'.$unRegistro['pagosroles'].'"></td>';
        echo '<td><input type="text" name="finmobiliarioroles"  value="'.$unRegistro['inmobiliarioroles'].'"></td>';
        echo '<td><input type="text" name="fcanonroles"  value="'.$unRegistro['canonroles'].'"></td>';
        echo '<td><input type="text" name="fusuariosroles"  value="'.$unRegistro['usuariosroles'].'"></td>';
        echo '<td><input type="text" name="fauditoriasroles"  value="'.$unRegistro['auditoriasroles'].'"></td>';
        echo '<td><input type="text" name="frolesroles"  value="'.$unRegistro['rolesroles'].'"></td>';
		
		if (stripos($permiso,"u")!==false){
        echo '<td><button class="btn btn-info" type="submit" name="fEnviar"  value="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
		 }  //fin permiso u
		
		if (stripos($permiso,"d")!==false){
        echo '<button class="btn btn-danger" type="submit" name="fEnviar"  value="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
			}  //fin permiso d
        echo '</form></tr>';
     } //fin while
	}//fin permiso r
 ?>
 
				
				<?php
if (stripos($permiso,"c")!==false){  
?>
        <tr><form id="fingresarroles" action="../controlador/Controladorroles.php" method="post">
         <td><input type="hidden" name="fidroles" value="0">
            <input type="text" name="fnombrerol"></td>
           <td><input type="text" name="fclienteroles"></td>
            <td><input type="text" name="ftipodearriendoroles"></td>
            <td><input type="text" name="fabonosroles"></td>
            <td><input type="text" name="fdeudasroles"></td>
            <td><input type="text" name="farriendoroles"></td>
            <td><input type="text" name="fpagosroles"></td>
            <td><input type="text" name="finmobiliarioroles"></td>
            <td><input type="text" name="fcanonroles"></td>
            <td><input type="text" name="fusuariosroles"></td>
            <td><input type="text" name="fauditoriasroles"></td>
            <td><input type="text" name="frolesroles"></td>
            
        <td><button class="btn btn-warning" type="reset" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-repeat"aria-hidden="true"></span></button>
   <button class="btn btn-success dropdown-toggle" type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
   </form></tr>
    </tbody>
        </table>
        <?php
	}//fin permiso c
         mysqli_free_result($listaroles);
        $objetoConexion->desconectar($conexion);
        ?>
		
		<!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
      </div>  
</html>
  <?php
  }else{
 header ("location:../index.php");
}  
?>  