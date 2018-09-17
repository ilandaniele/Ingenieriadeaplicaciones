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




class Usuario
{
	var $username;    
	var $password;
	var $nombre_usuario;
	var $apellido;
	var $dni;
	var $es_admin;
	var $dniAux;
	
    public static function getUsuarios() 
		{
			$obj_usuario=new sQuery();
			$obj_usuario->executeQuery("select * from USUARIO"); 
			return $obj_usuario->fetchAll(); 
		}

	function Usuario ($nro=0) 
	{
		
		if ($nro!=0)
		{
			$obj_usuario=new sQuery();
			$result=$obj_usuario->executeQuery("select * from USUARIO where dni = '$nro'"); 
			$row=mysqli_fetch_array($result);
			$this->dni=$row['dni'];
			$this->username=$row['username'];
			$this->password=$row['password'];
			$this->nombre_usuario=$row['nombre_usuario'];
			$this->apellido=$row['apellido'];
			$this->es_admin=$row['es_admin'];
			
		}
	}
		
		// metodos que devuelven valores
	function getDni()
	 { return $this->dni;}
	function getUsername()
	 { return $this->username;}
	function getPassword()
	 { return $this->password;}
	function getNombre_usuario()
	 { return $this->nombre_usuario;}
	function getApellido()
	 { return $this->apellido;}
	function getEs_admin()
	 { return $this->es_admin;}
	 
	 
		// metodos que setean los valores
	function setDniAux($val)
	 { $this->dniAux=$val;}
	function setUsername($val)
	 { $this->username=$val;}
	function setPassword($val)
	 {  $this->password=$val;}
	function setNombre_usuario($val)
	 {  $this->nombre_usuario=$val;}
	function setApellido($val)
	 {  $this->apellido=$val;}
	 function setEs_admin($val)
	 { $this->es_admin=$val;}
	

    function save()
    {	
        if($this->dni)
        {$this->updateUsuario();}
        else
        {$this->insertUsuario();}
    }
	
	private function updateUsuario()	
	{	
				$obj_usuario=new sQuery();
				$query="update USUARIO set username='$this->username',  password='$this->password', nombre_usuario='$this->nombre_usuario',
				apellido='$this->apellido', dni = '$this->dniAux', es_admin='$this->es_admin' where dni = '$this->dni'";
				$obj_usuario->executeQuery($query); // ejecuta la consulta para traer al cliente 
				return $obj_usuario->getAffect(); // retorna todos los registros afectados
			
	}
	private function insertUsuario()	// inserta el cliente cargado en los atributos
	{		
			
			$obj_usuario=new sQuery();
			$query="insert into usuario(username, password, nombre_usuario, apellido, dni, es_admin) values
			('$this->username','$this->password', '$this->nombre_usuario','$this->apellido','$this->dniAux','$this->es_admin') 
			ON DUPLICATE KEY UPDATE username = '$this->username', password='$this->password', 
			nombre_usuario='$this->nombre_usuario', apellido = '$this->apellido', dni='$this->dni', es_admin='$this->es_admin'";
			
			$obj_usuario->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_usuario->getAffect(); // retorna todos los registros afectados
	
	}	
	function eliminar()	// elimina el cliente
	{
			$obj_usuario=new sQuery();
			$query="delete from usuario where dni='$this->dni'";
			$obj_usuario->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_usuario->getAffect(); // retorna todos los registros afectados
	
	}	
	
}
function cleanString($string)
{	
    $string=trim($string);
	$string=htmlspecialchars($string);
	
    return $string;
}
?>