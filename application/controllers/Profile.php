<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/
include (APPPATH."controllers/AccessConfig.php");

class Profile extends AccessConfig
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data["title"]="Configuración de perfil";
        $data["fileJs"]="frmProfile.js";
        $this->load->view("layout/startTemplate.php",$data);
        $this->load->view("layout/sidebar.php");
        $this->load->view("layout/navbar.php");
        $this->load->view("user/edit_profile.php");
        $this->load->view("layout/footer.php");
        $this->load->view("layout/endTemplate.php");
    }

}
