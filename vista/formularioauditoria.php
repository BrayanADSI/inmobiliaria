<!DOCTYPE html><?php
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
        <title> Formulario Auditoria</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    </head>
    <body>
        <header>
        <h1>Formulario Auditoria</h1>
             <?php
               $formulario = "auditoria";
               include_once("menu.php");
            ?>
        </header>
        <table border="3px" class="table table-striped">
            <tbody>
                <tr> 
                  <th scope = "col">fechaauditoria</th>
                  <th scope = "col">descripcionauditoria</th>
                     <th scope = "col">id usuario auditoria </th>
                  
                  
                </tr>
                
 <?php
    include_once("../modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
                
      include_once("../modelo/usuarios.php"); 
     $objetousuarios =  new usuarios ($conexion,0,'nombreusuiario','emailusuario','claveusuario','celularusuario','fecharegistrousuario','fechaultimaclave','idroles');
      $listausuarios= $objetousuarios->listar(0);
              

     include_once("../modelo/auditoria.php"); 
     $objetoauditoria =  new auditoria ($conexion,0,'fechaauditoria','descripcionauditoria','idusuariosauditorias');
      $listaauditoria= $objetoauditoria->listar(0);
    while($unRegistro = mysqli_fetch_array($listaauditoria)){
        
        echo '<tr><form idauditoria="fModificaauditoria"'.$unRegistro["idauditoria"].' action="../controlador/Controladorauditoria.php" method="post">';
        echo '<input type="hidden" name="fidauditoria"  value="'.$unRegistro['idauditoria'].'">';
        echo '<td><input type="date" name="ffechaauditoria"  value="'.$unRegistro['fechaauditoria'].'"></td>';
        echo '<td><input type="text" name="fdescripcionauditoria"  value="'.$unRegistro['descripcionauditoria'].'"></td>';
        echo '<td><select name="fidusuariosauditorias">';
         while($otroRegistro = mysqli_fetch_array($listausuarios)){  
             echo "<option value='".$otroRegistro['idusuarios']."'";
             
              if ($unRegistro['idusuariosauditorias']==$otroRegistro['idusuarios']){
               echo " selected "; 
         }
                        echo  ">{$otroRegistro['nombreusuario']}</option>";  
                     }
                          mysqli_data_seek($listausuarios,0);   
       
        
         echo '</select></td>';
          
        echo '</form></tr>';
    }
 ?>
 
        <tr><form id="fingresarauditoria" action="../controlador/Controladorauditoria.php" method="post">
        
            
        
   </form></tr>
    </tbody>
        </table>
        <?php
         mysqli_free_result($listaauditoria);
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