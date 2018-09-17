<h2><?php echo $view->label ?></h2>
<form name ="evento" id="evento" method="POST" action="logicaEventoAcademicoFrances.php">
    <?php if($view->label == 'Editar Evento'){ ?>
		<input type="hidden" name="id" id="id" value="<?php print $view->evento->getId() ?>">
		
	<?php }else{ ?>
     <div>
        <label>ID</label>
        <input type="text" name="id" id="id" value = "<?php print $view->evento->getId() ?>">
    </div>
	<?php } ?>
	<div>
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre" value = "<?php print $view->evento->getNombre() ?>">
    </div>
	<div>
        <label>Aula</label>
        <input type="text" name="aula" id="aula" value = "<?php print $view->evento->getAula() ?>">
    </div>
    
    <div class="buttonsBar">
        <input id="cancel" type="button" value ="Cancelar" />
        <input id="submit" type="submit" name="submit" value ="Guardar" />
    </div>
</form>
