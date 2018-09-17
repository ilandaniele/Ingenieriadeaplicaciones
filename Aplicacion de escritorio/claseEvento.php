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




class Evento
{
	var $nombre;     //se declaran los atributos de la clase, que son los atributos del cliente
	var $lugar;
	var $fecha;
	var $horainicio;
	var $horafin;
	var $detalle;
	var $nombre_foro;
	var $id;
	var $idAux;
	
    public static function getEventos() 
		{
			$obj_evento=new sQuery();
			$obj_evento->executeQuery("select * from EVENTO"); // ejecuta la consulta para traer a los eventos

			return $obj_evento->fetchAll(); // retorna todos los eventos
		}

	function Evento($nro=0) // declara el constructor, si trae el nombre de evento lo busca , si no, trae todos los eventos
	{	//aca puedo ver el tema del borrar y el editar, el editar basicamente veo que no permite editar el nombre de un evento ya creado
	//hay que cambiarle el atributo clave al evento, y en vez de ponerle el nombre, ponerle el id, y vuelvo a poner el atributo hidden en ventanaEvento, que es el id
		
		if ($nro!=0)
		{
			$obj_evento=new sQuery();
			$result=$obj_evento->executeQuery("select * from EVENTO where id = '$nro'"); // ejecuta la consulta para traer al evento
			$row=mysqli_fetch_array($result);
			$this->id=$row['id'];
			$this->nombre=$row['nombre'];
			$this->lugar=$row['lugar'];
			$this->fecha=$row['fecha'];
			$this->horainicio=$row['horainicio'];
			$this->horafin=$row['horafin'];
			$this->detalle=$row['detalle'];
			$this->nombre_foro=$row['nombre_foro'];
		}
	}
		
		// metodos que devuelven valores
	function getId()
	 { return $this->id;}
	function getNombre()
	 { return $this->nombre;}
	function getLugar()
	 { return $this->lugar;}
	function getFecha()
	 { return $this->fecha;}
	function getHoraInicio()
	 { return $this->horainicio;}
	function getHoraFin()
	 { return $this->horafin;}
	 function getDetalle()
	 { return $this->detalle;}
	 function getNombreForo()
	 { return $this->nombre_foro;}
	 
		// metodos que setean los valores
	function setIdAux($val)
	 { $this->idAux=$val;}
	function setNombre($val)
	 { $this->nombre=$val;}
	function setLugar($val)
	 {  $this->lugar=$val;}
	function setFecha($val)
	 {  $this->fecha=$val;}
	function setHoraInicio($val)
	 {  $this->horainicio=$val;}
	 function setHoraFin($val)
	 { $this->horafin=$val;}
	 function setDetalle($val)
	 { $this->detalle=$val;}
	 function setNombreForo($val)
	 { $this->nombre_foro=$val;}

    function save()
    {	
        if($this->id)
        {$this->updateEvento();}
        else
        {$this->insertEvento();}
    }
	
	private function updateEvento()	// actualiza el cliente cargado en los atributos
	{		
				$obj_evento=new sQuery();
				$query="update EVENTO set id = '$this->idAux', nombre='$this->nombre', lugar='$this->lugar',
				fecha='$this->fecha',horainicio='$this->horainicio',horafin='$this->horafin',detalle='$this->detalle',
				nombre_foro='$this->nombre_foro' where id = '$this->id'";
				$obj_evento->executeQuery($query); // ejecuta la consulta para traer al cliente 
				return $obj_evento->getAffect(); // retorna todos los registros afectados
				
	}
	private function insertEvento()	// inserta el cliente cargado en los atributos
	{		
			
			$obj_evento=new sQuery();
			$query="insert into EVENTO(id, nombre, lugar, fecha, horainicio, horafin, detalle, nombre_foro)values
			('$this->idAux','$this->nombre', '$this->lugar','$this->fecha','$this->horainicio','$this->horafin','$this->detalle','$this->nombre_foro') 
			ON DUPLICATE KEY UPDATE id = '$this->id', nombre='$this->nombre', lugar='$this->lugar', fecha = '$this->fecha', horainicio='$this->horainicio',
			horafin='$this->horafin', detalle='$this->detalle', nombre_foro ='$this->nombre_foro'";
			
			$obj_evento->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_evento->getAffect(); // retorna todos los registros afectados
	
	}	
	function eliminar()	// elimina el cliente
	{
			$obj_evento=new sQuery();
			$query="delete from EVENTO where id='$this->id'";
			$obj_evento->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_evento->getAffect(); // retorna todos los registros afectados
	
	}	
	
}
function cleanString($string)
{	
    $string=trim($string);
	$string=htmlspecialchars($string);
	
    return $string;
}
?>