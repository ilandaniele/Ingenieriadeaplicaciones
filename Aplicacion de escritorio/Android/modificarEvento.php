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
		
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
		$lugar = isset($_POST['lugar']) ? $_POST['lugar'] : '';
		$detalle = isset($_POST['detalle']) ? $_POST['detalle'] : '';
		$horainicio = isset($_POST['horainicio']) ? $_POST['horainicio'] : '';
		$horafin = isset($_POST['horafin']) ? $_POST['horafin'] : '';
		$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
		$aula = isset($_POST['aula']) ? $_POST['aula'] : '';
		
		$idioma = isset($_POST['idioma']) ? $_POST['idioma'] : '';
		$cons;
		if(strcmp($idioma,'1') == 0){
			$cons= "update EVENTO set nombre = '$nombre', lugar = '$lugar', detalle= '$detalle', fecha = '$fecha', horainicio = '$horainicio', horafin = '$horafin' where evento.id='$id'";
			$cons2= "update EVENTOACADEMICO set nombre = '$nombre', aula='$aula' where eventoacademico.id='$id'";
		}else{
			if(strcmp($idioma,'2') == 0){
				$cons= "update EVENTO_INGLES set nombre = '$nombre', lugar = '$lugar', detalle= '$detalle', fecha = '$fecha', horainicio = '$horainicio', horafin = '$horafin' where evento_ingles.id='$id'";
				$cons2= "update EVENTOACADEMICO_INGLES set nombre = '$nombre', aula='$aula' where eventoacademico_ingles.id='$id'";
			}else{
				if(strcmp($idioma,'3') == 0){
					$cons= "update EVENTO_FRANCES set nombre = '$nombre', lugar = '$lugar', detalle= '$detalle', fecha = '$fecha', horainicio = '$horainicio', horafin = '$horafin' where evento_frances.id='$id'";
					$cons2= "update EVENTOACADEMICO_FRANCES set nombre = '$nombre', aula='$aula' where eventoacademico_frances.id='$id'";
				}
			}
		}
		
		$consulta= mysqli_query($connect,$cons);
		$consulta2= mysqli_query($connect,$cons2);
		
		$resultado = array();
		$resultado["consultaExitosa"] = true;
		
		echo json_encode($resultado);
		mysqli_close($connect );
?>