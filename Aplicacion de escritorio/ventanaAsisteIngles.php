<h2><?php echo $view->label ?></h2>

<form name ="asiste" id="asiste" method="POST" action="logicaAsisteIngles.php">
    <?php if($view->label == 'Editar Asiste'){ ?>
		<input type="hidden" name="dni" id="dni" value="<?php print $view->asiste->getDni() ?>">
		<input type="hidden" name="idVieja" id="idVieja" value = "<?php print $view->asiste->getId() ?>">
	<?php }else{ ?>
     <div>
        <label>DNI</label>
        <input type="text" name="dni" id="dni" value = "<?php print $view->asiste->getDni() ?>">
    </div>
	<?php } ?>
	<div>
        <label>Id del evento</label>
        <input type="text" name="id" id="id" value = "<?php print $view->asiste->getId() ?>">
		
    </div>
    <div class="buttonsBar">
        <input id="cancel" type="button" value ="Cancelar" />
        <input id="submit" type="submit" name="submit" value ="Guardar" />
    </div>
</form>
