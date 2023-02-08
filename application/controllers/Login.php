<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper("url");
		$this->load->model("Auditoria_model");
        $this->load->model("Login_model");
    }

    public function index()
    {
        $logged = $this->session->has_userdata("logged_in");
        if($logged)
        {
            header("Location: ".site_url("dashboard"));
        }
        $data["title"]="Inicio de sesion";
        $this->load->view("login/index_login",$data);
    }

    public function iniciarSesion()
    {
        $info = json_decode($this->input->post("info"));
        $user = $info[0]->value;
        $pass = sha1($info[1]->value);
		$res = $this->Login_model->login($user,$pass);
		if($res->estado==true){
			$this->Auditoria_model->setHistorial('Inicio de sesión');
		}
        echo json_encode(array("datos"=>$res->estado));
    }

    public function logout()
    {
		$this->Auditoria_model->setHistorial('Cerro sesión');
        $this->session->sess_destroy();
        session_write_close();
        echo true;
    }



}
