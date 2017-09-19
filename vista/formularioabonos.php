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
        <title> Formulario Abonos</title>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>

    <body>
        <header>
           
        <h1>Formulario Abonos</h1>
             <?php
               $formulario = "abono";
               include_once("menu.php");
            ?>
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr> 
                    <th scope = "col">ID DEL ABONO</th>
                  <th scope = "col">VALOR ABONO</th>
                  <th scope = "col">FECHA ABONO</th>
                  <th scope = "col">ID DEUDAS ABONO</th>
                   <th scope = "col">OPCIONES</th>
                </tr>
                
 <?php
    include_once("../modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
                
    include_once("../modelo/deudas.php"); 
     $objetodeudas =  new deudas ($conexion,'idDeudas','valorDeuda','fechaDeuda','saldoDeuda','idPagosDeudas');
      $listadeudas= $objetodeudas->listar(0);

     include_once("../modelo/abonos.php"); 
     $objetoabonos =  new abonos ($conexion,'idabonos','valorabono','fechaabono','iddeudasabonos');
      $listaabonos= $objetoabonos->listar(0);
	
	$permiso = $objetoabonos->getRol($_SESSION['id']);
	
	if (stripos($permiso,"r")!==false){
	
    while($unRegistro = mysqli_fetch_array($listaabonos)){
        echo '<tr><form idabonos="fModificaabonos"'.$unRegistro["idabonos"].' action="../controlador/Controladorabonos.php" method="post">';
        echo '<td><input type="number" name="fidabonos"  value="'.$unRegistro['idabonos'].'"></td>';
        echo '<td><input type="number" name="fvalorabono"  value="'.$unRegistro['valorabono'].'"></td>';
        echo '<td><input type="date" name="ffechaabono"  value="'.$unRegistro['fechaabono'].'"></td>';
        echo '<td> <select name="fiddeudasabonos">';
        while($otroRegistro = mysqli_fetch_array($listadeudas)){
         echo "<option value='".$otroRegistro['idDeudas']."'";
            if ($unRegistro['iddeudasabonos']==$otroRegistro['idDeudas']){
               echo " selected ";
            }
         echo  ">{$otroRegistro['valorDeuda']}</option>";  
        }
        mysqli_data_seek($listadeudas,0);
		
       echo '</select> </td>';
        if (stripos($permiso,"u")!==false){
           echo '<td><button  class="btn btn-info"  type="submit" name="fEnviar"  value="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
		   }  //fin permiso u
		
		if (stripos($permiso,"d")!==false){
        echo '<button type="submit" class="btn btn-danger" name="fEnviar"  value="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
		}  //fin permiso d
        echo '</form></tr>';
    } //fin while
	}//fin permiso r
 ?>
				
<?php
if (stripos($permiso,"c")!==false){  
?>
 
        <tr><form id="fingresarabonos" action="../controlador/Controladorabonos.php" method="post">
            <td><input type="number" name="fidabonos" value="0"></td>
            <td><input type="number" name="fvalorabono"></td>
           <td><input type="date" name="ffechaabono"></td>
            <td><select name="fiddeudasabonos">
                <?php
               while($otroRegistro = mysqli_fetch_array($listadeudas)){
                echo "<option value='".$otroRegistro['idDeudas']."'>
                  {$otroRegistro['valorDeuda']}</option>";
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
         mysqli_free_result($listaabonos);
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