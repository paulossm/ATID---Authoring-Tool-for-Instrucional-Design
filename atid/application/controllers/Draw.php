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
			"nome" =>"sem nome1"
		);
		$id_rede = $this->model->insert_rede($data);		
		$jsonObj = json_decode($_POST['rede']);
		$rede = $jsonObj->network;
		print_r($rede);
		foreach ( $rede as $no )
	    {

	    	if($no->type != 'arc'){
				$data = array(
					"nome"			=> $no->title,
					"posicao_x" 	=> $no->x,
					"posicao_y"		=> $no->y,
					"id_rede"		=> $id_rede,
					"identificador"	=> $no->id
				);
				if($no->type == 'event')
					$this->model->insert_evento($data);
				if($no->type == 'repository')
					$this->model->insert_repositorio($data);
				if($no->type == 'subnet')
					$this->model->insert_subrede($data);
				if($no->type == 'transition')
					$this->model->insert_transicao($data);
				if($no->type == 'activity')
					$this->model->insert_atividade($data);
			}else
			{
				if($no->origin->type == 'event'){
					$origem = $this->model->get_id_evento($no->origin->id, $id_rede);
					$id_origem = $origem->id_evento;
					$tipo_origem = 5;
				}
				if($no->origin->type == 'repository'){
					$origem = $this->model->get_id_repositorio($no->origin->id, $id_rede);
					$id_origem = $origem->id_repositorio;
					$tipo_origem = 4;
				}
				if($no->origin->type == 'composition'){
					$origem = $this->model->get_id_subrede($no->origin->id, $id_rede);
					$id_origem = $origem->id_subrede;
					$tipo_origem = 3;
				}
				if($no->origin->type == 'transition'){
					$origem = $this->model->get_id_transicao($no->origin->id, $id_rede);
					$id_origem = $origem->id_transicao;
					$tipo_origem = 2;
				}
				if($no->origin->type == 'activity'){
					$origem = $this->model->get_id_atividade($no->origin->id, $id_rede);
					$id_origem = $origem->id_atividade;
					$tipo_origem = 1;
				}

				if($no->destiny->type == 'event'){
					$destino = $this->model->get_id_evento($no->destiny->id, $id_rede);
					$id_destino = $destino->id_evento;
					$tipo_destino = 5;
				}
				if($no->destiny->type == 'repository'){
					$destino = $this->model->get_id_repositorio($no->destiny->id, $id_rede);
					$id_destino = $destino->id_repositorio;
					$tipo_destino = 4;
				}
				if($no->destiny->type == 'subnet'){
					$destino = $this->model->get_id_subrede($no->destiny->id, $id_rede);
					$id_destino = $destino->id_subrede;
					$tipo_destino = 3;
				}
				if($no->destiny->type == 'transition'){
					$destino = $this->model->get_id_transicao($no->destiny->id, $id_rede);
					$id_destino = $destino->id_transicao;
					$tipo_destino = 2;
				}
				if($no->destiny->type == 'activity'){
					$destino = $this->model->get_id_atividade($no->destiny->id, $id_rede);
					$id_destino = $destino->id_atividade;
					$tipo_destino = 1;
				}

				$data = array(
					"id_origem"		=> $id_origem,
					"id_destino" 	=> $id_destino,
					"tipo_origem"	=> $tipo_origem,
					"tipo_destino"	=> $tipo_destino 
				);

				$this->model->insert_arco($data);
			}
		}
	}
}