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




class Expositor
{
	var $dni;     //se declaran los atributos de la clase, que son los atributos del cliente
	var $institucion;
	var $biografia;
	var $cargo;
	var $dniAux;
	
	
    public static function getExpositores() 
		{
			$obj_expositor=new sQuery();
			$obj_expositor->executeQuery("select * from EXPOSITOR"); 

			return $obj_expositor->fetchAll(); 
		}

	function Expositor($nro=0) 
	{	
		
		if ($nro!=0)
		{
			$obj_expositor=new sQuery();
			$result=$obj_expositor->executeQuery("select * from EXPOSITOR where dni = '$nro'"); // ejecuta la consulta para traer al evento
			$row=mysqli_fetch_array($result);
			$this->dni=$row['dni'];
			$this->institucion=$row['institucion'];
			$this->biografia=$row['biografia'];
			$this->cargo=$row['cargo'];
			
		}
	}
		
		// metodos que devuelven valores
	function getDni()
	 { return $this->dni;}
	function getInstitucion()
	 { return $this->institucion;}
	function getBiografia()
	 { return $this->biografia;}
	function getCargo()
	 { return $this->cargo;}
	
	 
		// metodos que setean los valores
	function setDniAux($val)
	 { $this->dniAux=$val;}
	function setInstitucion($val)
	 { $this->institucion=$val;}
	function setCargo($val)
	 {  $this->cargo=$val;}
	function setBiografia($val)
	 {  $this->biografia=$val;}
	

    function save()
    {	
        if($this->dni)
        {$this->updateExpositor();}
        else
        {$this->insertExpositor();}
    }
	
	private function updateExpositor()	// actualiza el cliente cargado en los atributos
	{		/*
			$obj_aux=new sQuery();
			$obj_aux->executeQuery("select * from EVENTO where id = $this->id"); // ejecuta la consulta para traer a los eventos
			//checkeo si no me devuelve nulo
			$rowcount=mysqli_num_rows($obj_aux->consulta);
			if($rowcount>0){ */
				$obj_expositor=new sQuery();
				$query="update EXPOSITOR set dni = '$this->dniAux', institucion='$this->institucion', cargo='$this->cargo',
				biografia='$this->biografia' where dni = '$this->dni'";
				$obj_expositor->executeQuery($query); // ejecuta la consulta para traer al cliente 
				return $obj_expositor->getAffect(); // retorna todos los registros afectados
				/*
			}else{
				$obj_evento=new sQuery();
				$query="insert into EVENTO(nombre, lugar, fecha, horainicio, horafin, detalle, nombre_foro)values
				('$this->nombre', '$this->lugar','$this->fecha','$this->horainicio','$this->horafin','$this->detalle','$this->nombre_foro') ";
			
				$obj_evento->executeQuery($query); // ejecuta la consulta para traer al cliente 
				return $obj_evento->getAffect(); // retorna todos los registros afectados
			}	*/
	}
	private function insertExpositor()	// inserta el cliente cargado en los atributos
	{		
			
			$obj_expositor=new sQuery();
			$query="insert into EXPOSITOR(dni, institucion, cargo, biografia)values
			('$this->dniAux','$this->institucion', '$this->cargo','$this->biografia') 
			ON DUPLICATE KEY UPDATE dni = '$this->dni', institucion='$this->institucion', cargo='$this->cargo', biografia = '$this->biografia'";
			
			$obj_expositor->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_expositor->getAffect(); // retorna todos los registros afectados
	
	}	
	function eliminar()	// elimina el cliente
	{
			$obj_expositor=new sQuery();
			$query="delete from EXPOSITOR where dni='$this->dni'";
			$obj_expositor->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_expositor->getAffect(); // retorna todos los registros afectados
	
	}	
	
}
function cleanString($string)
{	
    $string=trim($string);
	$string=htmlspecialchars($string);
	
    return $string;
}
?>