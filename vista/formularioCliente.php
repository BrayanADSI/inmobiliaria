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
        <title> Formulario Cliente </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        
        <header>
        <h1>Formulario Cliente</h1>
         <?php
			   $pagina = isset($_GET['pag'])?$_GET['pag']:1;    //agregar esto junto con el codigo de paginacion
               $formulario = "cliente";
               include_once("menu.php");
            ?>    
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr>
                    <th scope = "col">Id Cedula Cliente</th> 
                   <th scope = "col">Nombre Cliente</th>
                    <th scope = "col">Telefono Cliente</th>
                    <th scope = "col">Direccion Cliente</th>
                    <th scope = "col">Email Cliente</th>
                    <th scope = "col">Fecha de Registro del Cliente</th>
                    <th scope = "col">Opciones</th>
                </tr>
                
  <?php
    include_once("../modelo/conexion.php");
	$objetoConexion = new conexion();
	$conexion = $objetoConexion->conectar();
                
    include_once("../modelo/cliente.php");
    $objetoCliente =  new cliente($conexion,'cedula','nombre','telefono','direccion','email','registro');
    $listaClientes = $objetoCliente->listar($pagina);   //$pagina va con el codigo de paginacion
			
	$permiso = $objetoCliente->getRol($_SESSION['id']);
	
	if (stripos($permiso,"r")!==false){
	
    while($unRegistro = mysqli_fetch_array($listaClientes)){
        echo '<tr><form id="fModificarCliente"'.$unRegistro["idcedulaCliente"].' action="../controlador/ControladorCliente.php" method="post">';
        echo '<td><input type="number" name="fIdcedulaCliente" value="'.$unRegistro['idcedulaCliente'].'" readonly></td>';
        echo '<td><input type="text" name="fNombreCliente"  value="'.$unRegistro['nombreCliente'].'"></td>';
        echo '<td><input type="number" name="fTelefonoCliente"  value="'.$unRegistro['telefonoCliente'].'"></td>';
        echo '<td><input type="text" name="fDireccionCliente"  value="'.$unRegistro['direccionCliente'].'"></td>';
        echo '<td><input type="text" name="fEmailCliente"  value="'.$unRegistro['emailCliente'].'"></td>';
        echo '<td><input type="date" name="fFechaRegistroCliente"  value="'.$unRegistro['fechaRegistroCliente'].'"></td>';
		
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
                
       <tr><form id="fIngresarCliente" action="../controlador/ControladorCliente.php" method="post">
           <td><input type="number" required name="fIdcedulaCliente"></td>
           <td><input type="text" required name="fNombreCliente"></td>
           <td><input type="number" name="fTelefonoCliente"></td>
           <td><input type="text" required name="fDireccionCliente"></td>
           <td><input type="text" required  name="fEmailCliente"></td>
           <td><input type="date" name="fFechaRegistroCliente"></td>
           <td><button class="btn btn-warning" type="reset" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-repeat"aria-hidden="true"></span></button>
           <button  class="btn btn-success dropdown-toggle"  type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
           </form></tr>
            </tbody>
        </table>

		<nav><ul class="pagination">
			
<?php
	
	$cantPaginas=$objetoCliente->cantidadPaginas();
	if($cantPaginas>1){
		if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
			echo '<li><a href="formulariocliente.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
		}
	  for($i=1;$i<=$cantPaginas;$i++){
		if($i==$pagina){
		  echo '<li class="active"><a href="#">'.$i.'</a></li>';
		}else{
			echo '<li><a href="formulariocliente.php?pag='.$i.'">'.$i.'</a></li>';
		}
	  }
	  if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
		echo '<li><a href="formulariocliente.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
	  }
	}
		
?>	
	</ul>
</nav>

        <?php
			} //fin permiso c
         mysqli_free_result($listaClientes);
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
