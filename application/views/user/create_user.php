<div class="container">
	<div class="row">
		<form action="#" method="post">
			<div class="row">
					<div class="col-md-3" id="loadImage">
                        <img src="" class="img-fluid mx-auto d-block rounded" width="200px" id="image">
                    </div>
				<div class="col-md-9" id="bloqueFormulario">
					<div class="row">
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
						<div class="col-md-12 py-3 alert alert-warning font-weight-bold" id="alert"></div>
						<div class="form-column col-md-6">
							<div class="form-group">
								<label for="">Usuario:</label>
								<input type="text" class="form-control" name="username" id="username">
							</div>
						</div>
						<div class="col-md-12 py-3 alert alert-warning font-weight-bold" id="alert2"></div>
						<div class="form-column col-md-6">
							<div class="form-group">
								<label for="">Contraseña:</label>
								<input type="password" class="form-control" name="password" id="password">
							</div>
						</div>
						<div class="col-md-12 py-3 alert alert-warning font-weight-bold" id="alert3"></div>
						<div class="form-column col-md-6">
							<div class="form-group">
								<label for="">Rol:</label>
								<select name="rol" id="rol" class="form-control">
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
								<input type="radio" class="form-check-input" name="genero" value="Masculino" id="masculino">
								<label for="masculino">Masculino</label>
							</div>
							<div class="form-check">
								<input type="radio" class="form-check-input" name="genero" value="Femenino" id="femenino">
								<label for="femenino">Femenino</label>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-column col-md-12">
							<label>Foto:</label>
							<div class="form-group">
								<div class="input-group">
									<label class="form-control" style="max-width:40px;" for="foto"><i class="fas fa-camera"></i></label>
									<input type="file" class="form-control" name="foto" id="foto">
								</div>
							</div>
						</div>		
					</div>
				</div>
				<div class="form-column col-md-12">
					<div class="form-group text-right">
						<button type="button" name="enviarData" id="enviarData" class="btn btn-primary btn-lg">Agregar</button>
						<button type="button" onclick="limpiarForm();" class="btn btn-secondary btn-lg">Limpiar</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
