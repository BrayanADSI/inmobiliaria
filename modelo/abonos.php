<?php
class abonos {
    
    private $_conexion;
    private $_idabonos;
    private $_valorabono;
    private $_fechaabono;
    private $_iddeudasabonos;
    private $_paginacion = 10;
    
    function __construct($conexion, $idabonos, $valorabono, $fechaabono, $iddeudasabonos) {
        $this->_conexion = $conexion;
        $this->_idabonos= $idabonos;
        $this->_valorabono = $valorabono;
        $this->_fechaabono= $fechaabono;
        $this->_iddeudasabonos = $iddeudasabonos;
    }
    
    function __get ($k){
        return $this->$k;
    }


    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar (){
        $insercion = mysqli_query($this->_conexion,"INSERT INTO 
        abonos (idabonos, valorabono, fechaabono, iddeudasabonos) 
        VALUES (NULL,'$this->_valorabono','$this->_fechaabono','$this->_iddeudasabonos')")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES (NULL, 'Insert".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $insercion;
    }
    function modificar(){
        $modificacion = mysqli_query($this->_conexion,"UPDATE abonos SET valorabono='$this->_valorabono', fechaabono ='$this->_fechaabono', iddeudasabonos ='$this->_iddeudasabonos' WHERE idabonos= $this->_idabonos")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO  auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION ['id'].",CURDATE())");
            return $modificacion;
    }
     function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM abonos WHERE idabonos= $this->_idabonos");
		 session_start ();
         $auditoria=mysqli_query($this->_conexion,"INSERT INTO  auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Elimino".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $eliminacion;
    }
     function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT (idabonos)/$this->_paginacion)AS cantidad FROM abonos") 
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
            $listado = mysqli_query($this->_conexion, "SELECT * FROM abonos ORDER BY idabonos") or
                die (mysqli_error($this->_conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM abonos ORDER BY idabonos
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
        }
        return $listado;
    }
}
?> 