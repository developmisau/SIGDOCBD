<?php
class Geral_model extends CI_Model {

 /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */
    
    function __construct() {
        parent::__construct();
    }

    
    
    function get($table,$perpage=0,$start=0,$one=false){
        
        $this->db->from($table);
        $this->db->select('*');
        $this->db->limit($perpage,$start);
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getActive($table,$fields){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('nome','asc');
    
        $query = $this->db->get();
        return $query->result();;
    }

    function getById($table,$id){
        $this->db->where('id',$id);
        $this->db->limit(1);
        return $this->db->get($table)->row();
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
}

/* End of file permissoes_model.php */
/* Location: ./application/models/permissoes_model.php */