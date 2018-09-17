
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
		
		$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
		$texto = isset($_POST['texto']) ? $_POST['texto'] : '';
		$tipoaviso = isset($_POST['tipoaviso']) ? $_POST['tipoaviso'] : '';
		$subtexto = isset($_POST['subtexto']) ? $_POST['subtexto'] : '';
		$to = '/topics/'.$tipoaviso;
		echo $to;
		//aca puedo agregar tipo aviso, y ahi con tipo aviso puedo poner si es de un evento o no, entonces podria mandar el mensaje
		//con un topic /nombre de evento/ asi se restringe a los eventos nomas.
		$consulta = mysqli_query($connect,"SELECT token FROM TOKENS");
		$registrationIds= array();
		if($consulta){
			while($row=  mysqli_fetch_array($consulta, MYSQLI_ASSOC)) //fetch array retorna un arreglo con la fila, y el assoc para que no guarde
				{										
					
					$registrationIds[]=$row["token"];
				}
		}
		
		
		// prep the bundle
		$mensaje = [
			'titulo'         => $titulo,
			'contenido'      => $texto,
			'subtexto'       => $subtexto
		];
		
		//'/topics/all'
		$fields = [
			'data'              => $mensaje,
			'to'  				=> $to
		];
		/*
		$fields = [
			'registration_ids'  => $registrationIds,
			'data'              => $mensaje
		];
		*/
		$headers = [
			'Authorization: key= AIzaSyCT6GX7VCjz5P_1pd26lS4q3rvN-_qtSpw',
			'Content-Type: application/json'
		];
		$url = 'https://fcm.googleapis.com/fcm/send';
		
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, $url);
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch );
		if($result == FALSE){
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close( $ch );

		echo $result;
		?>