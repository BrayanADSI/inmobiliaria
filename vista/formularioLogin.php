<form action="controlador/controladorLogin.php" method="post">
<h2> Ingrese al sistema</h2>
<input name="femailusuario" type="text" maxlength="60" placeholder="example@emial.com" required autofocus>
	<br>
<input name="fclaveusuario" type="password" placeholder="Password" required><br>
<button name="fEnviar" type="submit" value="Ingresar">Ingresar</button>
</form>

<?php
@$mensaje= $_GET ['mensaje'];
if (isset($mensaje)) {
    if ($mensaje=='incorrecto'){
        echo '<div class="alert alert-danger" role="alert"> Usuario o clave incorrecto </div>';
       }
}
?>