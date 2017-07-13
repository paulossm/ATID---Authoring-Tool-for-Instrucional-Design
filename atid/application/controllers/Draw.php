<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Draw extends CI_Controller {

	function __construct() {
		 parent::__construct();

        $this->load->helper("url");
        $this->load->model("Draw_model", "model");
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
		
		session_start();
		$data = array(
			"data_criacao" => date("Y-m-d H:i:s"),
			"data_modificacao" => date("Y-m-d H:i:s"),
			"id_criador" =>  $_SESSION['id_usuario'],
			"id_modificador" =>  $_SESSION['id_usuario'],
			"nome" =>"sem nome"
		);
		$id_rede = $this->model->insert_rede($data);		
		$jsonObj = json_decode($_POST['rede']);
		$rede = $jsonObj->node;
		foreach ( $rede as $no )
	    {
	    	
	    	if($no->type == 'activity'){
		    	$teste = array(
					"nome"		=> $no->name,
					"posicao_x" => $no->x,
					"posicao_y"	=> $no->y,
					"id_rede"	=> $id_rede 
				);
				$this->model->insert_atividade($teste);
			}
			elseif($no->type != 'arc'){
				$teste = array(
					"posicao_x" => $no->x,
					"posicao_y"	=> $no->y,
					"id_rede"	=> $id_rede 
				);
				if($no->type == 'event')
					$this->model->insert_evento($teste);
				if($no->type == 'repository')
					$this->model->insert_repositorio($teste);
				if($no->type == 'composition')
					$this->model->insert_subrede($teste);
				if($no->type == 'transition')
					$this->model->insert_transicao($teste);
			}
		}
	}
}