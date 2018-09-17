<h2><?php echo $view->label ?></h2>
<form name ="evento" id="evento" method="POST" action="logicaEvento.php">
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
        <label>Lugar</label>
        <input type="text" name="lugar" id="lugar" value = "<?php print $view->evento->getLugar() ?>">
    </div>
    <div>
        <label>Fecha</label>
        <input type="text" name="fecha" id="fecha" value = "<?php print $view->evento->getFecha() ?>">(yyyy-mm-dd)
    </div>
    <div>
        <label>Hora de inicio</label>
        <input type="text" name="horainicio" id="horainicio" value = "<?php print $view->evento->getHoraInicio() ?>">
    </div>
	<div>
        <label>Hora de finalización</label>
        <input type="text" name="horafin" id="horafin" value = "<?php print $view->evento->getHoraFin() ?>">
    </div>
	<div>
        <label>Detalle</label>
        <input type="text" name="detalle" id="detalle" value = "<?php print $view->evento->getDetalle() ?>">
    </div>
	<div>
        <label>Nombre del foro</label>
        <input type="text" name="nombre_foro" id="nombre_foro" value = "<?php print $view->evento->getNombreForo() ?>">
    </div>
    <div class="buttonsBar">
        <input id="cancel" type="button" value ="Cancelar" />
        <input id="submit" type="submit" name="submit" value ="Guardar" />
    </div>
</form>
