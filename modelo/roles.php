<?php
class roles {
    
    private $_conexion;
    private $_idroles;
    private $_nombrerol;
    private $_clienteroles;
    private $_tipodearriendoroles;
    private $_abonosroles;
    private $_deudasroles;
    private $_arriendoroles;
    private $_pagosroles;
    private $_inmobiliarioroles;
    private $_canonroles;
    private $_usuariosroles;
    private $_auditoriaroles;
    private $_rolesroles;
         
         
    private $_paginacion = 10;
    
    function __construct($conexion, $idroles, $nombrerol, $clienteroles, $tipodearriendoroles, $abonosroles, $deudasroles, $arriendoroles, $pagosroles, $inmobiliarioroles, $canonroles, $usuariosroles, $auditoriasroles, $rolesroles) {
        $this->_conexion = $conexion;
        $this->_idroles = $idroles;
        $this->_nombrerol = $nombrerol;
        $this->_clienteroles= $clienteroles;
        $this->_tipodearriendoroles= $tipodearriendoroles;
        $this->_abonosroles= $abonosroles;
        $this->_deudasroles= $deudasroles;
        $this->_arriendoroles= $arriendoroles;
        $this->_pagosroles= $pagosroles;
        $this->_inmobiliarioroles= $inmobiliarioroles;
        $this->_canonroles= $canonroles;
        $this->_usuariosroles= $usuariosroles;
        $this->_auditoriasroles= $auditoriasroles;
        $this->_rolesroles= $rolesroles;
    }
    
    function __get ($k){
        return $this->$k;
    }

    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar (){
        $insercion = mysqli_query($this->_conexion,"INSERT INTO 
        roles (idroles, nombrerol, clienteroles, tipodearriendoroles, abonosroles, deudasroles, arriendoroles, pagosroles, inmobiliarioroles, canonroles, usuariosroles, auditoriasroles, rolesroles) 
        VALUES (NULL,'$this->_nombrerol','$this->_clienteroles','$this->_tipodearriendoroles','$this->_abonosroles','$this->_deudasroles','$this->_arriendoroles','$this->_pagosroles','$this->_inmobiliarioroles','$this->_canonroles','$this->_usuariosroles','$this->_auditoriasroles','$this->_rolesroles')")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES (NULL, 'Insert".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $insercion;
    }
    function modificar(){
        $modificacion = mysqli_query($this->_conexion,"UPDATE roles SET nombrerol ='$this->_nombrerol',clienteroles='$this->_clienteroles',tipodearriendoroles='$this->_tipodearriendoroles',abonosroles='$this->_abonosroles',deudasroles='$this->_deudasroles',arriendoroles='$this->_arriendoroles',pagosroles='$this->_pagosroles',inmobiliarioroles='$this->_inmobiliarioroles',canonroles='$this->_canonroles',usuariosroles='$this->_usuariosroles',auditoriasroles='$this->_auditoriasroles', rolesroles='$this->_rolesroles' 
        WHERE idroles=$this->_idroles")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO  auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION ['id'].",CURDATE())");
            return $modificacion;
    }
     function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM roles WHERE idroles= $this->_idroles");
		 session_start ();
         $auditoria=mysqli_query($this->conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Elimino".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $eliminacion;
    }
     function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT (idroles)/$this->_paginacion)AS cantidad FROM roles") 
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
            $listado = mysqli_query($this->_conexion, "SELECT * FROM roles ORDER BY idroles") or
                die (mysqli_error($this->_conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM roles ORDER BY idroles
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
        }
        return $listado;
    }
}
?> 
    