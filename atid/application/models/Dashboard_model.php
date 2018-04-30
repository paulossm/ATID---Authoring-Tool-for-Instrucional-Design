<?php

class Dashboard_model extends CI_Model {

    public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

    function atividades_rede_selecionada($id_rede){        
        $query = $this->db->query(" select * from atividade
                                    where atividade.id_rede = ".$id_rede);    	
        return $query->result();
    }

    function transicoes_rede_selecionada($id_rede){        
        $query = $this->db->query(" select * from transicao
                                    where transicao.id_rede = ".$id_rede);
        return $query->result();
    }

    /* function arcos_rede_selecionada($id_rede){        
        $query = $this->db->query(" select * from arco
                                    where arco.id_rede = ".$id_rede);    
        return $query->result();
    } */

    function repositorios_rede_selecionada($id_rede){        
        $query = $this->db->query(" select * from repositorio
                                    where repositorio.id_rede = ".$id_rede);
        return $query->result();
    }

    function eventos_rede_selecionada($id_rede){        
        $query = $this->db->query(" select * from evento
                                    where evento.id_rede = ".$id_rede);    
        return $query->result();
    }

    function subredes_rede_selecionada($id_rede){        
        $query = $this->db->query(" select * from subrede
                                    where subrede.id_rede = ".$id_rede);
        return $query->result();
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
        }
        else{        	            
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