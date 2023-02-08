<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/
include(APPPATH . "controllers/AccessConfig.php");
class User extends AccessConfig
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("User_model");
	}

	public function index()
	{
		$data["usuarios"] = $this->User_model->getRoles();
		$data["title"] = "Gestion de usuarios";
		$data["fileJs"] = "frmUsuario.js";
		$this->load->view("layout/startTemplate.php", $data);
		$this->load->view("layout/sidebar.php");
		$this->load->view("layout/navbar.php");
		$this->load->view("user/index_user.php", $data);
		$this->load->view("layout/footer.php");
		$this->load->view("layout/endTemplate.php");
	}


	public function llenarTabla()
	{
		//array que se ira agregando por push
		$array_datos = array();
		//array guardado
		$array_datos_g = array();
		$res = $this->User_model->getAllUsers();
		foreach ($res as $r) {
			$botones = "<div class='btn-group'>
                            <button class='btn btn-success btnEditar' id='" . $r->idUser . "'><i class='fas fa-edit'></i></button>
                            <button class='btn btn-danger btnEliminar' id='" . $r->idUser . "'><i class='fas fa-trash-alt'></i></button>
                            <button class='btn btn-info btnInfo' id='" . $r->idUser . "'><i class='fas fa-eye'></i></button>
                        </div>";
			if ($r->image != "") {
				$fotoUsuario = "<img class='img-fluid mx-auto rounded' width='200px' height='200px' src='" . base_url("resources/multimedia/imgUsers/$r->image") . "'>";
			} else {
				if ($r->genero == "Masculino") {
					$fotoUsuario = "<img class='img-fluid mx-auto rounded' width='200px' height='200px' src='" . base_url("resources/multimedia/recursos/noPhotoMan.jpg") . "'>";
				} else if ($r->genero == "Femenino") {
					$fotoUsuario = "<img class='img-fluid mx-auto rounded' width='200px' height='200px' src='" . base_url("resources/multimedia/recursos/noPhotoGirl.png") . "'>";
				}
			}
			$array_datos = array(
				$r->nombres . " " . $r->apellidos,
				$r->username,
				$fotoUsuario, $r->nombreRol,
				$this->formato_fecha_hora($r->f_insert),
				$this->formato_fecha_hora($r->f_update),
				$r->updater_name, $botones
			);
			array_push($array_datos_g, $array_datos);
		}
		echo json_encode(array('data' => $array_datos_g));
	}

	public function llenarTablaDel()
	{
		//array que se ira agregando por push
		$array_datos = array();
		//array guardado
		$array_datos_g = array();
		$res = $this->User_model->getAllUsersDeleted();
		foreach ($res as $r) {
			$botones = "<div class='btn-group'>
                            <button class='btn btn-primary btnHabilitar' id='" . $r->idUser . "'><i class='fas fa-user-check'></i></button>
                        </div>";
			if ($r->image != "") {
				$fotoUsuario = "<img class='img-fluid mx-auto rounded' width='200px' height='200px' src='" . base_url("resources/multimedia/imgUsers/$r->image") . "'>";
			} else {
				if ($r->genero == "Masculino") {
					$fotoUsuario = "<img class='img-fluid mx-auto rounded' width='200px' height='200px' src='" . base_url("resources/multimedia/recursos/noPhotoMan.jpg") . "'>";
				} else if ($r->genero == "Femenino") {
					$fotoUsuario = "<img class='img-fluid mx-auto rounded' width='200px' height='200px' src='" . base_url("resources/multimedia/recursos/noPhotoGirl.png") . "'>";
				}
			}
			$array_datos = array(
				$r->nombres . " " . $r->apellidos,
				$r->username,
				$fotoUsuario, $r->nombreRol,
				$this->formato_fecha_hora($r->f_update),
				$r->updater_name, 
				$botones
			);
			array_push($array_datos_g, $array_datos);
		}
		echo json_encode(array('data' => $array_datos_g));
	}

	public function usuarioExistente()
	{
		$res = $this->User_model->getExistUser($_POST['user']);
		echo json_encode(array("datos" => $res));
	}


	public function insertar()
	{
		$info = json_decode($_POST["info"]);

		//guardar fichero
		$foto = "";
		if (!empty($_FILES["foto"]) && isset($_FILES["foto"])) {
			$ruta = "./resources/multimedia/imgUsers/";
			$foto = $_FILES["foto"];
			$fotoName = $foto['name'];
			$typeFile = pathinfo($fotoName, PATHINFO_EXTENSION);
			$nombreArchivo = $info[3]->value . "_foto." . $typeFile;
			if (move_uploaded_file($foto["tmp_name"], $ruta . $nombreArchivo)) {
			}
		}

		//nombre de la imagen a guardar
		if (!empty($foto)) {
			$fotoName = $foto['name'];
			$typeFile = pathinfo($fotoName, PATHINFO_EXTENSION);
			$nombreArchivo = $info[3]->value . "_foto." . $typeFile;
		} else {
			$nombreArchivo = "";
		}

		$data = array(
			"idUser" => 0,
			"nombres" => $info[0]->value,
			"apellidos" => $info[1]->value,
			"email" => $info[2]->value,
			"username" => $info[3]->value,
			"password" => sha1($info[4]->value),
			"idRol" => $info[5]->value,
			"genero" => $info[6]->value,
			"image" => $nombreArchivo,
			"status" => 1,
			"f_insert" => date("Y-m-d H:i:s")
		);
		$retorno = $this->User_model->addUser($data);
		$this->Auditoria_model->setHistorial('Agregó un nuevo usuario llamado ' . $info[0]->value . " " . $info[1]->value);
		echo json_encode(array("datos" => $retorno, "mensaje" => "Datos insertados correctamente"));
	}


	public function obtener()
	{
		$id = $this->input->post("id");
		$result = $this->User_model->getUser($id);
		$data['idUser'] = $result[0]["idUser"];
		$data['nombre'] = $result[0]["nombres"];
		$data['apellido'] = $result[0]["apellidos"];
		$data['email'] = $result[0]["email"];
		$data['username'] = $result[0]["username"];
		$data['password'] = $result[0]["password"];
		$data['rol'] = $result[0]["idRol"];
		$data['rolNombre'] = $result[0]["nombreRol"];

		if ($result[0]["image"] != "") {
			$data['image'] = "../resources/multimedia/imgUsers/" . $result[0]["image"];
		} else {
			$data['image'] = false;
		}
		$data['genero'] = $result[0]["genero"];

		echo json_encode(array("datos" => $data));
	}


	public function modificar()
	{
		$info = json_decode($_POST["info"]);

		//guardar fichero
		$foto = "";
		if (!empty($_FILES["foto"]) && isset($_FILES["foto"])) {
			$ruta = "./resources/multimedia/imgUsers/";
			$foto = $_FILES["foto"];
			$fotoName = $foto['name'];
			$typeFile = pathinfo($fotoName, PATHINFO_EXTENSION);
			$nombreArchivo = $info[4]->value . "_foto." . $typeFile;
			if (move_uploaded_file($foto["tmp_name"], $ruta . $nombreArchivo)) {
			}
		}

		//nombre de la imagen a guardar
		if (!empty($foto)) {
			$fotoName = $foto['name'];
			$typeFile = pathinfo($fotoName, PATHINFO_EXTENSION);
			$nombreArchivo = $info[4]->value . "_foto." . $typeFile;
		} else {
			$nombreArchivo = "";
		}

		if ($nombreArchivo != "") {
			if ($info[5]->value != "") {
				$data = array(
					"nombres" => $info[1]->value,
					"apellidos" => $info[2]->value,
					"email" => $info[3]->value,
					"username" => $info[4]->value,
					"password" => sha1($info[5]->value),
					"idRol" => $info[6]->value,
					"genero" => $info[7]->value,
					"image" => $nombreArchivo,
					"f_update" => date("Y-m-d H:i:s"),
					"updater_name" => $this->session->userdata("nombres") . " " .
						$this->session->userdata("apellidos")
				);
			} else {
				$data = array(
					"nombres" => $info[1]->value,
					"apellidos" => $info[2]->value,
					"email" => $info[3]->value,
					"username" => $info[4]->value,
					"idRol" => $info[6]->value,
					"genero" => $info[7]->value,
					"image" => $nombreArchivo,
					"f_update" => date("Y-m-d H:i:s"),
					"updater_name" => $this->session->userdata("nombres") . " " .
						$this->session->userdata("apellidos")
				);
			}
		} else {
			if ($info[5]->value != "") {
				$data = array(
					"nombres" => $info[1]->value,
					"apellidos" => $info[2]->value,
					"email" => $info[3]->value,
					"username" => $info[4]->value,
					"password" => sha1($info[5]->value),
					"idRol" => $info[6]->value,
					"genero" => $info[7]->value,
					"f_update" => date("Y-m-d H:i:s"),
					"updater_name" => $this->session->userdata("nombres") . " " .
						$this->session->userdata("apellidos")
				);
			} else {
				$data = array(
					"nombres" => $info[1]->value,
					"apellidos" => $info[2]->value,
					"email" => $info[3]->value,
					"username" => $info[4]->value,
					"idRol" => $info[6]->value,
					"genero" => $info[7]->value,
					"f_update" => date("Y-m-d H:i:s"),
					"updater_name" => $this->session->userdata("nombres") . " " .
						$this->session->userdata("apellidos")
				);
			}
		}
		$this->Auditoria_model->setHistorial('Modificó datos del usuario con id ' . $info[0]->value);
		$retorno = $this->User_model->updateUser(array("idUser" => $info[0]->value), $data);
		echo json_encode(array("datos" => $retorno, "mensaje" => "Datos modificados correctamente"));
	}

	public function eliminar()
	{
		$id = $this->input->post("id");
		$data = array(
			"status" => 0,
			"f_update" => date("Y-m-d H:i:s"),
			"updater_name" => $this->session->userdata("nombres") . " " .
				$this->session->userdata("apellidos")
		);
		$result = $this->User_model->deleteUser(array("idUser" => $id), $data);
		$this->Auditoria_model->setHistorial('Eliminó al usuario con id ' . $id);
		echo json_encode(array("datos" => $result, "mensaje" => "Datos eliminados correctamente"));
	}

	public function habilitar()
	{
		$id = $this->input->post("id");
		$data = array(
			"status" => 1,
			"f_update" => date("Y-m-d H:i:s"),
			"updater_name" => $this->session->userdata("nombres") . " " .
				$this->session->userdata("apellidos")
		);
		$result = $this->User_model->deleteUser(array("idUser" => $id), $data);
		$this->Auditoria_model->setHistorial('Habilitó al usuario con id ' . $id);
		echo json_encode(array("datos" => $result, "mensaje" => "Usuario habilitado correctamente"));
	}
}
