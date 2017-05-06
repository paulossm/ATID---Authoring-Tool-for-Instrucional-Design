<?php

class Usuario_model extends CI_Model {

    public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

    function autenticar($login , $password) {
    	$query = $this->db->query("select * from usuario where email='".$login."' and senha='".$password."'");
    	//echo $this->db->last_query();
        return $query->row();
    }

    function insert($data) {
    	$this->db->insert('usuario',$data);
    		//echo $this->db->last_query();
    }

    function verificar_email($email) {
    	$query = $this->db->query("select * from usuario where email='".$email."'");
    	//echo $this->db->last_query();
        return $query->row();
    }

}?>
