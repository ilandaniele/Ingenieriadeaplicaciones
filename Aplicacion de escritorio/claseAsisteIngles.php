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




class Asiste
{
	var $dni;     //se declaran los atributos de la clase, que son los atributos del cliente
	var $id;
	var $dniAux;
	var $idAux;
	var $idVieja;
	
    public static function getAsistes() 
		{
			$obj_asiste=new sQuery();
			$obj_asiste->executeQuery("select * from ASISTE_INGLES"); 

			return $obj_asiste->fetchAll(); 
		}

	function Asiste($nro=0,$nro2=0) 
	{	
		
		if ($nro!=0 && $nro2!=0)
		{
			$obj_asiste=new sQuery();
			$result=$obj_asiste->executeQuery("select * from ASISTE_INGLES where dni = '$nro' and id ='$nro2'"); // ejecuta la consulta para traer al evento
			$row=mysqli_fetch_array($result);                                                             //para ver si existe, en este caso no existira,
			$this->dni=$row['dni'];																		//y estas variables dni y id no tendran nada
			$this->id=$row['id'];
			
			
		}
	}
		
		// metodos que devuelven valores
	function getDni()
	 { return $this->dni;}
	function getId()
	 { return $this->id;}
	
	
	 
		// metodos que setean los valores
	function setDniAux($val)
	 { $this->dniAux=$val;}
	function setIdAux($val)
	 { $this->idAux=$val;}
	function setIdVieja($val){
		$this->idVieja=$val;
	}
	

    function save()
    {	
        if($this->dni && $this->id){
			$this->updateAsiste();
		}else{
			$this->insertAsiste();
			}
    }
	
	private function updateAsiste()	// actualiza el cliente cargado en los atributos
	{		
				$obj_asiste=new sQuery();
				$query="update ASISTE_INGLES set dni = '$this->dniAux', id='$this->idAux' where dni = '$this->dni' and id ='$this->id'";
				$obj_asiste->executeQuery($query); // ejecuta la consulta para traer al cliente 
				return $obj_asiste->getAffect(); // retorna todos los registros afectados
				
	}
	private function insertAsiste()	// inserta el cliente cargado en los atributos
	{		
			
			$obj_asiste=new sQuery();
			$query="insert into ASISTE_INGLES(dni,id) values ('$this->dniAux','$this->idAux')"; 
			//ON DUPLICATE KEY UPDATE dni = '$this->dni', id='$this->idAux'";
			
			$obj_asiste->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_asiste->getAffect(); // retorna todos los registros afectados
	
	}	
	function eliminar()	// elimina el cliente
	{
			$obj_asiste=new sQuery();
			$query="delete from ASISTE_INGLES where dni='$this->dni' and id='$this->id'";
			$obj_asiste->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_asiste->getAffect(); // retorna todos los registros afectados
	
	}	
	
}
function cleanString($string)
{	
    $string=trim($string);
	$string=htmlspecialchars($string);
	
    return $string;
}
?>