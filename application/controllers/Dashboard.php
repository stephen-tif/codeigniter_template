<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/
include (APPPATH."controllers/AccessConfig.php");

class Dashboard extends AccessConfig
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Dashboard_model");
    }

    public function index()
    {
            $data["title"]="Dashboard";
            $data["fileJs"]="dashboardData.js";
            $this->load->view("layout/startTemplate.php",$data);
            $this->load->view("layout/sidebar.php");
            $this->load->view("layout/navbar.php");
            $this->load->view("dashboard/index_dashboard.php");
            $this->load->view("layout/footer.php");
            $this->load->view("layout/endTemplate.php");
    }


}
