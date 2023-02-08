<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/
include (APPPATH."controllers/AccessConfig.php");

class Rol extends AccessConfig
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Rol_model");
    }

    public function index()
    {
        $data["title"]="Gestion de roles";
        $data["fileJs"]="frmRol.js";
        $this->load->view("layout/startTemplate.php",$data);
        $this->load->view("layout/sidebar.php");
        $this->load->view("layout/navbar.php");
        $this->load->view("rol/index_rol.php");
        $this->load->view("layout/footer.php");
        $this->load->view("layout/endTemplate.php");
    }

    public function llenarTabla()
    {
        $array_datos = array();
        $array_datos_g = array();
        $res = $this->Rol_model->getAllRoles();
        foreach($res as $r)
        {
            $botones = "<div class='btn-group'>
                            <button class='btn btn-success btnEditar' id='".$r->idRol."'><i class='fas fa-edit'></i></button>
                            <button class='btn btn-danger btnEliminar' id='".$r->idRol."'><i class='fas fa-trash-alt'></i></button>
                        </div>";
            $array_datos=array( $r->idRol,
                                $r->nombreRol,
                                $botones);
            array_push($array_datos_g,$array_datos);
        }
        echo json_encode(array('data'=>$array_datos_g));
    }

    public function insertar()
    {
        $info = json_decode($_POST["info"]);
        
        $data=array("idRol"=>0,
                    "nombreRol"=>$info[0]->value,
                    "status"=>1
                );
		$retorno = $this->Rol_model->addRol($data);
		$this->Historial_model->setHistorial('Ingresó un nuevo rol');
        echo json_encode(array("datos"=>$retorno, "mensaje"=>"Datos insertados correctamente"));
    }

    public function obtener()
    {
        $id = $this->input->post("id");
        $result = $this->Rol_model->getRol($id);
        $data['idRol']=$result[0]["idRol"];
        $data['nombreRol']=$result[0]["nombreRol"];
        echo json_encode(array("datos"=>$data));
    }

    public function modificar()
    {
        $info = json_decode($_POST["info"]);
        $data=array("nombreRol"=>$info[1]->value);
		$retorno = $this->Rol_model->updateRol(array("idRol"=>$info[0]->value),$data);
		$this->Historial_model->setHistorial('Modificó el rol con id '.$info[0]->value);
        echo json_encode(array("datos"=>$retorno, "mensaje"=>"Datos modificados correctamente"));
    }

    public function eliminar()
    {
        $id = $this->input->post("id");
        $data=array("status"=>0);
        $result = $this->Rol_model->deleteRol(array("idRol"=>$id),$data);
		$this->Historial_model->setHistorial('Eliminó el rol con id '.$id);
        echo json_encode(array("datos"=>$result, "mensaje"=>"Datos eliminados correctamente"));
    }

}
