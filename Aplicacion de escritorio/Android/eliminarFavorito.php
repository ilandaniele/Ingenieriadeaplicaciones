<?php

		$connection['server']="localhost";  //host
		$connection['user']="root";         //  usuario
		$connection['pass']="";             //password
		$connection['base']="congreso";           //base de datos
		$connect= mysqli_connect($connection['server'],$connection['user'],$connection['pass']);
		$id = $_POST["id"];
		$dni = $_POST["dni"];
		if (mysqli_connect_errno()) {
			printf("Falló la conexión: %s\n", mysqli_connect_error());
			exit();
		}
		if ($connect) // si la conexion fue exitosa , selecciona la base
		{
			mysqli_select_db($connect,$connection['base']);			
			
			
		}
		
		$consulta = mysqli_query($connect,"delete from ASISTE where id='$id'and dni='$dni'");
		$consulta = mysqli_query($connect,"delete from ASISTE_INGLES where id='$id'and dni='$dni'");
		$consulta = mysqli_query($connect,"delete from ASISTE_FRANCES where id='$id'and dni='$dni'");
		$resultado = array();
		$resultado["consultaExitosa"] = true;
		
		echo json_encode($resultado);
		mysqli_close($connect );
?>