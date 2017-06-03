<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		 parent::__construct();

        $this->load->helper("url");
        $this->load->model("usuario_model", "usuario");
        $this->load->model("Dashboard_model", "model");
    }	


	public function index()
	{	
		session_start();
		if(!isset ($_SESSION['id_usuario']) == true)
		{	
			unset ($_SESSION['id_usuario']);
        	unset ($_SESSION['email']);
        	unset ($_SESSION['nome']);
        	redirect("principal/");
		}else{
			$qtd_redes = $this->model->qtd_redes($_SESSION['id_usuario']);
			$data['qtd'] = $qtd_redes->qtd;
			$data['list'] = $this->model->redes($_SESSION['id_usuario']);
			$this->load->view('dashboard_view', $data);
		}
		
		
	}

	public function editar($id_rede='')
	{	
		session_start();
		$this->load->view('draw_view');
	}

	public function autoCompleteEmails()
	{
        if (isset($_GET['term'])){
	      $email = strtolower($_GET['term']);
	      $this->model->emailCadastrados($email);
	    }  
	}

	public function cadastrarRedeCompartilhada()
	{	
		//session_start();

		
		$usuario = $this->model->get_usuario($this->input->get("email"));
	        if (count($usuario) > 0) {
	    		
	    		
	        	//$id_rede = $this->model->id_rede_compartilhada($this->button->post("id"));	

	    		//Pega id's de rede_compartilhada e usuario e cadastra no banco 	
	    		$data = array(
					"id_rede" => $this->input->get("id_rede"),
					"id_usuario" =>  $usuario->id_usuario,										
				);        

	    		$this->model->insertRedeCompartilhada($data);

				//redirect(base_url());
	        }
	        else{
	        	print_r("E-mail não cadastrado!");
	        	//echo $this->input->post("email");
	        }

	        redirect("dashboard/");
	}
}
