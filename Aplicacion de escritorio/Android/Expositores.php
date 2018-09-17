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
			$cons= 'select * from usuario natural join expositor natural join evento natural join presenta';
		}else{
			if(strcmp($idioma,'2') == 0){
				$cons= 'select * from usuario natural join expositor_ingles natural join evento_ingles natural join presenta_ingles';
			}else{
				if(strcmp($idioma,'3') == 0){
					$cons = 'select * from usuario natural join expositor_frances natural join evento_frances natural join presenta_frances';
				}
			}
		}
		
		$consulta = mysqli_query($connect,$cons);
		$filas= array();
		if($consulta){
			while($row=  mysqli_fetch_array($consulta, MYSQLI_ASSOC)) //fetch array retorna un arreglo con la fila, y el assoc para que no guarde
				{														// en doble lo que obtiene, osea "0,33,id,33"
					$filas[]=$row;
				}
		}
		//despues deberia hacer $rows[0]["nombre"];
		
		
		$resultado = array();
		$resultado["consultaExitosa"] = true;
		
		$resultado["filas"]=$filas; //le asigno el arreglo de filas a una componente del arreglo resultado
		
		echo json_encode($resultado);
		mysqli_close($connect );
?>