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
			$qtd_redes = $this->model->qtd_redes($_SESSION['id_usuario']);
			$data['qtd'] = $qtd_redes->qtd;
			$data['list'] = $this->model->redes($_SESSION['id_usuario']);
			$this->load->view('dashboard_view', $data);
	}

	public function editar($id_rede='')
	{	
		session_start();						
		$data['atividades'] = $this->model->atividades_rede_selecionada($id_rede); 						
		$data['transicoes'] =  $this->model->transicoes_rede_selecionada($id_rede);
		//$data['arcos'] =  $this->model->arcos_rede_selecionada($id_rede);
		$data['repositorios'] =  $this->model->repositorios_rede_selecionada($id_rede);
		$data['eventos'] =  $this->model->eventos_rede_selecionada($id_rede);
		$data['subredes'] =  $this->model->subredes_rede_selecionada($id_rede);		
		
		//echo json_encode($data);

		$this->load->view('draw_view', $data);
	}

	public function autoCompleteEmails()
	{
        if (isset($_GET['term'])){
	      $email = strtolower($_GET['term']);	      	     
	      $this->model->emailsCadastrados($email);
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
	    		$this->enviarEmail($usuario->nome,$this->input->post("email"));

				//redirect(base_url());
	        }
	        else{
	        	print_r("E-mail não cadastrado!");
	        	//echo $this->input->post("email");
	        }

	        redirect("dashboard/");
	}

	 function enviarEmail($nome='', $email='') {
	 	$arquivo = "Hello, " . $nome ."
						<br>A network was shared with you! 
						<br><br>To visualize it access the ATID.
						
						<br><br>
						<center><h1 style='color:#d8335b; margin-bottom: 0px;'>ATID</h1>
						<small>Authoring Tool for Instructional Design</small></center>
						";
			$assunto = "ATID - Shared Network";
	  		$init_mail["mailtype"] = "html";
				    $init_mail["protocol"] = "smtp";
				    $init_mail["newline"] = "\r\n";
				    $init_mail["crlf"] = "\r\n";
				    $init_mail["charset"] = "UTF-8";
				    $init_mail["validate"] = TRUE;
				    $init_mail["_smtp_auth"]  = TRUE;
				    $init_mail["smtp_host"] = "ssl://smtp.googlemail.com";
				    $init_mail["smtp_user"] = "atidnaoresponder@gmail.com";
				    $init_mail["smtp_pass"] = "4t1d4t1d";
				    $init_mail["smtp_port"] = "465";
				    $this->load->library("email", $init_mail);
				    $this->email->from($email, "ATID - Authoring Tool for Instructional Design");
				    $this->email->to($email);
				    $this->email->subject($assunto);
				    $this->email->message($arquivo);
				    if($this->email->send()){
				    }else{
						echo "<h3>Erro no envio</h3>";
						echo "<p>Informe o erro abaixo, com o email autenticador: </p>";
						echo $this->email->print_debugger();
				    }
			//redirect("Principal/confirma_resetar");	
    }
}
