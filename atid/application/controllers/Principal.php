<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	function __construct() {
		 parent::__construct();

        $this->load->helper("url");
        $this->load->model("usuario_model", "usuario");
    }	


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		session_start();
		if(!isset ($_SESSION['id_usuario']) == true)
		{	
			unset ($_SESSION['id_usuario']);
        	unset ($_SESSION['email']);
        	unset ($_SESSION['nome']);
        	$this->load->view('login_view');
		}else{
			redirect("dashboard/");
		}
		
	}

	function autenticar($senha = '', $login = '') 
   	{
   		session_start();
   		if($senha == ""||$login == ""){
			$login = $this->input->post('email');
			$senha = md5($this->input->post('senha'));
		}

        $loga = $this->usuario->autenticar($login, $senha);
        if (count($loga) > 0) {
        	$_SESSION['id_usuario'] = $loga->id_usuario;
        	$_SESSION['email'] = $loga->email;
        	$_SESSION['nome'] = $loga->nome;
			redirect("dashboard/");
        } else {
        	unset ($_SESSION['id_usuario']);
        	unset ($_SESSION['email']);
        	unset ($_SESSION['nome']);
			redirect(base_url(), 'refresh');
            
        }
    }

    function deslogar() 
   	{
   		session_start();
   		unset ($_SESSION['id_usuario']);
        unset ($_SESSION['email']);
        unset ($_SESSION['nome']);
		redirect(base_url(), 'refresh');
    }
	

	function cadastrar_usuario() {
		$senha = md5($this->input->post('senha'));
		$confirmacao = md5($this->input->post('senha-confirma'));
		if($confirmacao != $senha){
            print_r("As senhas não correspondem!");
            //$this->load->view("principal/", $data);
		}else {
			$loga = $this->usuario->verificar_email($this->input->post("email"));
	        if (count($loga) > 0) {
	            print_r("E-mail já cadastrado!");
				//redirect(base_url());
	        } else {
				
			$data = array(
					"nome" => $this->input->post("nome"),
					"email" => $this->input->post("email"),
					"senha" =>  md5($this->input->post("senha")),
				);
				$this->usuario->insert($data);
				$this->autenticar($senha, $this->input->post("email"));
			}
		}
    }
}
