<div class="bar">
	<a id="nuevoPresenta" class="button" href="javascript:void(0);">Crear nueva presencia</a>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Dni del presentador</th>
				<th>Id del evento donde se presenta</th>
				<th>Editar</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($view->presentas as $presenta):  // uso la otra sintaxis de php para templates ?>
				<tr>
					<td><?php echo $presenta['dni'];?></td>
					<td><?php echo $presenta['id'];?></td>
					<td><a class="edit" href="javascript:void(0);" data-dni="<?php echo $presenta['dni'];?>" data-id="<?php echo $presenta['id'];?>">Editar</a></td>
					<td><a class="delete" href="javascript:void(0);" data-dni="<?php echo $presenta['dni'];?>" data-id="<?php echo $presenta['id'];?>">Borrar</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>