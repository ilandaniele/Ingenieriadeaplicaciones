<div class="bar">
	<a id="nuevoAsiste" class="button" href="javascript:void(0);">Crear nueva asistencia</a>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Dni del usuario</th>
				<th>Id del evento</th>
				<th>Editar</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($view->asistes as $asiste):  // uso la otra sintaxis de php para templates ?>
				<tr>
					<td><?php echo $asiste['dni'];?></td>
					<td><?php echo $asiste['id'];?></td>
					<td><a class="edit" href="javascript:void(0);" data-dni="<?php echo $asiste['dni'];?>" data-id="<?php echo $asiste['id'];?>">Editar</a></td>
					<td><a class="delete" href="javascript:void(0);" data-dni="<?php echo $asiste['dni'];?>" data-id="<?php echo $asiste['id'];?>">Borrar</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>