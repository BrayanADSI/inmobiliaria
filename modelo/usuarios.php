<?php
class usuarios {
    
    private $_conexion;
    private $_idusuarios;
    private $_nombreusuario;
    private $_emailusuario;
    private $_claveusuario;
    private $_celularusuario;
    private $_fecharegistrousuario;
    private $_fechaultimaclave;
    private $_idrolesusuarios;
    
         
    private $_paginacion = 5;
    
    function __construct($conexion, $idusuarios, $nombreusuario, $emailusuario, $claveusuario, $celularusuario, $fecharegistrousuario, $fechaultimaclave, $idrolesusuarios)
    {
        $this->_conexion = $conexion;
        $this->_idusuarios = $idusuarios;
        $this->_nombreusuario = $nombreusuario;
        $this->_emailusuario= $emailusuario;
        $this->_claveusuario=  hash ('sha256', $claveusuario);
        $this->_celularusuario= $celularusuario;
        $this->_fecharegistrousuario= $fecharegistrousuario;
        $this->_fechaultimaclave= $fechaultimaclave;
        $this->_idrolesusuarios= $idrolesusuarios;
    }
    
    
    function __get ($k){
        return $this->$k;
    }

    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar (){

        $insercion = mysqli_query($this->_conexion,"INSERT INTO 
        usuarios (idusuarios, nombreusuario, emailusuario, claveusuario, celularusuario,fecharegistrousuario, fechaultimaclave,idrolesusuarios) 
        VALUES (NULL,'$this->_nombreusuario','$this->_emailusuario','$this->_claveusuario','$this->_celularusuario','$this->_fecharegistrousuario','$this->_fechaultimaclave','$this->_idrolesusuarios')")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES (NULL, 'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $insercion;
    }
    function modificar(){
        echo  "UPDATE usuarios SET nombreusuario ='$this->_nombreusuario',emailusuario='$this->_emailusuario', claveusuario='$this->_claveusuario',celularusuario='$this->_celularusuario',fecharegistrousuario='$this->_fecharegistrousuario',fechaultimaclave='$this->_fechaultimaclave',idrolesusuarios='$this->_idrolesusuarios'
        WHERE idusuarios=$this->_idusuarios";
        $modificacion = mysqli_query($this->_conexion,"UPDATE usuarios SET nombreusuario ='$this->_nombreusuario',emailusuario='$this->_emailusuario', claveusuario='$this->_claveusuario',celularusuario='$this->_celularusuario',fecharegistrousuario='$this->_fecharegistrousuario',fechaultimaclave='$this->_fechaultimaclave',idrolesusuarios='$this->_idrolesusuarios'
        WHERE idusuarios=$this->_idusuarios")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION ['id'].",CURDATE())");
            return $modificacion;
    }
     function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM usuarios WHERE idusuarios= $this->_idusuarios");
		 session_start ();
         $auditoria=mysqli_query($this->conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $eliminacion;
    }
     function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT (idusuarios)/$this->_paginacion)AS cantidad FROM usuarios") 
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
            $listado = mysqli_query($this->_conexion, "SELECT * FROM usuarios ORDER BY idusuarios") or
                die (mysqli_error($this->_conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM usuarios ORDER BY idusuarios
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
        }
        return $listado;
    }
}
?> 
    