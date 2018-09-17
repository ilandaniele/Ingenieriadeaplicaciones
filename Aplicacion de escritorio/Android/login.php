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
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';
		$consulta = mysqli_query($connect,"select * from usuario where username = '$username' and password = '$password'");
		$login=false;
		$resultado = array();
		if($consulta){
			while($row=  mysqli_fetch_array($consulta, MYSQLI_ASSOC)) 
				{														
					$login = true;
					$resultado["password"]=$row["password"];
					$resultado["username"] = $row["username"];
					$resultado["nombre_usuario"] = $row["nombre_usuario"];
					$resultado["apellido"] = $row["apellido"];
					$resultado["dni"] = $row["dni"];
					if($row["es_admin"] == 1){
						$resultado["es_admin"] = true ;
					}else{
						$resultado["es_admin"] = false;
					}
					
				}
		}
		
		
		$resultado["consultaExitosa"] = true;
		$resultado["login"]=$login;
		
		echo json_encode($resultado);
		mysqli_close($connect);
?>