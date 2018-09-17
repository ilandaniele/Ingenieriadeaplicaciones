<div class="bar">
	<a id="nuevoUsuario" class="button" href="javascript:void(0);">Crear nuevo usuario</a>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Dni</th>
				<th>Username</th>
				<th>Password</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Es admin</th>
				<th>Editar</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($view->usuarios as $usuario):  // uso la otra sintaxis de php para templates ?>
				<tr>
					<td><?php echo $usuario['dni'];?></td>
					<td><?php echo $usuario['username'];?></td>
					<td><?php echo $usuario['password'];?></td>
					<td><?php echo $usuario['nombre_usuario'];?></td>
					<td><?php echo $usuario['apellido'];?></td>
					<td><?php echo $usuario['es_admin'];?></td>
					<td><a class="edit" href="javascript:void(0);" data-id="<?php echo $usuario['dni'];?>">Editar</a></td>
					<td><a class="delete" href="javascript:void(0);" data-id="<?php echo $usuario['dni'];?>">Borrar</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>