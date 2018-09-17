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
		
		$token = isset($_POST['token']) ? $_POST['token'] : '';
		
		$consulta = mysqli_query($connect,"INSERT INTO tokens(token) values ('$token') ON DUPLICATE KEY UPDATE token = '$token'");
		$resultado = array();
		$resultado["consultaExitosa"] = true;
		
		echo json_encode($resultado);
		mysqli_close($connect);
?>