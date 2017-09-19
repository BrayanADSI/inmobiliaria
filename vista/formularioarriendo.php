
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
        <title> Formulario Arriendo</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>

        <header>
        <h1>Formulario Arriendo</h1>
            <?php
			   $pagina = isset($_GET['pag'])?$_GET['pag']:1;    //agregar esto junto con el codigo de paginacion
               $formulario = "arriendo";
               include_once("menu.php");
            ?>
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr> 
                  <th scope = "col">Fecha del arriendo</th>
                  <th scope = "col">Cedula del cliente</th>
                  <th scope = "col">id del inmobiliario</th>
                     <th scope = "col">id del Tipo de Arriendo</th>
                   <th scope = "col">opciones</th>
                </tr>
                
 <?php
    include_once("../modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
                
                             
    include_once("../modelo/cliente.php");
    $objetoCliente =  new cliente($conexion,'cedula','nombre','telefono','direccion','email','registro');
    $listaClientes = $objetoCliente->listar(0);
                
    include_once("../modelo/inmobiliario.php");
    $objetoInmobiliario =  new inmobiliario($conexion,'id inmobiliario','descripcion','direccion','gps');
    $listaInmobiliario = $objetoInmobiliario->listar(0);
                
    
      include_once("../modelo/tipodearriendo.php"); 
     $objetotipoarriendo =  new tipoarriendo     ($conexion,0,'fdescripcionarriendo');
      $listatipoarriendo= $objetotipoarriendo->listar(0);            
                
      
     include_once("../modelo/arriendo.php"); 
     $objetoarriendo =  new arriendo ($conexion,0,'Fecha_Arriendo','id_Cedula_Cliente_Arriendo','id_inmobiliario_Arriendo','id_Tipo_Arriendo');
     $listaarriendo= $objetoarriendo->listar($pagina);   //$pagina va con el codigo de paginacion
				
	$permiso = $objetoarriendo->getRol($_SESSION['id']);
	
	
	
	if (stripos($permiso,"r")!==false){
	
	
    while($unRegistro = mysqli_fetch_array($listaarriendo)){
        echo '<tr><form id_Arriendo="fModificaarriendo"'.$unRegistro["id_Arriendo"].' action="../controlador/Controladorarriendo.php" method="post">';
        echo '<input type="hidden" name="fid_Arriendo"  value="'.$unRegistro['id_Arriendo'].'">';
        echo '<td><input type="text" name="fFecha_Arriendo"  value="'.$unRegistro['Fecha_Arriendo'].'"></td>';
        echo '<td><select name="fid_Cedula_Cliente_Arriendo">';
         while($otroRegistro = mysqli_fetch_array($listaClientes)){
             echo"<option value='".$otroRegistro['idcedulaCliente']."'"; 
             if ($unRegistro['id_Cedula_Cliente_Arriendo']==$otroRegistro['idcedulaCliente']){
               echo " selected "; 
               }
                        echo  ">{$otroRegistro['idcedulaCliente']}</option>";  
                     }
                          mysqli_data_seek($listaClientes,0);   
        echo'<select></td>';
        
        echo '<td><select name="fid_inmobiliario_Arriendo">';
         while($inmobiliariaRegistro = mysqli_fetch_array($listaInmobiliario)){
           echo "<option value='".$inmobiliariaRegistro['idInmobiliario']."'";  
              if ($unRegistro['id_inmobiliario_Arriendo']==$inmobiliariaRegistro['idInmobiliario']){
               echo " selected "; 
         }
                        echo  ">{$inmobiliariaRegistro['descripcionInmobiliario']}</option>";  
                     }
                          mysqli_data_seek($listaInmobiliario,0);   
       echo '</select></td>';
         echo '<td><select name="fid_Tipo_Arriendo">';
           while($arriendoRegistro = mysqli_fetch_array($listatipoarriendo)){
              echo "<option value='".$arriendoRegistro['idtipodearriendo']."'";  
                if ($unRegistro['id_Tipo_Arriendo']==$arriendoRegistro['idtipodearriendo']){
               echo " selected "; 
                     }
                        echo  ">{$arriendoRegistro['descripcionarriendo']}</option>";  
                     }
                          mysqli_data_seek($listatipoarriendo,0);
         
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
				
        <tr><form id="fingresararriendo" action="../controlador/Controladorarriendo.php" method="post">
         <td><input type="hidden" name="fid_Arriendo" value="0">
            <input type="date" name="fFecha_Arriendo"></td>
           <td><select name="fid_Cedula_Cliente_Arriendo">
                <?php
               while($otroRegistro = mysqli_fetch_array($listaClientes)){
                echo "<option value='".$otroRegistro['idcedulaCliente']."'>{$otroRegistro['nombreCliente']}</option>"; 
                }
                    ?>
               </select></td>
            
            <td><select name="fid_inmobiliario_Arriendo">
                 <?php
                 while($inmobiliarioRegistro = mysqli_fetch_array($listaInmobiliario)){
                      echo "<option value='".$inmobiliarioRegistro['idInmobiliario']."'>{$inmobiliarioRegistro['descripcionInmobiliario']}</option>"; 
                }
                    ?>
                </select></td>
             <td><select name="fid_Tipo_Arriendo">
                 <?php
                   while($arriendoRegistro = mysqli_fetch_array($listatipoarriendo)){
                  echo "<option value='".$arriendoRegistro['idtipodearriendo']."'>
                  {$arriendoRegistro['descripcionarriendo']}</option>"; 
                }
                    ?>
                 
                 </select></td>
      
            
        <td><button class="btn btn-warning" type="reset" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-repeat"aria-hidden="true"></span></button>
   <button class="btn btn-success dropdown-toggle"  type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
   </form></tr>
    </tbody>
        </table>
		
				<nav><ul class="pagination">
<?php
	$cantPaginas=$objetoarriendo->cantidadPaginas();
	if($cantPaginas>1){
		if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
			echo '<li><a href="formularioarriendo.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
		}
	  for($i=1;$i<=$cantPaginas;$i++){
		if($i==$pagina){
		  echo '<li class="active"><a href="#">'.$i.'</a></li>';
		}else{
			echo '<li><a href="formularioarriendo.php?pag='.$i.'">'.$i.'</a></li>';
		}
	  }
	  if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
		echo '<li><a href="formularioarriendo.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
	  }
	}
		
?>	
	</ul>
</nav>
		
        <?php
	}//fin permiso c
         mysqli_free_result($listaarriendo);
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
    