<h2><?php echo $view->label ?></h2>
<h2><?php echo 'cuidado, es necesario agregar primero al usuario para agregar un expositor' ?></h2>
<form name ="expositor" id="expositor" method="POST" action="logicaExpositorFrances.php">
    <?php if($view->label == 'Editar Expositor'){ ?>
		<input type="hidden" name="dni" id="dni" value="<?php print $view->expositor->getDni() ?>">
		
	<?php }else{ ?>
     <div>
        <label>DNI</label>
        <input type="text" name="dni" id="dni" value = "<?php print $view->expositor->getDni() ?>">
    </div>
	<?php } ?>
	<div>
        <label>Institucion</label>
        <input type="text" name="institucion" id="institucion" value = "<?php print $view->expositor->getInstitucion() ?>">
    </div>
	<div>
        <label>Cargo</label>
        <input type="text" name="cargo" id="cargo" value = "<?php print $view->expositor->getCargo() ?>">
    </div>
    <div>
        <label>Biografia</label>
        <input type="text" name="biografia" id="biografia" value = "<?php print $view->expositor->getBiografia() ?>">
    </div>
    <div class="buttonsBar">
        <input id="cancel" type="button" value ="Cancelar" />
        <input id="submit" type="submit" name="submit" value ="Guardar" />
    </div>
</form>
