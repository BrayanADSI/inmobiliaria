<?php
class tipoarriendo {
    
    private $_conexion;
    private $_idtipodearriendo;
    private $_descripcionarriendo;
    private $_paginacion = 10;
    
    function __construct($conexion, $idtipodearriendo, $descripcionarriendo) {
        $this->_conexion = $conexion;
        $this->_idtipodearriendo = $idtipodearriendo;
        $this->_descripcionarriendo = $descripcionarriendo;
    }
    
    function __get ($k){
        return $this->$k;
    }

    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar (){
        
        $insercion = mysqli_query($this->_conexion,"INSERT INTO tipoarriendo (idtipodearriendo, descripcionarriendo) VALUES (NULL,'$this->_descripcionarriendo')")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES (NULL, 'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $insercion;
    }
    function modificar(){
        $modificacion = mysqli_query($this->_conexion,"UPDATE tipoarriendo SET descripcionarriendo ='$this->_descripcionarriendo' WHERE idtipodearriendo= $this->_idtipodearriendo") or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO  auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION ['id'].",CURDATE())");
            return $modificacion;
    }
     function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM tipoarriendo WHERE idtipodearriendo= $this->_idtipodearriendo" ) or die (mysqli_error($this->_conexion));
		 session_start ();
         $auditoria=mysqli_query($this->conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES(NULL,'Elimino".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $eliminacion;
    }
     function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT (idtipodearriendo)/$this->_paginacion)AS cantidad FROM tipoarriendo") 
            or die (mysqli_error($this->_conexion));
        $unRegistro=mysqli_fetch_array($cantidadbloques);
        return $unRegistro['cantidad'];
    }
	
	function getRol($idusuario){
        $roles=mysqli_query($this->_conexion, "SELECT tipodearriendoroles AS elpermiso FROM roles WHERE idRoles IN(SELECT idrolesusuarios FROM usuarios WHERE idusuarios =$idusuario)") or die (mysqli_error($this->_conexion));
	     $unregistro=mysqli_fetch_array($roles);
        return $unregistro['elpermiso'];
    }
	
   function listar ($pagina){
        if ($pagina<=0){
            $listado = mysqli_query($this->_conexion, "SELECT * FROM tipoarriendo ORDER BY idtipodearriendo") or
                die (mysqli_error($this->_conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM tipoarriendo ORDER BY idtipodearriendo
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
        }
        return $listado;
    }
}
?> 