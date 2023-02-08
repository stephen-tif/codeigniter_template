<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/
class User_model extends CI_Model
{
    private $table = "user";
    private $tableSecondary = "rol";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('rol' , 'rol.idRol = user.idRol');
        $this->db->where('user.status','1');
        $this->db->where('rol.status','1');
		$this->db->limit(10000);
        $data = $this->db->get();
        return $data->result();
    }

    public function getAllUsersDeleted()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('rol' , 'rol.idRol = user.idRol');
        $this->db->where('user.status','0');
        $this->db->where('rol.status','1');
        $this->db->limit(10000);
        $data = $this->db->get();
        return $data->result();
    }

    public function getRoles()
    {
        $this->db->select("*");
        $this->db->from($this->tableSecondary);
        $this->db->where("status",1);
        $data = $this->db->get();
        return $data->result();
    }

    public function getExistUser($user)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("username=",$user);
        $this->db->where("status=",1);
        $data = $this->db->get();

        $count = $data->num_rows();
        if($count>0)
        {
            $retorno=true;   
        }
        else{
            $retorno=false;
        }

        return $retorno;
    }

    public function addUser($data)
    {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }

    public function getUser($id)
    {
        $this->db->select("user.*, rol.*");
        $this->db->from($this->table);
        $this->db->join("rol","user.idRol=rol.idRol");
        $this->db->where("idUser",$id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function updateUser($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }

    public function deleteUser($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
	}

	

}
