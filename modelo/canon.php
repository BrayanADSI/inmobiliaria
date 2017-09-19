<?php
class canon {
    
    private $_conexion;
    private $_idCanon;
    private $_valorArriendoCanon;
    private $_fechaCanon;
    private $_Forma_Pago;
    private $_idArriendoCanon;
    private $_paginacion = 10;
    
    function __construct ($conexion, $idCanon, $valorArriendoCanon, $fechaCanon, $Forma_Pago, $idArriendoCanon){
        $this->_conexion           = $conexion;
        $this->_idCanon            = $idCanon;
        $this->_valorArriendoCanon = $valorArriendoCanon;
        $this->_fechaCanon         = $fechaCanon;
        $this->_Forma_Pago         = $Forma_Pago;
        $this->_idArriendoCanon    = $idArriendoCanon;
        
    }
    
    function __get ($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar(){
        $insercion = mysqli_query($this->_conexion,"INSERT INTO canon (idCanon,valorArriendoCanon,fechaCanon,Forma_Pago,idArriendoCanon ) VALUES ('$this->_idCanon','$this->_valorArriendoCanon','$this->_fechaCanon','$this->_Forma_Pago','$this->_idArriendoCanon')")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
		echo "INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())";
     return $insercion;   
    }
    
    function modificar(){
        
        $modificacion = mysqli_query($this->_conexion,"UPDATE canon SET
        valorArriendoCanon='$this->_valorArriendoCanon',fechaCanon='$this->_fechaCanon',Forma_Pago='$this->_Forma_Pago',idArriendoCanon='$this->_idArriendoCanon'
        WHERE idCanon=$this->_idCanon") or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())");
            return $modificacion;
    }
     
    function eliminar (){ 
      
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM canon 
         WHERE idCanon= $this->_idCanon") or die (mysqli_error($this->_conexion));
		session_start ();
         $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())");
        return $eliminacion;
    }
    
    
    function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion,
            "SELECT CEIL(COUNT (idcedulaCliente)/$this->_paginacion)AS cantidad FROM canon") 
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
            $listado = mysqli_query($this->_conexion, "SELECT * FROM canon ORDER BY idCanon") or
                die (mysqli_error($this->_conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM canon ORDER BY idCanon 
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
        }
        return $listado;
    }
}
?>