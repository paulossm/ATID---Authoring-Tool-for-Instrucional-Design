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
            echo "As senhas não correspondem!";
            redirect(base_url());
		}else {
			$loga = $this->usuario->verificar_email($this->input->post("email"));
	        if (count($loga) > 0) {
	            echo "E-mail já cadastrado!";
				redirect(base_url());
	        } else {
				$data = array(
					"nome" => $this->input->post("nome"),
					"email" => $this->input->post("email"),
					"senha" =>  md5($this->input->post("senha")),
				);
				$this->usuario->insert($data);
				$this->enviarEmail($this->input->post("nome"),$this->input->post("email"));
				$this->autenticar($senha, $this->input->post("email"));
			}
		}
    }

    function enviarEmail($nome='', $email='') {
    	$data_envio = date('m/d/Y');
		$hora_envio = date('H:i:s');
		$arquivo = "Hello, " . $nome ."<br> We are glad that you decided to try ATID!
					<br><br>
					Your account was succesfully created!
					<br><br>
					<center><h1 style='color:#d8335b; margin-bottom: 0px;'>ATID</h1>
					<small>Authoring Tool for Instructional Design</small></center>
					";
		$assunto = "ATID - Sign up Confirmation";
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
    }
}
