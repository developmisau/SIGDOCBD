<?php
class Cargo_model extends CI_Model {

  /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */
    
    function __construct() {
        parent::__construct();
    }

    
    function get($perpage=0,$start=0,$one=false){

        $this->db->from('cargo');
        $this->db->select('cargo.*');
        $this->db->order_by('idCargo','DESC');
        $this->db->limit($perpage,$start);        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getActive($table,$fields){
        
        $this->db->select($fields);
        $this->db->from($table);
       $this->db->order_by('nomeCargo','asc');
        $query = $this->db->get();
        return $query->result();;
    }

    function getById($id){
        $this->db->where('idCargo',$id);
        $this->db->limit(1);
        return $this->db->get('cargo')->row();
    }
    
    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        
        return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
        {
            return TRUE;
        }
        
        return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        
        return FALSE;        
    }   
    
    function count($table){
        return $this->db->count_all($table);
    }

        function search( $pesquisa, $de, $ate, $perpage=0,$start=0,$one=false){
        
        if($pesquisa != null){
            $this->db->like('nomeCargo',$pesquisa);
            
        }

        elseif($de != null and $ate != null){
             $this->db->where('data_criacao >=',$de);
             $this->db->where('data_criacao <=',$ate);              
         }
        
        elseif($de != null){
             $this->db->where('data_criacao=',$de);           
         }
       $this->db->from('cargo');
       $this->db->order_by("idCargo","DESC");
       $this->db->limit($perpage,$start);
        
  
       $query = $this->db->get();
        
       $result =  !$one  ? $query->result() : $query->row();
       return $result;


        
    }
}

/* End of file permissoes_model.php */
/* Location: ./application/models/permissoes_model.php */