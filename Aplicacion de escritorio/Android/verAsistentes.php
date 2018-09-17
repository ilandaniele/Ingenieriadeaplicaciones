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
		
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$consulta = mysqli_query($connect,"select * from ASISTE where id = $id");
		$cantidad = 0;
		if($consulta){
			while($row=  mysqli_fetch_array($consulta, MYSQLI_ASSOC)) //fetch array retorna un arreglo con la fila, y el assoc para que no guarde
				{														// en doble lo que obtiene, osea "0,33,id,33"
					$cantidad = $cantidad + 1;
				}
		}
		
		$resultado = array();
		$resultado["consultaExitosa"] = true;
	
		$resultado["cantidad"]=$cantidad;
		echo json_encode($resultado);
		mysqli_close($connect );
?>