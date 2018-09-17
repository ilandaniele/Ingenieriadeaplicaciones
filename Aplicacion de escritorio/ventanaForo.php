<h2><?php echo $view->label ?></h2>
<form name ="foro" id="foro" method="POST" action="logicaForo.php">
    <?php if($view->label == 'Editar Foro'){ ?>
		<input type="hidden" name="codigo" id="codigo" value="<?php print $view->foro->getCodigo() ?>">
		
	<?php }else{ ?>
     <div>
        <label>Codigo</label>
        <input type="text" name="codigo" id="codigo" value = "<?php print $view->foro->getCodigo() ?>">
    </div>
	<?php } ?>
	<div>
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre" value = "<?php print $view->foro->getNombre() ?>">
    </div>
	<div>
        <label>Detalle</label>
        <input type="text" name="detalle" id="detalle" value = "<?php print $view->foro->getDetalle() ?>">
    </div>
    <div>
        <label>Codigo postal</label>
        <input type="text" name="cod_postal" id="cod_postal" value = "<?php print $view->foro->getCod_postal() ?>">
    </div>
    <div class="buttonsBar">
        <input id="cancel" type="button" value ="Cancelar" />
        <input id="submit" type="submit" name="submit" value ="Guardar" />
    </div>
</form>
