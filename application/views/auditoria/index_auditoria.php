<div class="container-fluid">
	<div class="row bg-light rounded sombra pt-4">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#list">Listado de usuarios</a>
				</li>
			</ul>
			<div class="tab-content py-4">
				<div class="tab-pane fade show active" id="list">
					<?php $this->load->view("auditoria/list_auditoria.php"); ?>
				</div>

			</div>
		</div>
		
	</div>
</div>
