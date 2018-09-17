<div class="bar">
	<a id="nuevoForo" class="button" href="javascript:void(0);">Crear nuevo foro</a>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Detalle</th>
				<th>Codigo postal</th>
				<th>Editar</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($view->foros as $foro):  // uso la otra sintaxis de php para templates ?>
				<tr>
					<td><?php echo $foro['codigo'];?></td>
					<td><?php echo $foro['nombre'];?></td>
					<td><?php echo $foro['detalle'];?></td>
					<td><?php echo $foro['cod_postal'];?></td>
					<td><a class="edit" href="javascript:void(0);" data-id="<?php echo $foro['codigo'];?>">Editar</a></td>
					<td><a class="delete" href="javascript:void(0);" data-id="<?php echo $foro['codigo'];?>">Borrar</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>