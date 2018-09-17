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




class CiudadFrances
{
	var $cod_postal;     //se declaran los atributos de la clase
	var $cod_postalAux;
	var $nombre;
	var $inf_turistica;

	
    public static function getCiudad() 
		{
			$obj_ciudad=new sQuery();
			$obj_ciudad->executeQuery("select * from CIUDAD_FRANCES");

			return $obj_ciudad->fetchAll(); // retorna todas las ciudades
		}

	function CiudadFrances($cod_postal=0) // declara el constructor
	{	
		if ($cod_postal!=0)
		{
			$obj_ciudad=new sQuery();
			$result=$obj_ciudad->executeQuery("select * from CIUDAD_FRANCES where cod_postal = '$cod_postal'"); 
			$row=mysqli_fetch_array($result);
			$this->cod_postal=$row['cod_postal'];
			$this->nombre=$row['nombre'];
			$this->inf_turistica=$row['inf_turistica'];
		}
	}
		
		// metodos que devuelven valores
	function getNombre()
	 { return $this->nombre;}
	function getCodigoPostal()
	 { return $this->cod_postal;}
	function getInformacionTuristica()
	 { return $this->inf_turistica;}

	 
		// metodos que setean los valores
	function setNombre($val)
	 { $this->nombre=$val;}
	function setCodigoPostalAux($val)
	 {  $this->cod_postalAux=$val;}
	function setInformacionTuristica($val)
	 {  $this->inf_turistica=$val;}


    function save()
    {	
        if($this->cod_postal)
        {$this->updateCiudad();}
        else
        {$this->insertCiudad();}
    }
	
	private function updateCiudad()	// actualiza el cliente cargado en los atributos
	{		
				$obj_ciudad=new sQuery();
				$query="update CIUDAD_FRANCES set cod_postal = '$this->cod_postalAux', nombre='$this->nombre', inf_turistica='$this->inf_turistica'";
				$obj_ciudad->executeQuery($query); // ejecuta la consulta para traer al cliente 
				return $obj_ciudad->getAffect(); // retorna todos los registros afectados
				
	}
	private function insertCiudad()	// inserta el cliente cargado en los atributos
	{		
			
			$obj_ciudad=new sQuery();
			$query="insert into CIUDAD_FRANCES(cod_postal, nombre, inf_turistica)values
			('$this->cod_postalAux','$this->nombre', '$this->inf_turistica') 
			ON DUPLICATE KEY UPDATE cod_postal = '$this->cod_postal', nombre='$this->nombre', inf_turistica='$this->inf_turistica'";
			
			$obj_ciudad->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_ciudad->getAffect(); // retorna todos los registros afectados
	
	}	
	function eliminar()	// elimina el cliente
	{
			$obj_ciudad=new sQuery();
			$query="delete from CIUDAD_FRANCES where cod_postal='$this->cod_postal'";
			$obj_ciudad->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_ciudad->getAffect(); // retorna todos los registros afectados
	
	}	
	
}
function cleanString($string)
{	
    $string=trim($string);
	$string=htmlspecialchars($string);
	
    return $string;
}
?>