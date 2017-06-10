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

    function update($data, $id) {
        $this->db->where("id_usuario", $id);
        $this->db->update("usuario", $data);
        return $id;
    }

    function verificar_email($email) {
    	$query = $this->db->query("select * from usuario where email='".$email."'");
    	//echo $this->db->last_query();
        return $query->row();
    }
    function verificar_id($id) {
        $query = $this->db->query("select * from usuario u where md5(cast(id_usuario as character varying)) = '".$id."'");
        //echo $this->db->last_query();
        return $query->row();
    }

    function get_id($id) {
        $query = $this->db->query("select * from usuario u where id_usuario = ".$id);
        //echo $this->db->last_query();
        return $query->row();
    }

}?>
