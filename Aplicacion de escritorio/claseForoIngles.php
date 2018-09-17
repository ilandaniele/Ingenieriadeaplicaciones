<?php

class Conexion  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function Conexion()
	{
		// se definen los datos del servidor de base de datos 
		$conection['server']="localhost";  //host
		$conection['user']="root";         //  usuario
		$conection['pass']="";             //password
		$conection['base']="congreso";           //base de datos
		
		// crea la conexion pasandole el servidor , usuario y clave
		$conect= mysqli_connect($conection['server'],$conection['user'],$conection['pass']);

		if ($conect) // si la conexion fue exitosa , selecciona la base
		{
			mysqli_select_db($conect,$conection['base']);			
			$this->con=$conect;
			
		}
	}
	function getConexion() // devuelve la conexion
	{
		return $this->con;
	}
	function Close()  // cierra la conexion
	{
		mysqli_close($this->con);
	}	

}
class sQuery   // se declara una clase para poder ejecutar las consultas, esta clase llama a la clase anterior
{

	var $coneccion;
	var $consulta;
	var $resultados;
	function sQuery()  // constructor, solo crea una conexion usando la clase "Conexion"
	{
		$this->coneccion= new Conexion();
	}
	function executeQuery($cons)  // metodo que ejecuta una consulta y la guarda en el atributo $consulta
	{
		$this->consulta= mysqli_query($this->coneccion->getConexion(),$cons);
		return $this->consulta;
	}	
	function getResults()   // retorna la consulta en forma de result.
	{return $this->consulta;}
	
	function Close()		// cierra la conexion
	{$this->coneccion->Close();}	
	
	function Clean() // libera la consulta
	{mysqli_free_result($this->consulta);}
	
	function getResultados() // debuelve la cantidad de registros encontrados
	{return mysqli_affected_rows($this->coneccion->getConexion()) ;}
	
	function getAffect() // devuelve las cantidad de filas afectadas
	{return mysqli_affected_rows($this->coneccion->getConexion()) ;}

    function fetchAll()
    {
        $rows=array();
		if ($this->consulta)
		{
			while($row=  mysqli_fetch_array($this->consulta))
			{
				$rows[]=$row;
			}
		}
        return $rows;
    }
}




class Foro
{
	var $codigo;    
	var $nombre;
	var $detalle;
	var $cod_postal;
	var $codigoAux;
	
    public static function getForos() 
		{
			$obj_foro=new sQuery();
			$obj_foro->executeQuery("select * from FORO_INGLES"); 
			return $obj_foro->fetchAll(); 
		}

	function Foro($nro=0) 
	{
		
		if ($nro!=0)
		{
			$obj_foro=new sQuery();
			$result=$obj_foro->executeQuery("select * from FORO_INGLES where codigo = '$nro'"); 
			$row=mysqli_fetch_array($result);
			$this->codigo=$row['codigo'];
			$this->nombre=$row['nombre'];
			$this->detalle=$row['detalle'];
			$this->cod_postal=$row['cod_postal'];
		}
	}
		
		// metodos que devuelven valores
	function getCodigo()
	 { return $this->codigo;}
	function getNombre()
	 { return $this->nombre;}
	function getDetalle()
	 { return $this->detalle;}
	function getCod_postal()
	 { return $this->cod_postal;}
	
	 
	 
		// metodos que setean los valores
	function setCodigoAux($val)
	 { $this->codigoAux=$val;}
	function setNombre($val)
	 { $this->nombre=$val;}
	function setDetalle($val)
	 {  $this->detalle=$val;}
	function setCod_postal($val)
	 {  $this->cod_postal=$val;}
	
	

    function save()
    {	
        if($this->codigo)
        {$this->updateForo();}
        else
        {$this->insertForo();}
    }
	
	private function updateForo()	
	{	
				$obj_foro=new sQuery();
				$query="update FORO_INGLES set codigo = '$this->codigoAux', nombre='$this->nombre',  detalle='$this->detalle', 
				cod_postal='$this->cod_postal' where codigo = '$this->codigo'";
				$obj_foro->executeQuery($query); // ejecuta la consulta para traer al cliente 
				return $obj_foro->getAffect(); // retorna todos los registros afectados
			
	}
	private function insertForo()	// inserta el cliente cargado en los atributos
	{		
			
			$obj_foro=new sQuery();
			$query="insert into FORO_INGLES(codigo, nombre, detalle, cod_postal) values
			('$this->codigoAux','$this->nombre','$this->detalle', '$this->cod_postal') 
			ON DUPLICATE KEY UPDATE codigo='$this->codigo', nombre = '$this->nombre', detalle='$this->detalle', 
			cod_postal='$this->cod_postal'";
			
			$obj_foro->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_foro->getAffect(); // retorna todos los registros afectados
	
	}	
	function eliminar()	// elimina el cliente
	{
			$obj_foro=new sQuery();
			$query="delete from FORO_INGLES where codigo='$this->codigo'";
			$obj_foro->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_foro->getAffect(); // retorna todos los registros afectados
	
	}	
	
}
function cleanString($string)
{	
    $string=trim($string);
	$string=htmlspecialchars($string);
	
    return $string;
}
?>