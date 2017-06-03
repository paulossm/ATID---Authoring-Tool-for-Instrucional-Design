<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{

	function __construct() 
	{
		 parent::__construct();

        $this->load->helper("url");
        $this->load->model("usuario_model", "usuario");
        $this->load->model("Dashboard_model", "model");
    }	


	public function index()
	{	
		session_start();
		$qtd_redes = $this->model->qtd_redes($_SESSION['id_usuario']);
		$data['qtd'] = $qtd_redes->qtd;
		$data['list'] = $this->model->redes($_SESSION['id_usuario']);
		$this->load->view('dashboard_view', $data);
		
	}

	public function editar($id_rede='')
	{	
		session_start();
		$this->load->view('draw_view');
	}
	
	public function autoCompleteEmails()
	{
		session_start();
        $query = $this->model->emailCadastrados($_GET['txtEmail']);
        echo json_encode($query);    
	}
}
