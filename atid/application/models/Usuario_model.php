<?php

class Usuario_model extends CI_Model {

    public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

    function autenticar($login , $password) {
            $query = $this->db->query("select * from usuario where login='".$login."' and senha='".$password."'");
        return $query->row();
    }

}?>
