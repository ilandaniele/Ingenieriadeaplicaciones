<h2><?php echo $view->label ?></h2>

<form name ="presenta" id="presenta" method="POST" action="logicaPresentaFrances.php">
    <?php if($view->label == 'Editar Presenta'){ ?>
		<input type="hidden" name="dni" id="dni" value="<?php print $view->presenta->getDni() ?>">
		<input type="hidden" name="idVieja" id="idVieja" value = "<?php print $view->presenta->getId() ?>">
	<?php }else{ ?>
     <div>
        <label>DNI del presentador</label>
        <input type="text" name="dni" id="dni" value = "<?php print $view->presenta->getDni() ?>">
    </div>
	<?php } ?>
	<div>
        <label>Id del evento</label>
        <input type="text" name="id" id="id" value = "<?php print $view->presenta->getId() ?>">
		
    </div>
    <div class="buttonsBar">
        <input id="cancel" type="button" value ="Cancelar" />
        <input id="submit" type="submit" name="submit" value ="Guardar" />
    </div>
</form>
