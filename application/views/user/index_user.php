<div class="container-fluid">
	<div class="row bg-light rounded sombra pt-4">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#new">Nuevo usuario</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#list">Listado de usuarios</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#list_del">Listado de usuarios eliminados</a>
				</li>
			</ul>
			<div class="tab-content py-4">
				<div class="tab-pane fade" id="new">
					<?php $this->load->view("user/create_user.php"); ?>
				</div>
				<div class="tab-pane fade show active" id="list">
					<?php $this->load->view("user/list_user.php"); ?>
				</div>
				<div class="tab-pane fade" id="list_del">
					<?php $this->load->view("user/list_user_deleted.php"); ?>
				</div>

			</div>
		</div>
		
	</div>
</div>
