<?php

class Draw_model extends CI_Model {

    public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

    function insert_rede($data) {
        $this->db->insert('rede',$data);
        return $this->db->insert_id();
        //echo $this->db->last_query();
    }

    function insert_atividade($data) {
        $this->db->insert('atividade',$data);
    }

    function insert_evento($data) {
        $this->db->insert('evento',$data);
            //echo $this->db->last_query();
    }

    function insert_repositorio($data) {
        $this->db->insert('repositorio',$data);
            //echo $this->db->last_query();
    }

    function insert_subrede($data) {
        $this->db->insert('subrede',$data);
            //echo $this->db->last_query();
    }

    function insert_transicao($data) {
        $this->db->insert('transicao',$data);
            //echo $this->db->last_query();
    }

    

}?>