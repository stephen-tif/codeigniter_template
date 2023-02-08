<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/
include(APPPATH . "controllers/AccessConfig.php");
class Auditoria extends AccessConfig
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Auditoria_model");
	}

	public function index()
	{
		$data["title"] = "Registro de actividades";
		$data["fileJs"] = "frmAuditoria.js";
		$data["usuarios"] = $this->Auditoria_model->getAllUsers();
		$this->load->view("layout/startTemplate.php", $data);
		$this->load->view("layout/sidebar.php");
		$this->load->view("layout/navbar.php");
		$this->load->view("auditoria/index_auditoria.php", $data);
		$this->load->view("layout/footer.php");
		$this->load->view("layout/endTemplate.php");
	}

	public function llenarTabla()
	{
		$inicio = $this->input->post("inicio");
		$fin = $this->input->post("fin");
		$usuarios = $this->input->post("users");

		$array_datos = array();
		$array_datos_g = array();
		$res = $this->Auditoria_model->getAll($inicio, $fin, $usuarios);
		foreach ($res as $r) {
			$array_datos = array(
				$r->idHistorial,
				$this->formato_fecha_hora($r->fecha),
				$r->descripcion,
				$r->usuario,
			);
			array_push($array_datos_g, $array_datos);
		}
		echo json_encode(array('data' => $array_datos_g));
	}
}
