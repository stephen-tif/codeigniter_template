<?php
/* 
    @Author: Stephen Meléndez
    @Version: 1.0
    @CopyRight: Intech
*/


date_default_timezone_set('America/El_Salvador');
setlocale(LC_MONETARY, 'en_US.UTF-8');

class AccessConfig extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		
		$this->load->model("Auditoria_model");
        $this->load->helper("url");
		$this->load->driver("cache", array("adapter"=>"apc","backup"=>"file"));
		
        if($this->session)
        {
            $logged = $this->session->has_userdata("logged_in");
            if($logged==false)
            {
				header("Location: ".site_url("login"));
			}
        }else{
            header("Location: ".site_url("login"));
        }
    }

    public function formato_fecha_hora($fecha)
    {
        if($fecha!="")
        {
            $newdate = date('d/m/Y h:i.sa',strtotime($fecha));
        }
        else{
            $newdate = "";
        }
        return $newdate;
    }

    public function formato_fecha($fecha)
    {
        if($fecha!="")
        {
            $newdate = date('d/m/Y',strtotime($fecha));
        }
        else{
            $newdate = "";
        }
        return $newdate;
    }

    public function formato_dinero($dinero)
    {
        if($dinero!="")
        {
            $newdinero = money_format('%.2n', $dinero);
        }
        else{
            $newdinero = "";
        }
        return $newdinero;
    }

    public function formato_rango($inicio,$fin)
    {
        if($inicio!="" && $fin!="")
        {
            $newrango = date('d/m/Y',strtotime($inicio))."-".date('d/m/Y',strtotime($fin));
        }
        else{
            $newrango = "";
        }
        return $newrango;
    }
}
