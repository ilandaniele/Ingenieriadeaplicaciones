<h2><?php echo $view->label ?></h2>
<form name ="ciudad frances" id="ciudad" method="POST" action="logicaCiudadFrances.php">
    <?php if($view->label == 'Editar Ciudad'){ ?>
		<input type="hidden" name="cod_postal" id="cod_postal" value="<?php print $view->ciudad->getCodigoPostal() ?>">
		
	<?php }else{ ?>
     <div>
        <label>CodigoPostal</label>
        <input type="text" name="cod_postal" id="cod_postal" value = "<?php print $view->ciudad->getCodigoPostal() ?>">
    </div>
	<?php } ?>
	<div>
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre" value = "<?php print $view->ciudad->getNombre() ?>">
    </div>
	<div>
        <label>InformacionTuristica</label>
        <input type="text" name="inf_turistica" id="inf_turistica" value = "<?php print $view->ciudad->getInformacionTuristica() ?>">
    </div>
    
    <div class="buttonsBar">
        <input id="cancel" type="button" value ="Cancelar" />
        <input id="submit" type="submit" name="submit" value ="Guardar" />
    </div>
</form>
