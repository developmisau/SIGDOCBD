<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class correspondencias_model extends CI_Model {
 
 /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */

 function get($perpage=0,$start=0,$one=false){
        
        $this->db->from('correspondencias');
        $this->db->select('correspondencias.*, prioridades.nome as prioridades');
        $this->db->select('correspondencias.*, direcoes.nome as direcoes');
        $this->db->select('correspondencias.*, departamentos.nome as departamentos');
        $this->db->select('correspondencias.*, reparticoes.nome as reparticoes');
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('prioridades', 'correspondencias.prioridades_id = prioridades.id', 'left');
        $this->db->join('direcoes', 'correspondencias.local_direcoes_id = direcoes.id', 'left');
        $this->db->join('departamentos', 'correspondencias.local_departamentos_id = departamentos.id', 'left');
        $this->db->join('reparticoes', 'correspondencias.local_reparticoes_id = reparticoes.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

     function get_sigiloso($perpage=0,$start=0,$one=false){
        
        $this->db->from('corre_sigiloso');
        $this->db->select('corre_sigiloso.*, nivel_conf.nome as nivel');
        $this->db->select('corre_sigiloso.*, destinatario.nomeDestinatario as destinatario');
        $this->db->select('corre_sigiloso.*, direcoes.nome as direcoes');
        $this->db->select('corre_sigiloso.*, departamentos.nome as departamentos');
        $this->db->select('corre_sigiloso.*, reparticoes.nome as reparticoes');
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('destinatario', 'corre_sigiloso.destinatarios_id = destinatario.idDestinatario', 'left');
        $this->db->join('nivel_conf', 'corre_sigiloso.nivel_conf_id = nivel_conf.id', 'left');
        $this->db->join('direcoes', 'corre_sigiloso.local_direcoes_id = direcoes.id', 'left');
        $this->db->join('departamentos', 'corre_sigiloso.local_departamentos_id = departamentos.id', 'left');
        $this->db->join('reparticoes', 'corre_sigiloso.local_reparticoes_id = reparticoes.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

     function getRastreio($perpage=0,$start=0,$one=false){
        
        $this->db->from('correspondencias');
        //Tramitar
        $this->db->select('correspondencias.*, tramitar.estadoPar as estadoPar');
       // $this->db->select('correspondencias.*, tramitar.estadoDes as estadoDes');

        //Parecer
        // $this->db->select('correspondencias.*, parecer.estadoPar2 as estadoPar2');
        // $this->db->select('correspondencias.*, parecer.estadoDes as estadoDes2');
       //$this->db->select('correspondencias.*, parecer.local_direcoes_id as dirPar');
        //$this->db->select('correspondencias.*, parecer.local_departamentos_id as depPar');
        //$this->db->select('correspondencias.*, parecer.local_reparticoes_id as repPar');
        //Despacho      
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        //parecer
        //$this->db->join('parecer', 'parecer.correspondencias_id = correspondencias.id', 'left');
        //tramitar
        $this->db->join('tramitar', 'tramitar.correspondencias_id = correspondencias.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

  function getEstadosDespacho($perpage=0,$start=0,$one=false){
        
        $this->db->from('despacho');
        $this->db->select('despacho.*, correspondencias.numCorrespondencia as correspondencias');
        $this->db->select('despacho.*, correspondencias.refRec as refRec');
        $this->db->select('despacho.*, correspondencias.local_entrada as local_entrada');
        $this->db->select('despacho.*, correspondencias.date as data_criacao');
        // $this->db->select('despacho.*, correspondencias.estadoVer as estadoVer');
        // $this->db->select('despacho.*, correspondencias.estadoPar as estadoPar');
        $this->db->select('despacho.*, correspondencias.estadoDes as estadoDes');
        $this->db->select('despacho.*, correspondencias.url as url');
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'despacho.correspondencias_id = correspondencias.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

     function getTramitar($perpage=0,$start=0,$one=false){
        
        $this->db->from('tramitar');
        $this->db->select('tramitar.*, correspondencias.id as correspondencias_id');
        $this->db->select('tramitar.*, correspondencias.tipo_pro as tipo_pro');
        $this->db->select('tramitar.*, correspondencias.numCorrespondencia as correspondencias');
        $this->db->select('tramitar.*, correspondencias.assunto as assunto');
        $this->db->select('tramitar.*, correspondencias.refRec as refRec');
        $this->db->select('tramitar.*, correspondencias.date as date');
        $this->db->select('tramitar.*, correspondencias.estadoTra as estadoTra');
        $this->db->select('tramitar.*, correspondencias.url as url');
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'tramitar.correspondencias_id = correspondencias.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getParecer($perpage=0,$start=0,$one=false){
        
        $this->db->from('tramitar');       
        $this->db->select('tramitar.*, parecer.id as parecer_id');
        $this->db->select('tramitar.*, parecer.direcoes_id as local_direcoes_id');
        $this->db->select('tramitar.*, parecer.departamentos_id as local_departamentos_id');
        $this->db->select('tramitar.*, parecer.reparticoes_id as local_reparticoes_id');
        $this->db->select('tramitar.*, parecer.data_parecer as data_parecer');
        $this->db->select('tramitar.*, parecer.estadoPar2 as estadoPar2');
        $this->db->select('tramitar.*, parecer.estadoDes as estadoDes2');
        $this->db->select('tramitar.*, correspondencias.numCorrespondencia as correspondencias');
        $this->db->select('tramitar.*, correspondencias.assunto as assunto');
        $this->db->select('tramitar.*, correspondencias.refRec as refRec');
        $this->db->select('tramitar.*, correspondencias.tipo_pro as tipo_pro');
        $this->db->select('tramitar.*, correspondencias.date as date');
        $this->db->select('tramitar.*, correspondencias.url as url');
        
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('parecer', 'parecer.tramitar_id = tramitar.id', 'left');
        $this->db->join('correspondencias', 'correspondencias.id = tramitar.correspondencias_id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }


    function getParecerFeitos($perpage=0,$start=0,$one=false){
        
        $this->db->from('tramitar');       
        $this->db->select('tramitar.*, parecer.id as parecer_id');        
        $this->db->select('tramitar.*, parecer.local_direcoes_id as local_direcoes_id');        
        $this->db->select('tramitar.*, parecer.local_departamentos_id as local_departamentos_id');     
        $this->db->select('tramitar.*, parecer.local_reparticoes_id as local_reparticoes_id');        
        $this->db->select('tramitar.*, parecer.data_parecer as data_parecer');        
        $this->db->select('tramitar.*, correspondencias.id as idCorres');        
        $this->db->select('tramitar.*, correspondencias.numCorrespondencia as numCorrespondencia');        
        $this->db->select('tramitar.*, correspondencias.date as date');        
        $this->db->select('tramitar.*, correspondencias.refRec as refRec');        
        $this->db->select('tramitar.*, correspondencias.url as url');        
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'correspondencias.id = tramitar.correspondencias_id', 'left');
        $this->db->join('parecer', 'parecer.tramitar_id = tramitar.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getDespachoFeitos($perpage=0,$start=0,$one=false){
        
        $this->db->from('despacho');       
        $this->db->select('despacho.*, correspondencias.numCorrespondencia as numCorrespondencia');        
        $this->db->select('despacho.*, correspondencias.id as idCorres');        
        $this->db->select('despacho.*, correspondencias.date as date');        
        $this->db->select('despacho.*, correspondencias.refRec as refRec');        
        $this->db->select('despacho.*, correspondencias.url as url');        
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'correspondencias.id = despacho.correspondencias_id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getPendentePar($perpage=0,$start=0,$one=false){
        
        $this->db->from('correspondencias');
        $this->db->select('correspondencias.*, prioridades.nome as prioridades');
        $this->db->select('correspondencias.*, parecer.data_parecer as data_parecer');
        $this->db->select('correspondencias.*, parecer.destinatario as destinatario');
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('prioridades', 'correspondencias.prioridades_id = prioridades.id', 'left');
        $this->db->join('parecer', 'correspondencias.id = parecer.correspondencias_id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
    
    function getById2($id){
        $this->db->from('correspondencias');
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->limit(1);
                
        return $this->db->get()->row();
    }

    function getById3($id){
        $this->db->from('direcoes');
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->limit(1);
                
        return $this->db->get()->row();
    }
    
     public function getID(){
        $this->db->select('id');
        $this->db->order_by('id', 'desc');
        $getID= $this->db->get('correspondencias');
        
         if($getID->num_rows() > 0){
            return $getID->row()->id;
        }
        else{ return 0;}
    } 

    public function getNrCorreSector($local){
    $this->db->select('local_direcoes_id');
    $this->db->where('local_direcoes_id',$local);
    $q=$this->db->get('correspondencias');
    $count=$q->result();
    return count($count);

    }


    public function lastId(){
        $this->db->select('id');
        $this->db->order_by('id', 'desc');
        $getID= $this->db->get('corre_sigiloso');
        
         if($getID->num_rows() > 0){
            return $getID->row()->id;
        }
        else{ return 0;}
    } 
    
    function historicoTramitar($perpage=0,$start=0,$one=false)
     { 
        $this->db->from('tramitar');
        $this->db->select('tramitar.*, correspondencias.id as correspondencias_id');
        //direcoes
        $this->db->select('tramitar.*, direcoes.nome as local_direcoes');
        //departamentos
        $this->db->select('tramitar.*, departamentos.nome as local_departamentos');
        //reparticoes
        $this->db->select('tramitar.*, reparticoes.nome as local_reparticoes');
        //usuarios
        $this->db->select('tramitar.*, usuarios.nome as usuarios');

        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'tramitar.correspondencias_id = correspondencias.id', 'left');
        $this->db->join('direcoes', 'tramitar.direcoes_id = direcoes.id', 'left');
        $this->db->join('departamentos', 'tramitar.departamentos_id = departamentos.id', 'left');
        $this->db->join('reparticoes', 'tramitar.reparticoes_id = reparticoes.id', 'left');
        $this->db->join('usuarios', 'tramitar.usuarios_id = usuarios.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    } 

    function historicoParecer($perpage=0,$start=0,$one=false)
     { 
        $this->db->from('parecer');
        $this->db->select('parecer.*, tramitar.id as tramitar_id');
        $this->db->select('parecer.*, tramitar.data_tramitar as data_tramitar');
        //direcoes
        $this->db->select('parecer.*, direcoes.nome as local_direcoes');
        //departamentos
        $this->db->select('parecer.*, departamentos.nome as local_departamentos');
        //reparticoes
        $this->db->select('parecer.*, reparticoes.nome as local_reparticoes');
        //usuarios
        $this->db->select('parecer.*, usuarios.nome as usuarios');

        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('tramitar', 'parecer.tramitar_id = tramitar.id', 'left');
        $this->db->join('direcoes', 'parecer.direcoes_id = direcoes.id', 'left');
        $this->db->join('departamentos', 'parecer.departamentos_id = departamentos.id', 'left');
        $this->db->join('reparticoes', 'parecer.reparticoes_id = reparticoes.id', 'left');
        $this->db->join('usuarios', 'parecer.usuarios_id = usuarios.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    } 

   function historicoDespacho($perpage=0,$start=0,$one=false)
     {
        $this->db->from('despacho');
        $this->db->select('despacho.*, correspondencias.id as idCorres');
        $this->db->select('despacho.*, correspondencias.date as date');
        //direcoes
        $this->db->select('despacho.*, direcoes.nome as local_direcoes');
        //departamentos
        $this->db->select('despacho.*, departamentos.nome as local_departamentos');
        //reparticoes
        $this->db->select('despacho.*, reparticoes.nome as local_reparticoes');
        //usuarios
        $this->db->select('despacho.*, usuarios.nome as usuarios');

        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'despacho.correspondencias_id = correspondencias.id', 'left');
        $this->db->join('direcoes', 'despacho.direcoes_id = direcoes.id', 'left');
        $this->db->join('departamentos', 'despacho.departamentos_id = departamentos.id', 'left');
        $this->db->join('reparticoes', 'despacho.reparticoes_id = reparticoes.id', 'left');
        $this->db->join('usuarios', 'despacho.usuarios_id = usuarios.id', 'left');
        
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    } 

       function historicoDespacho2($id)
     {
    $this->db->where('correspondencias_id',$id);
    $this->db->limit(1);
    return $this->db->get('despacho')->row();
    } 

  function getDespacho($id)
     {
    $this->db->where('id',$id);
    $this->db->limit(1);
    return $this->db->get('despacho')->row();
    } 



   public function ultimoId(){
       
       $query = $this->db->query("SELECT id FROM correspondencias ORDER BY id desc");
       if ($query->num_rows() > 0) {
           return $query->row();
       }
       else{
        return 0;
       }
       
 
    } 



    function getById($id){
        $this->db->where('id',$id);
        $this->db->limit(1);
        return $this->db->get('correspondencias')->row();
    }

       

    public function retorno ($table, $data,$numcorrespondencia,$refRec){
        $query1 = $this->db->query("SELECT numcorrespondencia FROM $table where numcorrespondencia='$numcorrespondencia' ");

        $query2 = $this->db->query("SELECT refRec FROM $table where refRec='$refRec' ");
       
        if($query1->num_rows() > 0 or $query2->num_rows() > 0){
                    return FALSE;
        }
        elseif ($query1->num_rows() > 0) {
            return 01;
        }
        elseif ($query2->num_rows() > 0) {
            return 11;
        }

    }
    
    function add($table, $data,$numcorrespondencia,$refRec,$num_entrada_saida_livro){
      
        if ($numcorrespondencia==" " or $refRec==" ") {
            return $this->addSigiloso($table,$data);
        }
        else{
            $query = $this->db->query("SELECT numcorrespondencia FROM $table where numcorrespondencia='$numcorrespondencia' or refRec='$refRec'");
       
        if($query->num_rows() > 0){
            
            return $this->retorno($table, $data,$numcorrespondencia,$refRec);
            

        }
        else{
           $this->db->insert($table, $data); 
           return TRUE;  
        }
       
        }
    }

   

    function addSigiloso($table,$data){
        
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

    

    function addTramite($data,$data_tramitar,$id){
        //get bill entries 
        $count = count($data['count']);        
        for($i = 0; $i<$count; $i++){
            if (empty($data['direcoes'][$i])) {
                continue;
            }
            else{
              if (empty($data['reparticoes'][$i])) {
                $data['reparticoes'][$i]=0;
            }  
            $entries[] = array(
                'correspondencias_id'=>$id,
                'direcoes_id'=>$data['direcoes'][$i],
                'departamentos_id'=>$data['departamentos'][$i],
                'reparticoes_id'=>$data['reparticoes'][$i],                
                'observacao'=>$data['observacao'][$i],                
                'data_tramitar'=>$data_tramitar,              
                'usuarios_id'=>$data['usuarios'][$i],               
                );
        }
        }
        $this->db->insert_batch('tramitar', $entries); 
        if($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    function addParecer($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        
        return FALSE;       
    }

        function addComfirmar($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        
        return FALSE;       
    }


       function addDespacho($table,$data){
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
    
     public function getDepartamentos($id, $status=1) {
        $this->db->where('direcoes_id', $id);
        $this->db->order_by('nome', 'asc');
       // $this->db->where('estados_id', $status);
        $departamento = $this->db->get('departamentos');
        
        if($departamento->num_rows() > 0){
            return $departamento->result();
        } 
    }

    public function getReparticoes($id, $status=1) {
        $this->db->where('departamentos_id', $id);
        $this->db->order_by('nome', 'asc');
       // $this->db->where('estados_id', $status);
        $departamento = $this->db->get('reparticoes');
        
        if($departamento->num_rows() > 0){
            return $departamento->result();
        } 
    }

   

     function getDirecoesUser($direcoes){
    $query = $this->db->query("SELECT nome FROM direcoes where id='$direcoes' ");
    if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->nome;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }

         function getDepartamentosUser($departamentos){
    $query = $this->db->query("SELECT nome FROM departamentos where id='$departamentos' ");

         if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->nome;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }

    function getReparticoesUser($reparticoes){
    $query = $this->db->query("SELECT nome FROM reparticoes where id='$reparticoes' ");

        if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->nome;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }


     function getDirecoes2($direcoes){
    $query = $this->db->query("SELECT abreviatura FROM direcoes where id='$direcoes' ");
    if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->abreviatura;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }

         function getDepartamentos2($departamentos){
    $query = $this->db->query("SELECT abreviatura FROM departamentos where id='$departamentos' ");

         if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->abreviatura;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }

    function getReparticoes2($reparticoes){
    $query = $this->db->query("SELECT abreviatura FROM reparticoes where id='$reparticoes' ");

        if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->abreviatura;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }

      function getClassificacao($classificacao){
    $query = $this->db->query("SELECT codigo FROM classificacao where id='$classificacao' ");
    if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->codigo;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }

    function getTipo_doc($tipo_doc){
    $query = $this->db->query("SELECT nome FROM tipo_doc where id='$tipo_doc' ");
    if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->nome;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }

     function getPro_externa($pro_externa){
    $query = $this->db->query("SELECT abreviatura FROM pro_externa where id='$pro_externa' ");
    if ($query->num_rows()>0) {
       

            foreach ($query->result() as $row)
            {
                    $abrev= $row->abreviatura;
            }
            
         return $abrev;
     }
     $error = $this->db->error();
     return     $error;
        
    }



     public function autoClassificador($q){

        $this->db->select('*');
        $this->db->limit(10);
        $nome=$this->db->like('nome', $q);
        $codigo= $this->db->or_like('codigo', $q);
        $query = $this->db->get('classificacao');
        if($query->num_rows() > 0 ){
      
            foreach ($query->result_array() as $row){
                $row_set[] = array(
                    'label'=>$row['nome'].' - '.$row['codigo'],
                    'value'=>$row['codigo'].' - '.$row['nome'],                    
                    'id'=>$row['id']);


            } 
            echo json_encode($row_set);
        }
    }


       public function autoCompleteProvinienciaExterna($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nome', $q);
        $query = $this->db->get('pro_externa');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array(
                    'label'=>$row['nome'],
                    'id'=>$row['id']);


            } 
            echo json_encode($row_set);
        }
        else{
            echo json_encode("0");
        }
    }

   public function autoCompleteDestinatario($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nomeDestinatario', $q);
        $query = $this->db->get('consultarCargo');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row ){  
            $idDestinatario=$row['idDestinatario'];                      
                        
            $row_set[] = array(
                'label'=>$row['nomeDestinatario']."     ".$row['nomeCargo'],
                'id'=>$row['idDestinatario']);
            
            } 
            echo json_encode($row_set);
            
        }
    }

   public function autoCompleteUsuarios($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nome', $q);
        $query = $this->db->get('usuarios');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row ){  
            $idUsuarios=$row['id'];                      
                        
            $row_set[] = array(
                'label'=>$row['nome']." ".$row['email'],
                'id'=>$row['id']);
            
            } 
            echo json_encode($row_set);
            
        }
    }


  


    public function search( $pesquisa, $de, $ate, $perpage=0,$start=0,$one=false){
        
        if($pesquisa != null){
            $this->db->like('numcorrespondencia',$pesquisa);
            $this->db->or_like('refRec',$pesquisa);
            $this->db->or_like('assunto',$pesquisa);
            $this->db->or_like('destinatario',$pesquisa);
            
        }

        elseif($de != null and $ate != null){
             $this->db->where('data_normal >=',$de);
             $this->db->where('data_normal <=',$ate);              
         }
        
        elseif($de != null){
             $this->db->where('data_normal=',$de);           
         }
       $this->db->from('correspondencias');
       $this->db->select('correspondencias.*, prioridades.nome as prioridades');
       $this->db->order_by("id","DESC");
       $this->db->limit($perpage,$start);
       $this->db->join('prioridades', 'correspondencias.prioridades_id = prioridades.id', 'left');
        
  
       $query = $this->db->get();
        
       $result =  !$one  ? $query->result() : $query->row();
       return $result;


        
    }



    public function search_sigiloso( $pesquisa, $de, $ate, $perpage=0,$start=0,$one=false){
        
        if($pesquisa != null){
            $this->db->like('numCorrespondencia',$pesquisa);
            $this->db->or_like('tipo_pro',$pesquisa);
           
            
        }

        elseif($de != null and $ate != null){
             $this->db->where('data_normal >=',$de);
             $this->db->where('data_normal <=',$ate);              
         }
        
        elseif($de != null){
             $this->db->where('data_normal=',$de);           
         }
       $this->db->from('corre_sigiloso');
       $this->db->select('corre_sigiloso.*, nivel_conf.nome as nivel');
       $this->db->select('corre_sigiloso.*, destinatario.nomeDestinatario as destinatario');
       $this->db->order_by("id","DESC");
       $this->db->limit($perpage,$start);
       $this->db->join('destinatario', 'corre_sigiloso.destinatarios_id = destinatario.idDestinatario', 'left');
       $this->db->join('nivel_conf', 'corre_sigiloso.nivel_conf_id = nivel_conf.id', 'left');
        
  
       $query = $this->db->get();
        
       $result =  !$one  ? $query->result() : $query->row();
       return $result;


        
    }

    public function search_pareceres_feitos( $pesquisa, $de, $ate, $perpage=0,$start=0,$one=false){
        
        if($pesquisa != null){
            $this->db->like('numCorrespondencia',$pesquisa);
            $this->db->or_like('tipo_pro',$pesquisa);
           
            
        }

        elseif($de != null and $ate != null){
             $this->db->where('data_normal >=',$de);
             $this->db->where('data_normal <=',$ate);              
         }
        
        elseif($de != null){
             $this->db->where('data_normal=',$de);           
         }
        
        $this->db->from('tramitar');       
        $this->db->select('tramitar.*, parecer.id as parecer_id');        
        $this->db->select('tramitar.*, parecer.local_direcoes_id as local_direcoes_id');        
        $this->db->select('tramitar.*, parecer.local_departamentos_id as local_departamentos_id');     
        $this->db->select('tramitar.*, parecer.local_reparticoes_id as local_reparticoes_id');        
        $this->db->select('tramitar.*, parecer.data_parecer as data_parecer');        
        $this->db->select('tramitar.*, correspondencias.id as idCorres');        
        $this->db->select('tramitar.*, correspondencias.numCorrespondencia as numCorrespondencia');        
        $this->db->select('tramitar.*, correspondencias.date as date');        
        $this->db->select('tramitar.*, correspondencias.refRec as refRec');        
        $this->db->select('tramitar.*, correspondencias.url as url');        
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'correspondencias.id = tramitar.correspondencias_id', 'left');
        $this->db->join('parecer', 'parecer.tramitar_id = tramitar.id', 'left');
        
  
       $query = $this->db->get();
        
       $result =  !$one  ? $query->result() : $query->row();
       return $result;


        
    }

public function search_despachos_feitos( $pesquisa, $de, $ate, $perpage=0,$start=0,$one=false){
        
        if($pesquisa != null){
            $this->db->like('numCorrespondencia',$pesquisa);
            $this->db->or_like('tipo_pro',$pesquisa);
           
            
        }

        elseif($de != null and $ate != null){
             $this->db->where('data_normal >=',$de);
             $this->db->where('data_normal <=',$ate);              
         }
        
        elseif($de != null){
             $this->db->where('data_normal=',$de);           
         }
        
        $this->db->from('despacho');       
        $this->db->select('despacho.*, correspondencias.numCorrespondencia as numCorrespondencia');       
        $this->db->select('despacho.*, correspondencias.id as idCorres');        
        $this->db->select('despacho.*, correspondencias.date as date');        
        $this->db->select('despacho.*, correspondencias.refRec as refRec');        
        $this->db->select('despacho.*, correspondencias.url as url');        
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'correspondencias.id = despacho.correspondencias_id', 'left');
        
  
       $query = $this->db->get();
        
       $result =  !$one  ? $query->result() : $query->row();
       return $result;


        
    }

public function search_recebida_tra( $pesquisa, $de, $ate, $perpage=0,$start=0,$one=false){
        
        if($pesquisa != null){
            $this->db->like('numCorrespondencia',$pesquisa);
            $this->db->or_like('tipo_pro',$pesquisa);
           
            
        }

        elseif($de != null and $ate != null){
             $this->db->where('data_normal >=',$de);
             $this->db->where('data_normal <=',$ate);              
         }
        
        elseif($de != null){
             $this->db->where('data_normal=',$de);           
         }
        
        $this->db->from('tramitar');
        $this->db->select('tramitar.*, correspondencias.id as correspondencias_id');
        $this->db->select('tramitar.*, correspondencias.tipo_pro as tipo_pro');
        $this->db->select('tramitar.*, correspondencias.numCorrespondencia as correspondencias');
        $this->db->select('tramitar.*, correspondencias.assunto as assunto');
        $this->db->select('tramitar.*, correspondencias.refRec as refRec');
        $this->db->select('tramitar.*, correspondencias.date as date');
        $this->db->select('tramitar.*, correspondencias.estadoTra as estadoTra');
        $this->db->select('tramitar.*, correspondencias.url as url');
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('correspondencias', 'tramitar.correspondencias_id = correspondencias.id', 'left');
        
  
       $query = $this->db->get();
        
       $result =  !$one  ? $query->result() : $query->row();
       return $result;


        
    }

public function search_recebida_par( $pesquisa, $de, $ate, $perpage=0,$start=0,$one=false){
        
        if($pesquisa != null){
            $this->db->like('numCorrespondencia',$pesquisa);
            $this->db->or_like('tipo_pro',$pesquisa);
           
            
        }

        elseif($de != null and $ate != null){
             $this->db->where('data_normal >=',$de);
             $this->db->where('data_normal <=',$ate);              
         }
        
        elseif($de != null){
             $this->db->where('data_normal=',$de);           
         }
        
        $this->db->from('tramitar');       
        $this->db->select('tramitar.*, parecer.id as parecer_id');
        $this->db->select('tramitar.*, parecer.direcoes_id as local_direcoes_id');
        $this->db->select('tramitar.*, parecer.departamentos_id as local_departamentos_id');
        $this->db->select('tramitar.*, parecer.reparticoes_id as local_reparticoes_id');
        $this->db->select('tramitar.*, parecer.data_parecer as data_parecer');
        $this->db->select('tramitar.*, parecer.estadoPar2 as estadoPar2');
        $this->db->select('tramitar.*, parecer.estadoDes as estadoDes2');
        $this->db->select('tramitar.*, correspondencias.numCorrespondencia as correspondencias');
        $this->db->select('tramitar.*, correspondencias.assunto as assunto');
        $this->db->select('tramitar.*, correspondencias.refRec as refRec');
        $this->db->select('tramitar.*, correspondencias.tipo_pro as tipo_pro');
        $this->db->select('tramitar.*, correspondencias.date as date');
        $this->db->select('tramitar.*, correspondencias.url as url');
        
        $this->db->order_by("id","DESC");
        $this->db->limit($perpage,$start);
        $this->db->join('parecer', 'parecer.tramitar_id = tramitar.id', 'left');
        $this->db->join('correspondencias', 'correspondencias.id = tramitar.correspondencias_id', 'left');
        
  
       $query = $this->db->get();
        
       $result =  !$one  ? $query->result() : $query->row();
       return $result;


        
    }



    
}



/* End of file arquivos_model.php */
/* Location: ./application/models/arquivos_model.php */