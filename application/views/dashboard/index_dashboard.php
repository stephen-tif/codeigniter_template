<div class="container-fluid">
	<div class="row bg-light rounded sombra pt-4">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#v1">Empleados por area</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#v2">Grafica de proyectos</a>
				</li>
			</ul>
			<div class="tab-content py-4">
				<div class="tab-pane fade show active" id="v1">
					<?php $this->load->view("dashboard/vista1.php"); ?>
				</div>
				<div class="tab-pane fade" id="v2">
					<h1 class="display-1 text-muted">En desarrollo...</h1>
				</div>

			</div>
		</div>
		
	</div>
</div>
