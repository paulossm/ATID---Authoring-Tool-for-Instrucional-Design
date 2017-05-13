<?php

class Dashboard_model extends CI_Model {

    public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

    function redes($id_usuario) {
    	$query = $this->db->query("select r.*, u.nome as nome_usuario from rede r 
                                    inner join usuario u on u.id_usuario = r.id_criador
                                    where r.id_criador = ".$id_usuario);
    	//echo $this->db->last_query();
        return $query->result();
    }

    function qtd_redes($id_usuario) {
        $query = $this->db->query("select count(*) as qtd from rede r
                                    where id_criador = ".$id_usuario);
        //echo $this->db->last_query();
        return $query->row();
    }


}?>