<?php

class Login {
    private $_conexion;
    private $_idusuarios;
    private $_emailusuario;
    private $_hashedclaveusuario;
    private $_nombreusuario;
    private $_rolesusuario;
    
    function __construct ($conexion, $emailusuario, $clave){
        $this->_conexion           = $conexion;
        $this->_emailusuario       = $emailusuario;
        $this->_hashedclaveusuario = hash ('sha256', $clave);
		
		
    }
    
    function verificarusuarios(){
        $verificacion = mysqli_query($this->_conexion,"SELECT idusuarios, nombreusuario,idrolesusuarios FROM usuarios WHERE emailusuario LIKE '$this->_emailusuario' AND CONVERT (claveusuario, CHAR (100)) LIKE '$this->_hashedclaveusuario'");

        if(mysqli_num_rows($verificacion)){
            $unusuario = mysqli_fetch_array ($verificacion);
            $this->_idusuarios     = $unusuario ["idusuarios"];
            $this->_nombreusuario = $unusuario ["nombreusuario"];
            $this->_rolesusuario    = $unusuario ["idrolesusuarios"];
        return true;
        
        }
        return false;
    }
	
    function getidusuarios(){
        return $this->_idusuarios;
    }
      
    function getnombreusuario(){
        return $this->_nombreusuario;
    }
    
    function getrolesusuarios(){
        return $this->_rolesusuario;
        }
}
      ?>
    