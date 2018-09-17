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
		
		$idioma = isset($_POST['idioma']) ? $_POST['idioma'] : '';
		$cons;
		if(strcmp($idioma,'1') == 0){
			$cons= "select * from foro";
		}else{
			if(strcmp($idioma,'2') == 0){
				$cons= "select * from foro_ingles";
			}else{
				if(strcmp($idioma,'3') == 0){
					$cons = "select * from foro_frances";
				}
			}
		}
		$consulta = mysqli_query($connect,$cons);
		$filas=array();
		if($consulta){
			while($row=  mysqli_fetch_array($consulta, MYSQLI_ASSOC)) 
				{														
					$filas[]=$row;
				}
		}
		
		$resultado = array();
		$resultado["consultaExitosa"] = true;
		$resultado["filas"]=$filas;
		
		echo json_encode($resultado);
		mysqli_close($connect);
?>