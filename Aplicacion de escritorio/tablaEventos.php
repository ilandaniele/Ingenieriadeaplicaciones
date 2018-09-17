<div class="bar">
	<a id="nuevoEvento" class="button" href="javascript:void(0);">Crear nuevo evento</a>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Lugar</th>
				<th>Fecha</th>
				<th>Comienzo</th>
				<th>Finalización</th>
				<th>Detalle</th>
				<th>Foro</th>
				<th>Editar</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($view->eventos as $evento):  // uso la otra sintaxis de php para templates ?>
				<tr>
					<td><?php echo $evento['id'];?></td>
					<td><?php echo $evento['nombre'];?></td>
					<td><?php echo $evento['lugar'];?></td>
					<td><?php echo $evento['fecha'];?></td>
					<td><?php echo $evento['horainicio'];?></td>
					<td><?php echo $evento['horafin'];?></td>
					<td><?php echo $evento['detalle'];?></td>
					<td><?php echo $evento['nombre_foro'];?></td>
					<td><a class="edit" href="javascript:void(0);" data-id="<?php echo $evento['id'];?>">Editar</a></td>
					<td><a class="delete" href="javascript:void(0);" data-id="<?php echo $evento['id'];?>">Borrar</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>