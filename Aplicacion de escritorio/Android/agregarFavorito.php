<?php

		$connection['server']="localhost";  //host
		$connection['user']="root";         //  usuario
		$connection['pass']="";             //password
		$connection['base']="congreso";           //base de datos
		$connect= mysqli_connect($connection['server'],$connection['user'],$connection['pass']);
		
		
		if (mysqli_connect_errno()) {
			printf("Falló la conexión: %s\n", mysqli_connect_error());
			exit();
		}
		if ($connect) // si la conexion fue exitosa , selecciona la base
		{
			mysqli_select_db($connect,$connection['base']);			
			
			
		}
		//$dni = json_decode($_POST["dni"], false);
		//$id = json_decode($_POST["id"], false);
		$dni = isset($_POST['dni']) ? $_POST['dni'] : '';
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		
		$statement = mysqli_prepare($connect,"insert into ASISTE (dni, id) values (?,?) ");
		mysqli_stmt_bind_param($statement,"ii",$dni,$id);
		mysqli_stmt_execute($statement);
		$statement = mysqli_prepare($connect,"insert into ASISTE_FRANCES (dni, id) values (?,?) ");
		mysqli_stmt_bind_param($statement,"ii",$dni,$id);
		mysqli_stmt_execute($statement);
		$statement = mysqli_prepare($connect,"insert into ASISTE_INGLES (dni, id) values (?,?) ");
		mysqli_stmt_bind_param($statement,"ii",$dni,$id);
		mysqli_stmt_execute($statement);
		//$consulta = mysqli_query($connect,"insert into ASISTE (dni, id) values ('$dni','$id') ");
		$resultado = array();
		$resultado["consultaExitosa"] = true;
		$resultado["dni"]=$dni;
		$resultado["id"]=$id;
		echo json_encode($resultado);
		mysqli_close($connect );
?>