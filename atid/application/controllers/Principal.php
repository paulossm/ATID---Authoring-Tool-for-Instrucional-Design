<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

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
		$this->load->helper('url');
		$this->load->view('login_view');
	}

	function autenticar($password = '', $login = '') 
   	{$this->load->helper('url');

   		$this->load->model("usuario_model", "usuario");
		if($password == ""||$login == ""){
			$login = $this->input->post('usuario_login');
			$password = $this->input->post('usuario_senha');
		}

        $loga = $this->usuario->autenticar($login, $password);
        if (count($loga) > 0) {
            echo "entrou";
			redirect(base_url() . 'index.php/Teste/atid');
        } else {
            echo 'não logou';
			redirect(base_url() . 'index.php/Teste/', 'refresh');
            
        }
    }
	
	public function atid()
	{	
		$this->load->helper('url');
		$this->load->view('draw_view');
	}
}
