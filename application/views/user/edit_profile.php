<div class="container-fluid">
	<div class="row bg-light rounded sombra pt-4">
		<div class="col-md-3" id="load">
			<img src="" class="img-fluid mx-auto d-block rounded" width="200px" id="userImg">
		</div>
		<div class="row col-md-9" id="FormularioPerfil">

			<input type="text" class="form-control" name="id" id="id" hidden>
			<div class="form-column col-md-6">
				<div class="form-group">
					<label for="">Nombres</label>
					<input type="text" class="form-control" name="nombres" id="nombres">
				</div>
			</div>

			<div class="form-column col-md-6">
				<div class="form-group">
					<label for="">Apellidos</label>
					<input type="text" class="form-control" name="apellidos" id="apellidos">
				</div>
			</div>
			<div class="form-column col-md-12">
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" class="form-control" name="email" id="email">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-column col-md-6">
				<div class="form-group">
					<label for="">Usuario:</label>
					<input type="text" class="form-control" name="username" id="username">
				</div>
			</div>
			<div class="form-column col-md-6">
				<div class="form-group">
					<label for="">Contraseña:</label>
					<input type="password" class="form-control" name="password" id="password">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-column col-md-12">
				<div class="form-group">
					<label>Foto:</label>
					<input type="file" class="form-control" name="foto" id="fotos">
				</div>
			</div>
			<div class="form-column col-md-12">
				<div class="form-group">
					<label>Seleccione su genero:</label>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="genero" value="Masculino" id="Masculino">
						<label for="Masculino">Masculino</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="genero" value="Femenino" id="Femenino">
						<label for="Femenino">Femenino</label>
					</div>
				</div>
			</div>
			<div class="form-column col-md-12">
				<div class="form-group text-right">
					<button type="button" name="modificarPerfil" id="modificarPerfil" class="btn btn-dark btn-lg">Guardar</button>
					<button type="button" onclick="$('#FormularioModificar :input').val('').trigger('change');" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

</div>
