<?php
class Relatorios_model extends CI_Model {


      /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */
    
    function __construct() {
        parent::__construct();
    }  

    public function correspondenciasRapid(){
        // $this->db->order_by('id','asc');
        // return $this->db->get('correspondencias')->result();

        $this->db->from('correspondencias');
        $this->db->select('correspondencias.*, prioridades.nome as prioridades');
        $this->db->select('correspondencias.*, usuarios.nome as usuarios');
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('prioridades', 'correspondencias.prioridades_id = prioridades.id', 'left');
        $this->db->join('usuarios', 'correspondencias.usuarios_id = usuarios.id', 'left');
         $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    

    public function correspondenciasRapidMin(){
        $this->db->order_by('descricao','asc');
        $this->db->where('estoque < estoqueMinimo');
        return $this->db->get('correspondencias')->result();
    }

    public function correspondenciasCustom($tipo_pro = null){
        
        $whereTipo_pro = "";
        $whereStatus = "";
        
        $this->db->order_by('id','asc');
        $this->db->where('tipo_pro',$tipo_pro);
        return $this->db->get('correspondencias')->result();
       
        // $query = "SELECT correspondencias.*,clientes.nomeCliente,usuarios.nome FROM vendas LEFT JOIN clientes ON vendas.clientes_id = clientes.idClientes LEFT JOIN usuarios ON vendas.usuarios_id = usuarios.idUsuarios WHERE idVendas != 0 $whereData $whereCliente $whereTipo_pro";
        // return $this->db->query($query)->result();
    }

}