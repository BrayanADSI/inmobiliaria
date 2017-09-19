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
        <title> Formulario Inmobiliario </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        
        <header>
        <h1>Formulario Inmobiliario</h1>
          <?php
               $formulario = "inmobiliario";
               include_once("menu.php");
            ?> 
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr>
                    <th scope = "col">Id del Inmobiliario</th> 
                   <th scope = "col">Descripcion del Inmobiliario</th>
                    <th scope = "col">Direccion del Inmobiliario</th>
                    <th scope = "col">Gps del Inmobiliario</th>
                    <th scope = "col">Opciones</th>
                </tr>
                
  <?php
    include_once("../modelo/conexion.php");
                $objetoConexion = new conexion();
                $conexion = $objetoConexion->conectar();
                
    include_once("../modelo/inmobiliario.php");
    $objetoInmobiliario =  new inmobiliario($conexion,'id inmobiliario','descripcion','direccion','gps');
    $listaInmobiliario = $objetoInmobiliario->listar(0);
	
	$permiso = $objetoInmobiliario->getRol($_SESSION['id']);
	
	if (stripos($permiso,"r")!==false){
	
    while($unRegistro = mysqli_fetch_array($listaInmobiliario)){
        echo '<tr><form id="fModificarInmobiliario"'.$unRegistro["idInmobiliario"].' action="../controlador/ControladorInmobiliario.php" method="post">';
        echo '<td><input type="number" name="fIdInmobiliario"  value="'.$unRegistro['idInmobiliario'].'"></td>';
        echo '<td><input type="text" name="fDescripcionInmobiliario" value="'.$unRegistro['descripcionInmobiliario'].'"></td>';
        echo '<td><input type="text" name="fDireccionInmobiliario" value="'.$unRegistro['direccionInmobiliario'].'"></td>';
        echo '<td><input type="text" name="fGpsInmobiliario"  value="'.$unRegistro['GpsInmobiliario'].'"></td>';
		
		if (stripos($permiso,"u")!==false){
        echo '<td><button class="btn btn-info" type="submit" name="fEnviar"  value="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
		   }  //fin permiso u
		
		if (stripos($permiso,"d")!==false){
            echo  '<button class="btn btn-danger" type="submit" name="fEnviar"  value="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
		}  //fin permiso d	
        echo '</form></tr>';
    } //fin while
	}//fin permiso r
 ?>
			<?php
			if (stripos($permiso,"c")!==false){  
			?>
                
       <tr><form id="fIngresarInmobiliario" action="../controlador/ControladorInmobiliario.php" method="post">
           <td><input type="number" required name="fIdInmobiliario"></td>
           <td><input type="text" required name="fDescripcionInmobiliario"></td>
           <td><input type="text" name="fDireccionInmobiliario"></td>
           <td><input type="text" required name="fGpsInmobiliario"></td>
           <td><button class="btn btn-warning" type="reset" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-repeat"aria-hidden="true"></span></button>
           <button class="btn btn-success dropdown-toggle"  type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
           </form></tr>
            </tbody>
        </table>
        <?php
		}//fin permiso c		
         mysqli_free_result($listaInmobiliario);
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