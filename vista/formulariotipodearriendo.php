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
        <title> Formulario Tipo de Arriendo</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <header>
        <h1>Formulario Tipo de Arriendo</h1>
            <?php
               $formulario = "tipoarriendo";
               include_once("menu.php");
            ?>  
            
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr> 
                  <th scope = "col">descripcionarriendo</th>
                   <th scope = "col">opciones</th>
                </tr>
                
 <?php
    include_once("../modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();

      include_once("../modelo/tipodearriendo.php"); 
     $objetotipoarriendo =  new tipoarriendo     ($conexion,0,'fdescripcionarriendo');
      $listatipoarriendo= $objetotipoarriendo->listar(0);
	
	$permiso = $objetotipoarriendo->getRol($_SESSION['id']);
	
	
	if (stripos($permiso,"r")!==false){
    while($unRegistro = mysqli_fetch_array($listatipoarriendo)){
        echo '<tr><form idtipodearriendo="fModificatipoarriendo"'.$unRegistro["idtipodearriendo"].' action="../controlador/Controladortipodearriendo.php" method="post">';
        echo '<input type="hidden" name="fidtipodearriendo"  value="'.$unRegistro['idtipodearriendo'].'">';
        echo '<td><input type="text" name="fdescripcionarriendo"  value="'.$unRegistro['descripcionarriendo'].'"></td>';
           echo '<td>';
		
		if (stripos($permiso,"u")!==false){
		echo '<button class="btn btn-info" type="submit" name="fEnviar"
		value="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
		}  //fin permiso u
		
		if (stripos($permiso,"d")!==false){
        echo '<button class="btn btn-danger" type="submit" name="fEnviar" 
		value="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
		}  //fin permiso d
        echo '</form></tr>';
    } //fin while
	}//fin permiso r
 ?>

<?php
if (stripos($permiso,"c")!==false){  
?>

        <tr><form id="fingresartipodearriendo" action="../controlador/Controladortipodearriendo.php" method="post">
         <td><input type="hidden" name="fidtipodearriendo" value="0">
            <input type="text" name="fdescripcionarriendo"></td>

      
            
        <td><button class="btn btn-warning" type="reset" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-repeat"aria-hidden="true"></span></button>
   <button class="btn btn-success dropdown-toggle"  type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
   </form></tr>
    </tbody>
        </table>
        <?php
	}//fin permiso c
         mysqli_free_result($listatipoarriendo);
        $objetoConexion->desconectar($conexion);
        ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
	</div>  
</html>
<?php
  }else{
 header ("location:../index.php");
}  
?>    