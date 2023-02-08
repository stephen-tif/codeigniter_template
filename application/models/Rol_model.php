<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/
class Rol_model extends CI_Model
{
    private $table = "rol";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllRoles()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('status','1');
        $data = $this->db->get();
        return $data->result();
    }   

    public function addRol($data)
    {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }

    public function getRol($id)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("idRol",$id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function updateRol($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }

    public function deleteRol($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }
}