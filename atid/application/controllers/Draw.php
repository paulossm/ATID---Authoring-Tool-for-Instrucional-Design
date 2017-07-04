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

	public function salvarRede()
	{
		session_start();// precisa disso em toda action?
		$rede = $_POST['rede'];
		/* 
			metodo_para_salvar_rede($rede);
			return true;
		*/
		echo ($rede);
	}
}