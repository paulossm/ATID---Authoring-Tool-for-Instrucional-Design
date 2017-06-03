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

    function emailCadastrados($email_usuario = NULL){
        $query_nome = !is_null($email_usuario)?"WHERE email ILIKE '%$email_usuario%'":"";
        $sql = "
                SELECT email
                FROM usuario                
                $query_nome
                ORDER BY email;
            ";
        $query = $this->db->query($sql);
        echo $this->db->last_query();
        return $query->result();
    }


}?>