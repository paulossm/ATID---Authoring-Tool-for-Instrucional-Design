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

    function insert_arco($data) {
        $this->db->insert('arco',$data);
            //echo $this->db->last_query();
    }

    function insert_begin($data) {
        $this->db->insert('inicio',$data);
            //echo $this->db->last_query();
    }

    function insert_end($data) {
        $this->db->insert('fim',$data);
            //echo $this->db->last_query();
    }

    function get_evento($id_rede) {
        $query = $this->db->query("select * from evento where id_rede= ".$id_rede);
        return $query->row();
    }

    function get_subrede($id_rede) {
        $query = $this->db->query("select * from subrede where id_rede= ".$id_rede);
        return $query->row();
    }

    function get_repositorio($id_rede) {
        $query = $this->db->query("select * from repositorio where id_rede= ".$id_rede);
        return $query->row();
    }

    function get_transicao($id_rede) {
        $query = $this->db->query("select * from transicao where id_rede= ".$id_rede);
        return $query->row();
    }

    function get_atividade($id_rede) {
        $query = $this->db->query("select * from atividade where id_rede= ".$id_rede);
        echo $this->db->last_query();
        return $query->row();
    }

    function get_begin($id_rede) {
        $query = $this->db->query("select * from inicio where id_rede= ".$id_rede);
        echo $this->db->last_query();
        return $query->row();
    }

    function get_end($id_rede) {
        $query = $this->db->query("select * from fim where id_rede= ".$id_rede);
        echo $this->db->last_query();
        return $query->row();
    }
    
}?>