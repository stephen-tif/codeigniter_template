<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/
class Login_model extends CI_Model
{
    private $table = "user";

    public function __construct()
    {
        parent::__construct();
    }

    public function getLogin($user, $pass)
    {
        $this->db->select("COUNT(idUser) as login,user.*,rol.*");
        $this->db->from($this->table);
        $this->db->join("rol","user.idRol=rol.idRol");
        $this->db->where("username",$user);
        $this->db->where("password",$pass);
        $this->db->where('user.status','1');
        $this->db->where('rol.status','1');
        $data = $this->db->get();
        return $data->row();
    }

    public function array_session($objquery)
    {
        $dataSession = array(
            "idUser"=>$objquery->idUser,
            "nombres"=>$objquery->nombres,
            "apellidos"=>$objquery->apellidos,
            "genero"=>$objquery->genero,
            "image"=>$objquery->image,
            "nombreRol"=>$objquery->nombreRol,
            "logged_in"=>TRUE
        );
        return $dataSession;
    }

    public function login($user, $pass)
    {
        $datos = new stdClass();
        $datos->estado = false;
        $objquery = $this->getLogin($user, $pass);
        if($objquery!=null)
        {
            if($objquery->login==1)
            {
                $datos->estado=true;
                $datos->mensaje="todo blue";
            }
        }else{
            $datos->estado=false;
            $datos->mensaje="neles pasteles";
        }

        if($datos->estado==true)
        {
            $arraysession = $this->array_session($objquery);
            $this->session->set_userdata($arraysession);
        }
        return $datos;

    }

    
}
