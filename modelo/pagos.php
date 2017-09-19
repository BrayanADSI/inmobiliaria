<?php
class Pagos {
    
    private $_conexion;
    private $_idPagos;
    private $_valorPago;
    private $_fechaPago;
    private $_idCanonPagos;
    private $_paginacion = 10;
    
    function __construct ($conexion, $idPagos, $valorPago, $fechaPago, $idCanonPagos){
        $this->_conexion           = $conexion;
        $this->_idPagos            = $idPagos;
        $this->_valorPago          = $valorPago;
        $this->_fechaPago          = $fechaPago;
        $this->_idCanonPagos       = $idCanonPagos;
        
        
    }
    
    function __get ($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar(){
        
        $insercion = mysqli_query($this->_conexion,"INSERT INTO pagos (idPagos,valorPago,fechaPago,idCanonPagos) VALUES (NULL,'$this->_valorPago','$this->_fechaPago','$this->_idCanonPagos')")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
     return $insercion;   
    }
    
    function modificar(){
        
        $modificacion = mysqli_query($this->_conexion,"UPDATE pagos SET
        valorPago='$this->_valorPago',fechaPago='$this->_fechaPago',idCanonPagos='$this->_idCanonPagos'
        WHERE idPagos=$this->_idPagos") or die (mysqli_error($this->_conexion)) ;
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())");
            return $modificacion;
    }
     
    function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM pagos 
         WHERE idPagos= $this->_idPagos");
		session_start ();
         $auditoria=mysqli_query($this->conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES(NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())");
        return $eliminacion;
    }
    
    
    function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion,
            "SELECT CEIL(COUNT (idPagos)/$this->_paginacion)AS cantidad FROM pagos") 
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
            $listado = mysqli_query($this->_conexion, "SELECT * FROM pagos ORDER BY idPagos") or
                die (mysqli_error($this->conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM pagos ORDER BY idPagos 
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion)); 
        }
        return $listado;
    }
}
?>