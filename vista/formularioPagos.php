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
        <title> Formulario Pagos </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
  
    <body>
        <header>
        <h1>Formulario Pagos</h1>
             <?php
               $formulario = "pagos";
               include_once("menu.php");
            ?> 
            
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr>
                    <th scope = "col">Id Pagos</th> 
                    <th scope = "col">Valor del Pago </th>
                    <th scope = "col">Fecha del Pago</th>
                    <th scope = "col">Id Canon Pagos </th>
                    <th scope = "col">opciones</th>
                </tr>
                
  <?php
    include_once("../modelo/conexion.php");
                $objetoConexion = new conexion();
                $conexion = $objetoConexion->conectar();
                
    include_once("../modelo/canon.php");
    $objetocanon =  new canon($conexion,'idCanon','valor arriendo','fecha','forma de pago','arriendo');
    $listacanon = $objetocanon->listar(0);
                
    include_once("../modelo/pagos.php"); 
    $objetoPagos =  new pagos ($conexion,'idPagos','valorPago','fechaPago','idCanonPagos');
    $listaPagos= $objetoPagos->listar(0);
	
	$permiso = $objetoPagos->getRol($_SESSION['id']);
	
	if (stripos($permiso,"r")!==false){
	
	
    while($unRegistro = mysqli_fetch_array($listaPagos)){
        echo '<tr><form id="fModificarPagos"'.$unRegistro["idPagos"].' action="../controlador/ControladorPagos.php" method="post">';
        echo '<td><input type="number" name="fidPagos"  value="'.$unRegistro['idPagos'].'"></td>';
        echo '<td><input type="number" name="fvalorPago"      value="'.$unRegistro['valorPago'].'"></td>';
        echo '<td><input type="date" name="ffechaPago"  value="'.$unRegistro['fechaPago'].'"></td>';
        echo '<td><select name="fidCanonPagos">'; 
             while($otroRegistro = mysqli_fetch_array($listacanon)){
                echo '<option  value="'.$otroRegistro['idCanon'].'"';
                 if($unRegistro['idCanonPagos']== $otroRegistro['idCanon']){
                  echo " selected ";
                 }
                 echo ">".$otroRegistro['idCanon'].'</option>';  
                        
        }
        mysqli_data_seek($listacanon,0);
        
        echo'</select></td>';
		if (stripos($permiso,"u")!==false){
        echo '<td><button class="btn btn-info" type="submit" name="fEnviar"  value="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
		 }  //fin permiso u
		if (stripos($permiso,"d")!==false){
            echo  '<button class="btn btn-danger" type="submit"  name="fEnviar"  value="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
			}  //fin permiso d
        echo '</form></tr>';
   } //fin while
	}//fin permiso r
 ?>
		<?php
		if (stripos($permiso,"c")!==false){  
		?>				

       <tr><form id="fIngresarPagos" action="../controlador/ControladorPagos.php" method="post">
           <td>  <input type="number" required name="fidPagos"></td>
           <td>  <input type="number" required name="fvalorPago"></td>
           <td>  <input type="date"   name="ffechaPago"></td>
           <td>  <select name="fidCanonPagos">
           <?php
            while($otroRegistro = mysqli_fetch_array($listacanon)){
                echo '<option  value="'.$otroRegistro['idCanon'].'"> '.$otroRegistro['idCanon'].'</option>'; 
            }
                        ?>
               </select></td>
           <td>  <button class="btn btn-warning" type="reset" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-repeat"aria-hidden="true"></span></button>
                 <button class="btn btn-success dropdown-toggle" type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
           </form></tr>
            </tbody>
        </table>
        <?php
			}//fin permiso c
         mysqli_free_result($listacanon);
         mysqli_free_result($listaPagos);
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