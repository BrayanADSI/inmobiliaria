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
        <title> Formulario CANON </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
	
    <body>
        <header>
			
        <h1>Formulario Canon</h1>
          
             <?php
               $formulario = "canon";
               include_once("menu.php");
            ?> 
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr>
                    <th scope = "col">Valor del arriendoCanon</th> 
                    <th scope = "col">fecha </th>
                    <th scope = "col">Forma de Pago</th>
                    <th scope = "col">id del arriendo </th>
                    <th scope = "col">opciones</th>
                </tr>
                
  <?php
    include_once("../modelo/conexion.php");
                $objetoConexion = new conexion();
                $conexion = $objetoConexion->conectar();
                
    include_once("../modelo/arriendo.php"); 
    $objetoarriendo =  new arriendo ($conexion,0,'Fecha_Arriendo','id_Cedula_Cliente_Arriendo','id_inmobiliario_Arriendo','id_Tipo_Arriendo');
    $listaarriendo= $objetoarriendo->listar(0);
                
    include_once("../modelo/canon.php");
    $objetocanon =  new canon($conexion,'idCanon','valor arriendo','fecha','forma de pago','arriendo');
    $listacanon = $objetocanon->listar(0);
	
	$permiso =  $objetocanon->getRol($_SESSION['id']);
	
	if (stripos($permiso,"r")!==false){
	
    while($unRegistro = mysqli_fetch_array($listacanon)){
        echo '<tr><form id="fModificarcanon"'.$unRegistro["idCanon"].' action="../controlador/Controladorcanon.php" method="post">';
        echo '<td><input type="hidden" name="fidCanon"  value="'.$unRegistro['idCanon'].'">';
        echo '    <input type="text" name="fvalorArriendoCanon"  value="'.$unRegistro['valorArriendoCanon'].'"></td>';
        echo '<td><input type="date" name="ffechaCanon"  value="'.$unRegistro['fechaCanon'].'"></td>';
        echo '<td><input type="text" name="fForma_Pago"  value="'.$unRegistro['Forma_Pago'].'"></td>';
        echo '<td><select name="fidArriendoCanon">';
         while($otroRegistro = mysqli_fetch_array($listaarriendo)){
             echo"<option value='".$otroRegistro['id_Arriendo']."'"; 
             if ($unRegistro['idArriendoCanon']==$otroRegistro['id_Arriendo']){
               echo " selected "; 
            }
            echo  ">id=".$otroRegistro['id_Arriendo'].",fecha=".$otroRegistro['Fecha_Arriendo']."</option>";  
                        
        }
        mysqli_data_seek($listaarriendo,0);
        
        echo'</select></td>';
        if (stripos($permiso,"u")!==false){
        echo '<td><button class="btn btn-info" type="submit" name="fEnviar"  value="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
			}  //fin permiso u
		if (stripos($permiso,"d")!==false){
             echo '<button  class="btn btn-danger" type="submit" name="fEnviar"  value="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
			}  //fin permiso d
        echo '</form></tr>';
     } //fin while
	}//fin permiso r
 ?>
 <?php
if (stripos($permiso,"c")!==false){  
?>               
       <tr><form id="fIngresarcanon" action="../controlador/Controladorcanon.php" method="post">
           <td><input type="hidden" required name="fidCanon">
              <input type="text" required name="fvalorArriendoCanon"></td>
           <td><input type="date" name="ffechaCanon"></td>
           <td><input type="text" required name="fForma_Pago"></td>
           <td><select name="fidArriendoCanon">
               <?php
                 while($otroRegistro = mysqli_fetch_array($listaarriendo)){
                      echo "<option value='".$otroRegistro['id_Arriendo']."'>id=".$otroRegistro['id_Arriendo'].",fecha=".$otroRegistro['Fecha_Arriendo']."</option>"; 
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
         mysqli_free_result($listacanon);
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