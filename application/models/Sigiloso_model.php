<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sigiloso_model extends CI_Model {
 
 /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */
    
	function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }


    function getById($id){
        $this->db->where('idCorrespondencia',$id);
        $this->db->limit(1);
        return $this->db->get('correspondencia')->row();
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

    public function search( $pesquisa, $de, $ate){
        
        if($pesquisa != null){
            $this->db->like('numCorrespondencia',$pesquisa);
        }
        elseif($de != null){
            $this->db->where('dataEmissao >=' ,$de);
            $this->db->where('dataEmissao <=', $ate);
        }
        $this->db->limit(10);
        return $this->db->get('correspondencia')->result();
    }

    function addTramite($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        
        return FALSE;       
    }

    public function getEstados() {
        $this->db->order_by('nomeDirecao', 'asc');
        $estados = $this->db->get('direcao');
        
        if($estados->num_rows() > 0){
            return $estados->result();
        }
    }
    
    public function getCiudades($idDirecao) {
        $this->db->where('direcaoId', $idDirecao);
        $this->db->order_by('abrevDepartamento', 'asc');
        $departamento = $this->db->get('departamento');
        
        if($departamento->num_rows() > 0){
            return $departamento->result();
        }
    }

    public function getCiudades2($idDepartamento) {
        $this->db->where('departamentoId', $idDepartamento);
        $this->db->order_by('abrevReparticao', 'asc');
        $reparticao = $this->db->get('reparticao');
        
        if($reparticao->num_rows() > 0){
            return $reparticao->result();
        }
    }

    public function autoCompleteCliente($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('assunto', $q);
        $query = $this->db->get('classificacao');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['assunto'],'id'=>$row['codigo']);


            } 
            echo json_encode($row_set);
        }
    }

     function getDirecao($direcao){
    $query = $this->db->query("SELECT abrevDirecao FROM direcao where idDirecao='$direcao' ");

        foreach ($query->result() as $row)
        {
                $abrev= $row->abrevDirecao;
        }
        
     return $abrev;
        
    }

         function getDepartamento($departamento){
    $query = $this->db->query("SELECT abrevDepartamento FROM departamento where idDepartamento='$departamento' ");

        foreach ($query->result() as $row)
        {
                $abrev= $row->abrevDepartamento;
        }
        
     return $abrev;
        
    }

    function getReparticao($reparticao){
    $query = $this->db->query("SELECT abrevReparticao FROM reparticao where idReparticao='$reparticao' ");

        foreach ($query->result() as $row)
        {
                $abrev= $row->abrevReparticao;
        }
        
     return $abrev;
        
    }

      function getById2($id){
        $this->db->select('*');
        $this->db->from('correspondencia');
        $this->db->where('idCorrespondencia',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }
    
}



/* End of file arquivos_model.php */
/* Location: ./application/models/arquivos_model.php */