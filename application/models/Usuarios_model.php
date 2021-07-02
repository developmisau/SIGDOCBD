<?php
class Usuarios_model extends CI_Model {


     /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */
    
    function __construct() {
        parent::__construct();
    }

    

    function get($perpage=0,$start=0,$one=false){
        
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, permissoes.nome as permissao');
        $this->db->select('usuarios.*, direcoes.abreviatura as abreDir');
        $this->db->select('usuarios.*, departamentos.abreviatura as abreDep');
        $this->db->select('usuarios.*, reparticoes.abreviatura as abreRep');
        $this->db->limit($perpage,$start);
        $this->db->join('permissoes', 'usuarios.permissoes_id = permissoes.idPermissao', 'left');
        $this->db->join('direcoes', 'usuarios.direcoes_id = direcoes.id', 'left');
        $this->db->join('departamentos', 'usuarios.departamentos_id = departamentos.id', 'left');
        $this->db->join('reparticoes', 'usuarios.reparticoes_id = reparticoes.id', 'left');
  
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

     function getAllTipos(){
        $this->db->where('situacao',1);
        return $this->db->get('tiposUsuario')->result();
    }

    function getById($id){
        $this->db->where('id',$id);
        $this->db->limit(1);
        return $this->db->get('usuarios')->row();
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

     function getActive($table,$fields){
        
        $this->db->select($fields);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
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

     public function search( $nome, $email, $direcoes, $perpage=0,$start=0,$one=false){
        
        if($nome != null){ 
           $this->db->like('usuarios.nome',$nome);
           $this->db->or_like('apelido',$nome);
        }

        elseif ($email != null) {
            $this->db->like('usuarios.email',$email);
        }

        elseif ($direcoes!= null) {
            $this->db->like('usuarios.direcoes_id',$direcoes);
            
        }
       
        $this->db->from('usuarios');
       $this->db->select('usuarios.*, direcoes.abreviatura as abreDir');
       $this->db->select('usuarios.*, departamentos.abreviatura as abreDep');
       $this->db->select('usuarios.*, reparticoes.abreviatura as abreRep');
       $this->db->select('usuarios.*, permissoes.nome as permissao');
       $this->db->order_by("id","DESC");
       $this->db->limit($perpage,$start);
       $this->db->join('direcoes', 'direcoes.id = usuarios.direcoes_id', 'left');
       $this->db->join('departamentos', 'departamentos.id = usuarios.departamentos_id', 'left');
       $this->db->join('reparticoes', 'reparticoes.id = usuarios.reparticoes_id', 'left');
       $this->db->join('permissoes', 'permissoes.idPermissao = usuarios.permissoes_id', 'left');
       
        
  
       $query = $this->db->get();
        
       $result =  !$one  ? $query->result() : $query->row();
       return $result;


        
    }


}
