

<nav>
   <ul class="nav nav-pills">
       <li class="<?php echo ($formulario=='arriendo')?'active':''; ?>"><a href="formularioarriendo.php">Arriendo</a></li>
       <li class="<?php echo ($formulario=='auditoria')?'active':''; ?>"><a href="formularioauditoria.php">Auditoria</a></li>
       <li class="<?php echo ($formulario=='abono')?'active':''; ?>"><a href="formularioabonos.php">Abono</a></li>
       <li class="<?php echo ($formulario=='canon')?'active':''; ?>"><a href="formulariocanon.php">Canon</a></li>
       <li class="<?php echo ($formulario=='cliente')?'active':''; ?>"><a href="formularioCliente.php">Cliente</a></li>
       <li class="<?php echo ($formulario=='inmobiliario')?'active':''; ?>"><a href="formularioInmobiliario.php">Inmobiliario</a></li>
       <li class="<?php echo ($formulario=='pagos')?'active':''; ?>"><a href="formularioPagos.php">Pagos</a></li>
       <li class="<?php echo ($formulario=='roles')?'active':''; ?>"><a href="formularioroles.php">Roles</a></li>
       <li class="<?php echo ($formulario=='tipoarriendo')?'active':''; ?>"><a href="formulariotipodearriendo.php">Tipo De Arriendo</a></li>
       <li class="<?php echo ($formulario=='usuarios')?'active':''; ?>"><a href="formulariousuarios.php">Usuarios</a></li>
        <li class="<?php echo ($formulario=='deudas')?'active':''; ?>"><a href="formulariodeudas.php">Deudas</a></li>
	   <li><a href='cerrarsesion.php'>cerrar session </a>;</li>
   </ul>
</nav>