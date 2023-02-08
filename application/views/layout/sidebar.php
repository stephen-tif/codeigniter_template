<?php
//CONSTANTES DE SESION A MOSTAR EN EL SIDEBAR
define('NOMBRES', $this->session->userdata("nombres"));
define('APELLIDOS', $this->session->userdata("apellidos"));
define('ROL', $this->session->userdata("nombreRol"));
define('FOTO', $this->session->userdata("image"));
define('GENERO', $this->session->userdata("genero"));

//VERIFICANDO FOTOGRAFIA A MOSTRAR SEGUN GENERO O PERSONALIZACIÓN
if (FOTO == "") {
	if (GENERO == "Masculino") {
		$image = "recursos/noPhotoMan.jpg";
	} else if (GENERO == "Femenino") {
		$image = "recursos/noPhotoGirl.png";
	}
} else {
	$image = "imgUsers/" . FOTO;
}
?>

<div class="page-wrapper chiller-theme toggled">
	<button id="show-sidebar" class="btn btn-lg btn-light fast-color">
		<i class="fas fa-align-right "></i>
	</button>
	<!--sidebar-->
	<nav id="sidebar" class="sidebar-wrapper">
		<div class="sidebar-content">
			<div class="sidebar-brand">
				<!--nombre de empresa-->
				<a class="logo fast-color">
					<img class='img-fluid' width="40px" src="<?= base_url("resources/multimedia/wallpapers/fast-icon.jpeg");?>">
					Fast Developer
				</a>
				<!--toggle sidebar-->
				<div id="close-sidebar">
					<i class="fas fa-align-left"></i>
				</div>
			</div>
			<div class="sidebar-header">
				<div class="user-pic">
					<img class='img-responsive img-rounded' src="<?php echo base_url("resources/multimedia/$image"); ?>">
				</div>
				<div class="user-info">
					<strong class="user-name">
						<?php echo NOMBRES ?>
						<br>
						<?php echo APELLIDOS ?>
					</strong>
					<span class="user-role">
						<?php echo ROL; ?>
					</span>
					<!--span class="user-status">
						<i class="fa fa-circle"></i>
						<span>En linea</span>
					</span-->
				</div>
			</div>
			<!-- sidebar-menu  -->
			<div class="sidebar-menu my-4">
				<ul>
					<!--li class="header-menu">
						<span>Inicio</span>
					</li-->
					<li>
						<a href="<?php echo base_url("index.php/Dashboard"); ?>">
							<i class="fa fa-tachometer-alt"></i>
							<span>Dashboard</span>
						</a>
					</li>

					<?php if (ROL == "Administrador") : ?>
						<li class="sidebar-dropdown">
							<a>
								<i class="fas fa-users"></i>
								<span>Gestion usuarios</span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li>
										<a href="<?php echo base_url("index.php/User"); ?>">
											Usuarios
										</a>
									</li>
									<li>
										<a href="<?php echo base_url("index.php/Rol"); ?>">
											Roles
										</a>
									</li>
									<li>
										<a href="<?php echo base_url("index.php/Auditoria"); ?>">
											Registro de actividades
										</a>
									</li>
								</ul>
							</div>
						</li>
					<?php endif; ?>

				</ul>
			</div>
			<!-- sidebar-menu  -->
		</div>
		<div class="sidebar-footer ">
			<div class="btn-group dropup mx-auto">
				<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-clock"></i>
				</button>
				<div class="dropdown-menu">
					<div class="date-card dropdown-item"></div>
				</div>
			</div>
			
			<div class="btn-group mx-auto">
				<a href="<?php echo base_url("index.php/Profile"); ?>" id="config" class="btn">
					<i class="fas fa-user-cog"></i>
				</a>
			</div>
			<div class="btn-group mx-auto">
				<a href="#" class="btn">
					<i class="fa fa-cog"></i>
				</a>
			</div>
			<div class="btn-group mx-auto">
				<a href="#" id="logout" class="btn text-danger">
					<i class="fa fa-power-off"></i>
				</a>
			</div>
		</div>
	</nav>
	<!-- sidebar-wrapper  -->
	<main class="page-content" style="min-height: 100vh">
