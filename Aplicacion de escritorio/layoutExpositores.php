<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Foro Arfitec</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- incluyo el archivo que tiene mis funciones javascript -->
    <script type="text/javascript" src="resources/functionsExpositores.js"></script>
    <!-- incluyo el framework css , blueprint. -->
    <link rel="stylesheet" type="text/css" href="resources/screen.css" />
    <!-- incluyo mis estilos css -->
    <link rel="stylesheet" type="text/css" href="resources/style.css" />
	
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Aplicación de escritorio</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
           
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <a href="index.php" class="btn btn-outline-success my-2 my-sm-0">Cerrar Sesión</a>
          </form>
        </div>
      </nav>
    </header>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="inicio.php">Overview </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logicaEvento.php">Eventos en español </a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaEventoIngles.php">Eventos en inglés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaEventoFrances.php">Eventos en francés</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logicaEventoAcademico.php">Eventos académicos en español  </a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaEventoAcademicoIngles.php">Eventos académicos en inglés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaEventoAcademicoFrances.php">Eventos académicos en francés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaEventoSocial.php">Eventos sociales en español</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaEventoSocialIngles.php">Eventos sociales en inglés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaEventoSocialFrances.php">Eventos sociales en francés</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="logicaExpositor.php">Expositores en español<span class="sr-only">(current)</span></a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaExpositorIngles.php">Expositores en inglés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaExpositorFrances.php">Expositores en francés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaPresenta.php">Presenta en español</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaPresentaIngles.php">Presenta en inglés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaPresentaFrances.php">Presenta en francés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaAsiste.php">Asiste en español</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaAsisteIngles.php">Asiste en inglés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaAsisteFrances.php">Asiste en francés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaCiudad.php">Ciudad en español</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaCiudadIngles.php">Ciudad en inglés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaCiudadFrances.php">Ciudad en francés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaForo.php">Foro en español</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaForoIngles.php">Foro en inglés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaForoFrances.php">Foro en francés</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="logicaUsuario.php">Usuarios</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="panelAvanzado.php">Reporte</a>
            </li>
          </ul>

         

          
        </nav>

         <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1>Bienvenido</h1>
			
          
		 <h2>Titulo</h2>
			<div id ="block"> </div>
				<div class="container">
					
					<div id="popupbox"></div>
					<div id="content">
						<?php include_once ($view->contentTemplate); // incluyo el template que corresponda ?>
					</div>
				</div>
			
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
    <script
          src="https://code.jquery.com/jquery-2.2.4.min.js"
          integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
          crossorigin="anonymous"></script>
	<script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-2.2.4.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>