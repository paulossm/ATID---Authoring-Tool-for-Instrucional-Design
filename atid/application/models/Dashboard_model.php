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

    function emailsCadastrados($email){
        $this->db->select('email');
        $this->db->like('email', $email);
        $query = $this->db->get('usuario');        
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['email'])); //build an array
          }
          
          
          
          echo json_encode($row_set); //format the array into json data
          //$listaEmails = json_encode($row_set); 
          //return  $listaEmails;
        }
        else{
        	
            /*
            $row_set[] = "Nenhum resultado encontrado";   
        	echo json_encode($row_set); //format the array into json data	                 
            */

        }
    }

    function get_usuario($email) {
        $query = $this->db->query("select id_usuario, nome from usuario where email='".$email."'");
        //echo $this->db->last_query();
        return $query->row();
    }
    
    function insertRedeCompartilhada($data) {
        $this->db->insert('redes_compartilhadas',$data);
            //echo $this->db->last_query();
    }


}?>