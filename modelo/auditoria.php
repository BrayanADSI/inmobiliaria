<?php
class auditoria {
    
    private $_conexion;
    private $_idauditoria;
    private $_fechaauditoria;
    private $_descripcionauditoria;
    private $_idusariosauditorias;
    private $_paginacion = 10;
    
    function __construct($conexion, $idauditoria, $fechaauditoria, $descripcionauditoria, $idusuariosauditorias) {
        $this->_conexion = $conexion;
        $this->_idauditoria= $idauditoria;
        $this->_fechaauditoria = $fechaauditoria;
        $this->_descripcionauditoria= $descripcionauditoria;
        $this->_idusuariosauditorias = $idusuariosauditorias;
    }
    
    function __get ($k){
        return $this->$k;
    }


    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar (){
        $insercion = mysqli_query($this->_conexion,"INSERT INTO 
        auditoria (idauditoria, fechaauditoria, descripcionauditoria, idusuariosauditorias) 
        VALUES (NULL,'$this->_fechaauditoria','$this->_descripcionauditoria','$this->_idusuariosauditorias')")or die (mysqli_error($this->_conexion));
        //$auditoria = mysqli_query ($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL, 'Insert".static::class.",".$_SESSION ['idUsuario'].",'CURDATE()')");
        return $insercion;
    }
    function modificar(){
        $modificacion = mysqli_query($this->_conexion,"UPDATE auditoria SET fechaauditoria ='$this->_fechaauditoria', descripcionauditoria ='$this->_descripcionauditoria', idusuariosauditorias ='$this->_idusuariosauditorias' WHERE idauditoria= $this->_idauditoria")or die (mysqli_error($this->_conexion));
        //$auditoria = mysqli_query($this->_conexion, "INSERT INTO  Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES(NULL,'Modifico".static::class.",".$_SESSION ['idUsuario'].",'CURDATE()')");
            return $modificacion;
    }
     function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM auditoria WHERE idauditoria= $this->_idauditoria");
         //$auditoria=mysqli_query($this->conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES(NULL,'Inserto".static::class.",".$_SESSION ['idUsuario'].",CURDATE()')");
        return $eliminacion;
    }
     function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT (idauditoria)/$this->_paginacion)AS cantidad FROM auditoria") 
            or die (mysqli_error($this->_conexion));
        $unRegistro=mysqli_fetch_array($cantidadbloques);
        return $unRegistro['cantidad'];
    }
   function listar ($pagina){
        if ($pagina<=0){
            $listado = mysqli_query($this->_conexion, "SELECT * FROM auditoria ORDER BY idauditoria") or
                die (mysqli_error($this->_conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM auditoria ORDER BY idauditoria
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
        }
        return $listado;
    }
}
?> 