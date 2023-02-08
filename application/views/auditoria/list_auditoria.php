<div class="row">
            	<div class="form-column col-md-4">
            		<div class="form-group">
            			<div class="input-group">
            				<input type="text" value="Desde:" class="form-control" readonly style="max-width:90px;">
            				<input type="date" class="form-control" id="f_inicio">
            			</div>
            		</div>
            	</div>
            	<div class="form-column col-md-4">
            		<div class="form-group">
            			<div class="input-group">
            				<input type="text" value="Hasta:" class="form-control" readonly style="max-width:90px;">
            				<input type="date" class="form-control" id="f_fin">
            			</div>
            		</div>
            	</div>
            	<div class="form-column col-md-4">
            		<div class="form-group">
            			<div class="input-group">
            				<input type="text" value="Usuario:" class="form-control" readonly style="max-width:90px;">
            				<select id="cmbUsers" class="form-control" name="usuarios[]" multiple="multiple">
            					<option value=""></option>
            					<?php
								foreach ($usuarios as $user) {
									echo "<option value=" . $user->idUser . ">" . $user->nombres . " " . $user->apellidos . "</option>";
								}
								?>
            				</select>
            			</div>
            		</div>
            	</div>
            	<div class="form-column col-md-4">
            		<div class="form-group">
            			<button class="btn btn-secondary border" id="search">
            				<i class="fas fa-search"></i> Buscar
            			</button>
            			<button class="btn btn-secondary border" id="reset">
            				<i class="fas fa-redo-alt"></i> Restablecer
            			</button>
            		</div>
            	</div>
            	<div class="table-responsive col-md-12 mx-auto" id="tabla">
            		<table id="tablaHistorial" class="table table-bordered mx-auto" width="100%">
            			<thead>
            				<tr>
            					<th>#</th>
            					<th>FECHA</th>
            					<th>DETALLE DE ACTIVIDAD</th>
            					<th>AUTOR</th>
            				</tr>
            			</thead>
            			<tbody>
            			</tbody>
            			<tfoot>
            				<tr>
            					<th>#</th>
            					<th>FECHA</th>
            					<th>DETALLE DE ACTIVIDAD</th>
            					<th>AUTOR</th>
            				</tr>
            			</tfoot>
            		</table>
            	</div>
            </div>
