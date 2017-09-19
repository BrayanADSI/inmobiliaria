<?php
class inmobiliario {
    
    private $_conexion;
    private $_idInmobiliario;
    private $_descripcionInmobiliario;
    private $_direccionInmobiliario;
    private $_GpsInmobiliario;
    private $_paginacion = 10;
    
    function __construct ($conexion, $idInmobiliario, $descripcionInmobiliario, $direccionInmobiliario, $GpsInmobiliario){
        $this->_conexion         = $conexion;
        $this->_idInmobiliario  = $idInmobiliario;
        $this->_descripcionInmobiliario    = $descripcionInmobiliario;
        $this->_direccionInmobiliario  = $direccionInmobiliario;
        $this->_GpsInmobiliario = $GpsInmobiliario;

    }
    
    function __get ($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar(){
        $insercion = mysqli_query($this->_conexion,"INSERT INTO 
        Inmobiliario (idInmobiliario, descripcionInmobiliario, direccionInmobiliario, GpsInmobiliario)
        VALUES ('$this->_idInmobiliario','$this->_descripcionInmobiliario','$this->_direccionInmobiliario',ST_GeomFromText('$this->_GpsInmobiliario'))")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
     return $insercion;   
    }
    
    function modificar(){
        $modificacion = mysqli_query($this->_conexion,"UPDATE Inmobiliario SET descripcionInmobiliario ='$this->_descripcionInmobiliario',direccionInmobiliario='$this->_direccionInmobiliario',GpsInmobiliario=ST_GeomFromText('$this->_GpsInmobiliario') WHERE idInmobiliario=$this->_idInmobiliario") or die (mysqli_error($this->_conexion));
		 session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())");
            return $modificacion;
    }
     
    function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Inmobiliario 
         WHERE idInmobiliario= $this->_idInmobiliario");
		 session_start ();
         $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())");
        return $eliminacion;
    }
    
    
    function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion,
            "SELECT CEIL(COUNT (idInmobiliario)/$this->_paginacion)AS cantidad FROM Inmobiliario") 
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
            $listado = mysqli_query($this->_conexion, "SELECT idInmobiliario,descripcionInmobiliario,direccionInmobiliario, ST_AsText(GpsInmobiliario) AS GpsInmobiliario FROM Inmobiliario ORDER BY idInmobiliario") or
                die (mysqli_error($this->conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT idInmobiliario,descripcionInmobiliario,direccionInmobiliario, ST_AsText(GpsInmobiliario) AS GpsInmobiliario FROM Inmobiliario ORDER BY idInmobiliario 
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion)); 
        }
        return $listado;
    }
}
?>