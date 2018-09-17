<div class="bar">
	<a id="nuevoCiudad" class="button" href="javascript:void(0);">Crear nueva ciudad</a>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>cod_postal</th>
				<th>Nombre</th>
				<th>InformacionTuristica</th>
				<th>Editar</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($view->ciudad as $ciudad):  // uso la otra sintaxis de php para templates ?>
				<tr>
					<td><?php echo $ciudad['cod_postal'];?></td>
					<td><?php echo $ciudad['nombre'];?></td>
					<td><?php echo $ciudad['inf_turistica'];?></td>
					<td><a class="edit" href="javascript:void(0);" data-id="<?php echo $ciudad['cod_postal'];?>">Editar</a></td>
					<td><a class="delete" href="javascript:void(0);" data-id="<?php echo $ciudad['cod_postal'];?>">Borrar</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>