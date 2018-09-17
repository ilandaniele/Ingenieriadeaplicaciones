<h2><?php echo $view->label ?></h2>
<form name ="usuario" id="usuario" method="POST" action="logicaUsuario.php">
    <?php if($view->label == 'Editar Usuario'){ ?>
		<input type="hidden" name="dni" id="dni" value="<?php print $view->usuario->getDni() ?>">
		
	<?php }else{ ?>
     <div>
        <label>DNI</label>
        <input type="text" name="dni" id="dni" value = "<?php print $view->usuario->getDni() ?>">
    </div>
	<?php } ?>
	<div>
        <label>Username</label>
        <input type="text" name="username" id="username" value = "<?php print $view->usuario->getUsername() ?>">
    </div>
	<div>
        <label>Password</label>
        <input type="text" name="password" id="password" value = "<?php print $view->usuario->getPassword() ?>">
    </div>
    <div>
        <label>Nombre</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" value = "<?php print $view->usuario->getNombre_usuario() ?>">
    </div>
    <div>
        <label>Apellido</label>
        <input type="text" name="apellido" id="apellido" value = "<?php print $view->usuario->getApellido() ?>">
    </div>
	<div>
        <label>Es admin</label>
        <input type="text" name="es_admin" id="es_admin" value = "<?php print $view->usuario->getEs_admin() ?>">
    </div>
    <div class="buttonsBar">
        <input id="cancel" type="button" value ="Cancelar" />
        <input id="submit" type="submit" name="submit" value ="Guardar" />
    </div>
</form>
