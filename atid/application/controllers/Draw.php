<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Draw extends CI_Controller {

	function __construct() {
		 parent::__construct();

        $this->load->helper("url");
        $this->load->model("usuario_model", "usuario");
        $this->load->model("Dashboard_model", "dashboard");
    }	


	public function index()
	{	
		session_start();
		$this->load->view('draw_view');
		
	}

	public function salvar()
	{	
		session_start();
		
	}
}