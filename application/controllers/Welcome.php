<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH."controllers/AccessConfig.php");
class Welcome extends AccessConfig {

	public function __construct()
    {
        parent::__construct();
	}
	
	public function index()
	{
		header("Location: ".site_url("login"));
	}
}
