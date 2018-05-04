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
	    	if ($no->type == 'begin' || $no->type == 'end'){
				$data0 = array(
					"posicao_x" 	=> $no->x,
					"posicao_y"		=> $no->y,
					"id_rede"		=> $id_rede,
				);
				if($no->type == 'begin'){					
					$this->model->insert_begin($data0);
				}
				if($no->type == 'end')
					$this->model->insert_end($data0);
			}

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
			}
			else
			{				
				//Pegando id e tipo do nó de origem, para o arco
				if($no->origin->type == 'begin'){
					$origem = $this->model->get_begin($id_rede);
					$id_origem = $origem->id_begin;
					$pos_origem_x = $origem->posicao_x;
					$pos_origem_y = $origem->posicao_y;
					$tipo_origem = 10;					
				}
				if($no->origin->type == 'event'){
					$origem = $this->model->get_evento($id_rede);
					$id_origem = $origem->id_evento;
					$pos_origem_x = $origem->posicao_x;
					$pos_origem_y = $origem->posicao_y;
					$tipo_origem = 5;					
				}
				if($no->origin->type == 'repository'){
					$origem = $this->model->get_repositorio($id_rede);
					$id_origem = $origem->id_repositorio;
					$pos_origem_x = $origem->posicao_x;
					$pos_origem_y = $origem->posicao_y;
					$tipo_origem = 4;
				}
				if($no->origin->type == 'subnet'){
					$origem = $this->model->get_subrede($id_rede);
					$id_origem = $origem->id_subrede;
					$pos_origem_x = $origem->posicao_x;
					$pos_origem_y = $origem->posicao_y;
					$tipo_origem = 3;
				}
				if($no->origin->type == 'transition'){
					$origem = $this->model->get_transicao($id_rede);
					$id_origem = $origem->id_transicao;
					$pos_origem_x = $origem->posicao_x;
					$pos_origem_y = $origem->posicao_y;
					$tipo_origem = 2;
				}
				if($no->origin->type == 'activity'){
					$origem = $this->model->get_atividade($id_rede);
					$id_origem = $origem->id_atividade;
					$pos_origem_x = $origem->posicao_x;
					$pos_origem_y = $origem->posicao_y;
					$tipo_origem = 1;					
				}
			
				//Pegando id e tipo do nó de destino, para o arco
				if($no->destiny->type == 'end'){
					$destino = $this->model->get_end($id_rede);
					$id_destino = $destino->id_end;
					$pos_destino_x = $destino->posicao_x;
					$pos_destino_y = $destino->posicao_y;
					$tipo_destino = 20;					
				}
				if($no->destiny->type == 'event'){
					$destino = $this->model->get_evento($id_rede);
					$id_destino = $destino->id_evento;
					$pos_destino_x = $destino->posicao_x;
					$pos_destino_y = $destino->posicao_y;
					$tipo_destino = 5;
				}
				if($no->destiny->type == 'repository'){
					$destino = $this->model->get_repositorio($id_rede);
					$id_destino = $destino->id_repositorio;
					$pos_destino_x = $destino->posicao_x;
					$pos_destino_y = $destino->posicao_y;
					$tipo_destino = 4;					
				}
				if($no->destiny->type == 'subnet'){
					$destino = $this->model->get_subrede($id_rede);
					$id_destino = $destino->id_subrede;
					$pos_destino_x = $destino->posicao_x;
					$pos_destino_y = $destino->posicao_y;
					$tipo_destino = 3;					
				}
				if($no->destiny->type == 'transition'){
					$destino = $this->model->get_transicao($id_rede);
					$id_destino = $destino->id_transicao;
					$pos_destino_x = $destino->posicao_x;
					$pos_destino_y = $destino->posicao_y;
					$tipo_destino = 2;					
				}
				if($no->destiny->type == 'activity'){
					$destino = $this->model->get_atividade($id_rede);
					$id_destino = $destino->id_atividade;
					$pos_destino_x = $destino->posicao_x;
					$pos_destino_y = $destino->posicao_y;
					$tipo_destino = 1;					
				}
				
				$data = array(
					"id_origem"		=> $id_origem,
					"id_destino" 	=> $id_destino,
					"id_rede" 	    => $id_rede,
					"tipo_origem"	=> $tipo_origem,
					"tipo_destino"	=> $tipo_destino,
					"posicao_origem_x"	=> $pos_origem_x,
					"posicao_origem_y"	=> $pos_origem_y,
					"posicao_destino_x"	=> $pos_destino_x,
					"posicao_destino_y"	=> $pos_destino_y,
					"identificador"	=> $no->id
				);

				$this->model->insert_arco($data);
			}
		}
	}
}