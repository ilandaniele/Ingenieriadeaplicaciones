<?php
$op=isset($_POST["op"]) ? $_POST["op"] : ''; //obtenemos el valor de la accion que se esta haciendo
if (isset($op) && $op=="login") //si tiene valor y es 'login'
$ok=validar_ingreso(); //validamos el ingreso
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Iniciar Sesión</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body>
	<?php if($op && !$ok){ //si no se logeo correctamente
		print("Usuario o contraseña errónea");
	} ?>
    <div class="container">

      <form class="form-signin" method="post" action="<?php print($_SERVER["PHP_SELF"]);?>">
        <h2 class="form-signin-heading">Autentiquese</h2>
		<input type="hidden" name="op" value="login"/>
        <label for="usuario" class="sr-only">Nombre Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" name ="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar">Entrar</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>


<?php 
function validar_ingreso(){
	$usuario=$_POST["usuario"]; //obtengo el parametro usuario del formulario
	$contrasenia=$_POST["inputPassword"]; //y la contrasenia
	$conn=mysqli_connect("localhost", "root", "") or die (mysqli_error($conn)); //nos conectamos a la base de datos
	mysqli_select_db($conn,"congreso") or die (mysqli_error($conn)); //cambiamos de base de datos
	//creamos un comando SQL
	$query="SELECT * FROM usuario WHERE username='$usuario' AND password='$contrasenia'";
	$res=mysqli_query($conn,$query) or die (mysqli_error($conn)); //ejecuto el comando

	if ($res ){ //.. si se ejecuto correctamente, el valor de $res no es falso

		 if ($reg=mysqli_fetch_object($res)){ //obtengo todo el registro como un objeto
			 session_start(); //inicio las variables de sesion...
			 $_SESSION["usuario"]=$reg; //..  y almaceno el valor del objeto en la sesion
			 header("Location: inicio.php"); //y redirecciono al index de la aplicacion
			 mysqli_close($conn);// cierro la conexion a la base de datos
			 return true; //termino todo correctamente
		 }
	}
	mysqli_close($conn);// cierro la conexion a la base de datos
	//si no devuelvo nada, la funcion retornara false.
}
?>
