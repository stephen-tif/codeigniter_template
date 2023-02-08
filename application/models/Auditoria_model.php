<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: FAST WEB
*/
class Auditoria_model extends CI_Model
{
    private $table = "historial";
    private $user = "user";

    public function __construct()
    {
        parent::__construct();
    }

    public function setHistorial($descrip)
	{
		$user = $this->session->userdata("idUser");
		$query = "CALL sp_guardarHistorial(?,?)";
        return $this->db->query($query, array($descrip,$user));
	}

	public function getAll($fechainicio,$fechafin,$users)
    {
		if(!empty($fechafin) && !empty($fechainicio))
		{
			$this->db->select("h.*, CONCAT(u.nombres,' ',u.apellidos) as usuario");
			$this->db->from($this->table.' h');
			$this->db->join($this->user.' u','h.idUser = u.idUser');
			$this->db->where("date(fecha) >=",$fechainicio);
			$this->db->where("date(fecha) <=",$fechafin);
			$this->db->order_by("h.idHistorial","desc");
			if (!empty($users)) {
				$this->db->where_in("h.idUser",$users);
			}
			$this->db->limit(1000);
			$data = $this->db->get();
			return $data->result();
		}
		else{
			$this->db->select("h.*, CONCAT(u.nombres,' ',u.apellidos) as usuario");
			$this->db->from($this->table.' h');
			$this->db->join($this->user.' u','h.idUser = u.idUser');
			$this->db->order_by("h.idHistorial","desc");
			$this->db->limit(1000);
			$data = $this->db->get();
			return $data->result();
		}
    }

	public function getAllUsers()
    {
        $this->db->select("*");
        $this->db->from($this->user);
        $this->db->join('rol' , 'rol.idRol = user.idRol');
        $this->db->where('user.status','1');
        $this->db->where('rol.status','1');
		$this->db->limit(10000);
        $data = $this->db->get();
        return $data->result();
    }
    
}
