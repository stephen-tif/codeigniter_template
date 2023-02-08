<div class="table-responsive col-md-12 mx-auto">
	<table id="tablaUsuarios" class="table table-bordered mx-auto" width="100%">
		<thead>
			<tr>
				<th>NOMBRE&nbsp;COMPLETO</th>
				<th>USUARIO</th>
				<th>IMAGEN</th>
				<th>ROL</th>
				<th>AGREGADO</th>
				<th>MODIFICADO</th>
				<th>MODIFICADO&nbsp;POR</th>
				<th>OPCIONES</th>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot>
			<tr>
				<th>NOMBRE&nbsp;COMPLETO</th>
				<th>USUARIO</th>
				<th>IMAGEN</th>
				<th>ROL</th>
				<th>AGREGADO</th>
				<th>MODIFICADO</th>
				<th>MODIFICADO&nbsp;POR</th>
				<th>OPCIONES</th>
			</tr>
		</tfoot>
	</table>

	<!--MODAL MODIFICAR-->
	<div class="modal fade" id="frmModificar" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header text-success">
					<h4 class="modal-title">Modificar usuario</h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body row">
					<div class="col-md-3" id="loadImage2">
						<img src="" class="img-fluid mx-auto d-block rounded" width="200px" id="image2">
					</div>
					<div class="row col-md-9" id="FormularioModificar">

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
						<div class="form-column col-md-6">
							<div class="form-group">
								<label for="">Rol:</label>
								<select name="rol" id="roles" class="form-control">
									<option value=""></option>
									<?php
									foreach ($usuarios as $r) {
										echo "<option value='" . $r->idRol . "'>" . $r->nombreRol . "</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-column col-md-6">
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
						<div class="clearfix"></div>
						<div class="form-column col-md-12">
							<label>Foto:</label>
							<div class="form-group">
								<div class="input-group">
									<label class="form-control" style="max-width:40px;" for="fotos"><i class="fas fa-camera"></i></label>
									<input type="file" class="form-control" name="foto" id="fotos">
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" name="modificarData" id="modificarData" class="btn btn-success btn-lg">Modificar</button>
					<button type="button" onclick="$('#FormularioModificar :input').val('').trigger('change');" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancelar
					</button>
				</div>
			</div>
		</div>
	</div>

	<!--MODAL INFORMACION-->
	<div class="modal fade" id="frmInfo" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header text-info">
					<h4 class="modal-title">Informacion de usuario</h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row" id="informacion">
						<div class="col-md-4" id="loadImage">
							<img src="" class="img-fluid" id="foto">
						</div>
						<div class="col-md-8">
							<h1 class="text-center">
								<div id="nombres"></div>
								<div id="apellidos"></div>
							</h1>
							<label class="text-info mt-4">CARGO: </label>
							<span id="cargo"></span>
							<br>
							<label class="text-info">E-MAIL: </label>
							<span id="email"></span>
							<br>
							<label class="text-info">GENERO: </label>
							<span id="genero"></span>
							<br>
							<label class="text-info">USUARIO: </label>
							<span id="username"></span>
							<br>
							<label class="text-info">CONTRASEÑA: </label>
							<span class="text-danger">No permitido</span>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>
