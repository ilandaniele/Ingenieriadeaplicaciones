<div class="bar">
	<a id="nuevoExpositor" class="button" href="javascript:void(0);">Crear nuevo expositor</a>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Dni</th>
				<th>Institucion</th>
				<th>Cargo</th>
				<th>Biografia</th>
				<th>Editar</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($view->expositores as $expositor):  // uso la otra sintaxis de php para templates ?>
				<tr>
					<td><?php echo $expositor['dni'];?></td>
					<td><?php echo $expositor['institucion'];?></td>
					<td><?php echo $expositor['cargo'];?></td>
					<td><?php echo $expositor['biografia'];?></td>
					<td><a class="edit" href="javascript:void(0);" data-id="<?php echo $expositor['dni'];?>">Editar</a></td>
					<td><a class="delete" href="javascript:void(0);" data-id="<?php echo $expositor['dni'];?>">Borrar</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>