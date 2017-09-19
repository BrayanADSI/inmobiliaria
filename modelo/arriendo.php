<?php
class arriendo {
    
    private $_conexion;
    private $_id_Arriendo;
    private $_Fecha_Arriendo;
    private $_id_Cedula_Cliente_Arriendo;
    private $_id_inmobiliario_Arriendo;
    private $_id_Tipo_Arriendo;
    private $_paginacion = 5;
    
    function __construct($_conexion, $id_Arriendo, $Fecha_Arriendo, $id_Cedula_Cliente_Arriendo, $id_inmobiliario_Arriendo,$id_Tipo_Arriendo) {
        $this->_conexion = $_conexion;
        $this->_id_Arriendo = $id_Arriendo;
        $this->_Fecha_Arriendo = $Fecha_Arriendo;
        $this->_id_Cedula_Cliente_Arriendo= $id_Cedula_Cliente_Arriendo;
        $this->_id_inmobiliario_Arriendo = $id_inmobiliario_Arriendo;
        $this->_id_Tipo_Arriendo = $id_Tipo_Arriendo;
    }
    
    function __get ($k){
        return $this->$k;
    }


    function __set($k,$v){
        $this->$k = $v;
    }
    
    function insertar (){
        $insercion = mysqli_query($this->_conexion,"INSERT INTO arriendo (id_Arriendo,Fecha_Arriendo, id_Cedula_Cliente_Arriendo,id_inmobiliario_Arriendo,id_Tipo_Arriendo) VALUES (NULL,'$this->_Fecha_Arriendo','$this->_id_Cedula_Cliente_Arriendo','$this->_id_inmobiliario_Arriendo','$this->_id_Tipo_Arriendo')") or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query ($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES (NULL, 'Inserto".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $insercion;
    }
    function modificar(){
        $modificacion = mysqli_query($this->_conexion,"UPDATE arriendo SET id_Arriendo ='$this->_id_Arriendo', Fecha_Arriendo ='$this->_Fecha_Arriendo', id_Cedula_Cliente_Arriendo ='$this->_id_Cedula_Cliente_Arriendo',id_inmobiliario_Arriendo ='$this->_id_inmobiliario_Arriendo', id_Tipo_Arriendo ='$this->_id_Tipo_Arriendo' WHERE id_Arriendo= $this->_id_Arriendo")or die (mysqli_error($this->_conexion));
		session_start ();
        $auditoria = mysqli_query($this->_conexion, "INSERT INTO  auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Modifico".static::class."',".$_SESSION ['id'].",CURDATE())");
		
            return $modificacion;
    }
     function eliminar (){ 
         $eliminacion = mysqli_query($this->_conexion,"DELETE FROM arriendo WHERE id_Arriendo= $this->_id_Arriendo")or die (mysqli_error($this->_conexion));
		 session_start ();
         $auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria (idauditoria,descripcionauditoria,idusuariosauditorias,fechaauditoria) VALUES(NULL,'Elimino".static::class."',".$_SESSION ['id'].",CURDATE())");
        return $eliminacion;
    }
     function cantidadPaginas(){
        $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(id_Arriendo)/$this->_paginacion)AS cantidad FROM arriendo") or die (mysqli_error($this->_conexion));
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
            $listado = mysqli_query($this->_conexion, "SELECT * FROM arriendo ORDER BY id_Arriendo") or
                die (mysqli_error($this->_conexion));
        }else{
            $paginacionMax = $pagina * $this->_paginacion;
            $paginacionMin = $paginacionMax - $this->_paginacion;
            $listado =mysqli_query ($this->_conexion, "SELECT * FROM arriendo ORDER BY id_Arriendo
            LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
        }
        return $listado;
    }
}
?> 