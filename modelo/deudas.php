<?php
class deudas {
    
    private $_conexion;
    private $_idDeudas;
    private $_valorDeuda;
    private $_fechaDeuda;
    private $_saldoDeuda;
    private $_idPagosDeudas;
    private $_paginacion = 10;
    
    function __construct($conexion, $idDeudas, $valorDeuda, $fechaDeuda, $saldoDeuda, $idPagosDeudas) {
        $this->_conexion = $conexion;
        $this->_idDeudas= $idDeudas;
        $this->_valorDeuda = $valorDeuda;
        $this->_fechaDeuda= $fechaDeuda;
        $this->_saldoDeuda = $saldoDeuda;
        $this->_idPagosDeudas = $idPagosDeudas;
    }
    
    function __get ($k){
        return $this->$k;
    }


    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar (){
        $insercion = mysqli_query($this->_conexion,"INSERT INTO 
        deudas (idDeudas, valorDeuda, fechaDeuda, saldoDeuda, idPagosDeudas) 
        VALUES (null,'$this->_valorDeuda','$this->_fechaDeuda','$this->_saldoDeuda','$this->_idPagosDeudas')")  or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES (NULL, 'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $insercion;
    }
    function modificar(){
        $modificacion = mysqli_query($this->_conexion,"UPDATE deudas SET valorDeuda ='$this->_valorDeuda', fechaDeuda ='$this->_fechaDeuda', saldoDeuda ='$this->_saldoDeuda',idPagosDeudas ='$this->_idPagosDeudas' WHERE idDeudas= $this->_idDeudas")  or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO  auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION ['id'].",CURDATE())");
            return $modificacion;
    }
     function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM deudas WHERE idDeudas= $this->_idDeudas");
		 session_start ();
         $auditoria=mysqli_query($this->conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $eliminacion;
    }
     function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT (idDeudas)/$this->_paginacion)AS cantidad FROM deudas") 
            or die (mysqli_error($this->_conexion));
        $unRegistro=mysqli_fetch_array($cantidadbloques);
        return $unRegistro['cantidad'];
    }
	
	function getRol($idusuario){
        $roles=mysqli_query($this->_conexion, "SELECT ".static::class."roles AS elpermiso FROM roles WHERE idRoles IN(SELECT idrolesusuarios FROM usuarios WHERE idusuarios =$idusuario)") or die (mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($roles);
        return $unregistro['elpermiso'];
    }
   function listar ($pagina){
        if ($pagina<=0){
            $listado = mysqli_query($this->_conexion, "SELECT * FROM deudas ORDER BY idDeudas") or
                die (mysqli_error($this->_conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM deudas ORDER BY idDeudas
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
        }
        return $listado;
    }
}
?> 