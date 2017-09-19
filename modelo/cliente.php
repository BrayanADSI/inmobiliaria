<?php
class Cliente {
    
    private $_conexion;
    private $_idcedulaCliente;
    private $_nombreCliente;
    private $_telefonoCliente;
    private $_direccionCliente;
    private $_emailCliente;
    private $_fechaRegistroCliente;
    private $_paginacion = 5;
    
    function __construct ($conexion, $idcedulaCliente, $nombreCliente, $telefonoCliente, $direccionCliente, $emailCliente, $fechaRegistroCliente){
        $this->_conexion         = $conexion;
        $this->_idcedulaCliente  = $idcedulaCliente;
        $this->_nombreCliente    = $nombreCliente;
        $this->_telefonoCliente  = $telefonoCliente;
        $this->_direccionCliente = $direccionCliente;
        $this->_emailCliente      = $emailCliente;
        $this->_fechaRegistroCliente = $fechaRegistroCliente;
    }
    
    function __get ($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar(){
        $insercion = mysqli_query($this->_conexion,"INSERT INTO cliente (idcedulaCliente, nombreCliente, telefonoCliente, direccionCliente, emailCliente, fechaRegistroCliente) VALUES ('$this->_idcedulaCliente','$this->_nombreCliente','$this->_telefonoCliente','$this->_direccionCliente','$this->_emailCliente','$this->_fechaRegistroCliente')")or die (mysqli_error($this->_conexion));
        session_start ();
		$auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
     return $insercion;   
    }
    
    function modificar(){
        $modificacion = mysqli_query($this->_conexion,"UPDATE Cliente SET
       idcedulaCliente= '$this->_idcedulaCliente', nombreCliente ='$this->_nombreCliente',telefonoCliente='$this->_telefonoCliente',direccionCliente='$this->_direccionCliente',emailCliente='$this->_emailCliente',fechaRegistroCliente='$this->_fechaRegistroCliente'
        WHERE idcedulaCliente=$this->_idcedulaCliente")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())");
            return $modificacion;
    }
     
    function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Cliente 
         WHERE idcedulaCliente= $this->_idcedulaCliente");
		session_start ();
         $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Elimino".static::class."',".$_SESSION['idUsuario'].",CURDATE())");
        return $eliminacion;
    }
    
    
    function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idcedulaCliente)/$this->_paginacion)AS cantidad FROM Cliente") or die (mysqli_error($this->_conexion));
        $unRegistro=mysqli_fetch_array($cantidadBloques);
        return $unRegistro['cantidad'];
    }
	
	function getRol($idusuario){
        $roles=mysqli_query($this->_conexion, "SELECT ".static::class."roles AS elpermiso FROM roles WHERE idRoles IN(SELECT idrolesusuarios FROM usuarios WHERE idusuarios =$idusuario)") or die (mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($roles);
        return $unregistro['elpermiso'];
    }
	
    function listar ($pagina){
        if ($pagina<=0){
            $listado = mysqli_query($this->_conexion, "SELECT * FROM Cliente ORDER BY fechaRegistroCliente") or
                die (mysqli_error($this->conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM Cliente ORDER BY idcedulaCliente 
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion)); 
        }
        return $listado;
    }
}
?>