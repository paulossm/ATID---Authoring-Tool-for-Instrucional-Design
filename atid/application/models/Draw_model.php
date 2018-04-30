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

    function get_id_evento($identificador, $id_rede) {
        $query = $this->db->query("select id_evento from evento where id_rede= ".$id_rede." and identificador = ".$identificador);
        return $query->row();
    }

    function get_id_subrede($identificador, $id_rede) {
        $query = $this->db->query("select id_subrede from subrede where id_rede= ".$id_rede." and identificador = ".$identificador);
        return $query->row();
    }

    function get_id_repositorio($identificador, $id_rede) {
        $query = $this->db->query("select id_repositorio from repositorio where id_rede= ".$id_rede." and identificador = ".$identificador);
        return $query->row();
    }

    function get_id_transicao($identificador, $id_rede) {
        $query = $this->db->query("select id_transicao from transicao where id_rede= ".$id_rede." and identificador = ".$identificador);
        return $query->row();
    }

    function get_id_atividade($identificador, $id_rede) {
        $query = $this->db->query("select id_atividade from atividade where id_rede= ".$id_rede." and identificador = ".$identificador);
        echo $this->db->last_query();
        return $query->row();
    }

    

}?>