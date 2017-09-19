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
        <title> Formulario Usuarios</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <header>
        <h1>Formulario Usuarios</h1>
            <?php
               $formulario = "usuarios";
               include_once("menu.php");
            ?>  
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr> 
                  <th scope = "col">nombreusuario</th>
                  <th scope = "col">emailusuario</th>
                  <th scope = "col">claveusuario</th>
                  <th scope = "col">celularusuario</th>
                  <th scope = "col">fecharegistrousuario</th>
                  <th scope = "col">fechaultimaclave</th>
                  <th scope = "col">idrolesusuarios</th>
                   <th scope = "col">opciones</th>
                </tr>
                
 <?php
    include_once("../modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
                
    include_once("../modelo/roles.php"); 
     $objetoroles =  new roles ($conexion,0,'nombrerol','clienteroles','tipodearriendoroles','abonosroles','deudasroles','arriendoroles','pagosroles','inmobiliarioroles','canonroles','usuariosroles','auditoriasroles','rolesroles');            
     $listaroles = $objetoroles->listar(0);
                
     include_once("../modelo/usuarios.php"); 
     $objetousuarios =  new usuarios ($conexion,0,'nombreusuiario','emailusuario','claveusuario','celularusuario','fecharegistrousuario','fechaultimaclave','idroles');
      $listausuarios= $objetousuarios->listar(0);
	
	$permiso = $objetousuarios->getRol($_SESSION['id']);
	
	if (stripos($permiso,"r")!==false){
		
    while($unRegistro = mysqli_fetch_array($listausuarios)){
        echo '<tr><form idusuarios="fModificarusuarios"'.$unRegistro["idusuarios"].' action="../controlador/Controladorusuarios.php" method="post">';
        echo '<input type="hidden" name="fidusuarios"  value="'.$unRegistro['idusuarios'].'">';
        echo '<td><input type="text" name="fnombreusuario"  value="'.$unRegistro['nombreusuario'].'"></td>';
        echo '<td><input type="text" name="femailusuario"  value="'.$unRegistro['emailusuario'].'"></td>';
        echo '<td><input type="text" name="fclaveusuario"  value="'.$unRegistro['claveusuario'].'"></td>';
        echo '<td><input type="text" name="fcelularusuario"  value="'.$unRegistro['celularusuario'].'"></td>';
        echo '<td><input type="date" name="ffecharegistrousuario"  value="'.$unRegistro['fecharegistrousuario'].'"></td>';
        echo '<td><input type="date" name="ffechaultimaclave"  value="'.$unRegistro['fechaultimaclave'].'"></td>';
        echo '<td><select name="fidrolesusuarios">';
          while($otroRegistro = mysqli_fetch_array($listaroles)){ 
            echo "<option value='".$otroRegistro['idroles']."'";
             if ($unRegistro['idrolesusuarios']==$otroRegistro['idroles']){
               echo " selected "; 
         }
                        echo  ">{$otroRegistro['nombrerol']}</option>";  
                     }
                          mysqli_data_seek($listaroles,0);   
        
        echo '<select></td>';
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
        <tr><form id="fingresarusuarios" action="../controlador/Controladorusuarios.php" method="post">
         <td><input type="hidden" name="fidusuarios" value="0">
            <input type="text" name="fnombreusuario"></td>
           <td><input type="text" name="femailusuario"></td>
            <td><input type="text" name="fclaveusuario"></td>
            <td><input type="text" name="fcelularusuario"></td>
            <td><input type="date" name="ffecharegistrousuario"></td>
            <td><input type="date" name="ffechaultimaclave"></td>
            <td><select name="fidrolesusuarios">
                <?php
               while($otroRegistro = mysqli_fetch_array($listaroles)){ 
                echo "<option value='".$otroRegistro['idroles']."'>
                 {$otroRegistro['nombrerol']}</option>"; 
                    }
                    ?>
                </select></td>
      
            
        <td><button class="btn btn-warning" type="reset" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-repeat"aria-hidden="true"></span></button>
   <button class="btn btn-success dropdown-toggle" type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
   </form></tr>
    </tbody>
        </table>
		
        <?php
	}//fin permiso c
         mysqli_free_result($listausuarios);
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
?>s   