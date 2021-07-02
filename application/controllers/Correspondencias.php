<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correspondencias extends CI_Controller {

    /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */

    public function __construct(){
        parent::__construct();

        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        $this->load->helper(array('codegen_helper'));
        $this->load->model('Geral_model','',TRUE);
        $this->load->model('Direcoes_model','',TRUE);
        $this->load->model('Departamentos_model','',TRUE);
        $this->load->model('Reparticoes_model','',TRUE);
        $this->load->model('Correspondencias_model','',TRUE);
        $this->load->model('Usuarios_model','',TRUE);
        $this->load->model('Classificador_model','',TRUE);
        $this->load->model('Pendente_model','',TRUE);
        $this->load->model('Tipo_doc_model','',TRUE);
        $this->load->model('sigdoc_model','',TRUE);
        $this->load->model('pro_externa_model','',TRUE);
        $this->data['menuCorrespondencias'] = 'correspondencias';
        
    }

     public function index(){
     $this->gerenciar();
     }

    public function gerenciar(){


    if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Correspondência.');
           redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){    
       
        $this->data['results'] = $this->Correspondencias_model->get($this->uri->segment(3));
        $this->data['resultsDespacho']=$this->Correspondencias_model->getDespacho('despacho','*','',$this->uri->segment(3));            
        
        }
        else{


        $this->data['results'] = $this->Correspondencias_model->search($pesquisa, $de, $ate);
        }
        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');
        $this->data['departamentos'] = $this->Departamentos_model->getActive('departamentos','*');
        $this->data['reparticoes'] = $this->Reparticoes_model->getActive('reparticoes','*');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','*');         
        $this->data['tipodoc'] = $this->Tipo_doc_model->getActive('tipo_doc','*');

        $this->data['view'] = 'correspondencias/correspondencias';
        $this->load->view('tema/topo',$this->data);
  }

      public function adicionar() {
        //Permissão de adicionar

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar Correspondência.');
          redirect(base_url());
        }     

        //Validacao dos campos do formulario
            $this->load->library('form_validation');
            $this->data['custom_error'] = '';
            $this->form_validation->set_rules('tipo_pro', '', 'trim|required');
            $this->form_validation->set_rules('classificacao_id', 'Classicação da Correspondência', 'trim|required');


        //Variaveis Globais
            //Localização do usuario logado
            $local_direcoes = $this->session->userdata('local_direcoes');
            $local_departamentos=$this->input->post('local_departamentos_id'); 
            $local_reparticoes=$this->input->post('local_reparticoes_id');

            //Envia dados de numero de correspodencia por sector para o formulario adicionar
            $this->data['nrCorreSector']=$this->Correspondencias_model->getNrCorreSector($local_direcoes); 

        //ID e Nome selecionado 

            $direcoes = $this->input->post('direcoes');
            $abrevdirecoes=$this->Correspondencias_model->getDirecoes2($direcoes);

            $departamentos = $this->input->post('departamentos');
            $abrevDepartamentos=$this->Correspondencias_model->getDepartamentos2($departamentos);

            $reparticoes = $this->input->post('reparticoes');
            $abrevReparticoes=$this->Correspondencias_model->getReparticoes2($reparticoes);

            $pro_externa = $this->input->post('pro_externa_id');
            $abrevPro_externa=$this->Correspondencias_model->getPro_externa($pro_externa);

            $tipo_doc = $this->input->post('tipo_doc');
            $tipo_doc2 = $this->Correspondencias_model->getTipo_doc($tipo_doc);

            $classificacao = $this->input->post('classificacao_id');
            $classificacao = $this->Correspondencias_model->getClassificacao($classificacao);


            if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
             } 
        else {     
            $arquivo = $this->do_upload();
            $file = $arquivo['file_name'];
            $path = $arquivo['full_path'];
            $url = base_url().'assets/correspondencias/'.date('d-m-Y').'/'.$file;
            $tamanho = $arquivo['file_size'];
            $tipo = $arquivo['file_ext'];

            date_default_timezone_set("Africa/Maputo");  

                  //Proviniencia externa resolveçao do erro array
                    if ($pro_externa>0 ) {

                        $abrevPro_externa=$this->Correspondencias_model->getPro_externa($pro_externa);
                    }
                    elseif ($direcoes>0) {
                        $abrevdirecoes=$this->Correspondencias_model->getDirecoes2($direcoes);
                    }
                    else{
                       //$abrevPro_externa=$this->Correspondencias_model->getPro_externa(1); 
                        $abrevPro_externa=null;
                       ;
                    }                           




                    if ($direcoes<>"" and $departamentos=="" and $reparticoes=="") {
                        $proviniencia = $abrevdirecoes;
                    }
                    else if ($direcoes<>"" and $departamentos<>"" and $reparticoes=="") {
                        $proviniencia = $abrevdirecoes.'/'.$abrevDepartamentos;
                    }
                    else if ($direcoes<>"" and $departamentos<>"" and $reparticoes<>"") {
                        $proviniencia = $abrevdirecoes.'/'.$abrevDepartamentos.'/'.$abrevReparticoes; 
                    }
                    //Proviniencia Externa
                     else if ($direcoes=="" and $departamentos=="" and $reparticoes=="") {
                        $proviniencia = $abrevPro_externa;
                    }

                    $ano1=date('Y');
                    $ano=$ano1[2].$ano1[3];

                    //valor de correspondencia com referencia e sem
                    $cRef=$this->input->post('cRef');
                    $sRef=$this->input->post('sRef');
                     if ($sRef) {
                         $refProv=$sRef;
                     }
                    elseif ($cRef) {
                       $refProv=$cRef;  
                    }

            //Criacao do codigo da correspondencia
            $numCorrespondencia=$tipo_doc2.' Nº '.$refProv.'/'.$proviniencia.'/'.$ano;

            //Ultimo id da correspondencia
            $id=$this->Correspondencias_model->getId()+1;
          

           $direcoes_local=$this->input->post('local_direcoes_id');         
                
            $data = array(
                'numCorrespondencia'=>$numCorrespondencia, 
                'tipo_pro' => $this->input->post('tipo_pro'), 
                'pro_direcoes_id' => $this->input->post('direcoes'),
                'pro_departamentos_id' => $this->input->post('departamentos'),
                'pro_reparticoes_id' => $this->input->post('reparticoes'),
                'pro_externa_id' => $this->input->post('pro_externa_id'),            
                'categorias_id' => $this->input->post('categorias'),
                'tipo_doc_id' => $this->input->post('tipo_doc'),
                'refProv' => $refProv,
                'refRec' =>  $this->input->post('refRec'),
                'classificacao_id' => $this->input->post('classificacao_id'),
                'assunto' => $this->input->post('assunto'),
                'prioridades_id' => $this->input->post('prioridades'),
                'destinatario' => $this->input->post('destinatarios'),
                'observacao' => $this->input->post('observacao'),
                'usuarios_id' => $this->input->post('usuarios'),             
                'local_direcoes_id' => $this->input->post('local_direcoes_id'),             
                'local_departamentos_id' => $this->input->post('local_departamentos_id'),             
                'local_reparticoes_id' => $this->input->post('local_reparticoes_id'),  
                'file' => $file,
                'path' => $path,
                'url' => $url,           
                'data_normal' =>date('Y-m-d'),
                'date' => date('Y-m-d H:i:s')                
            );
           
//Proviniencia externa resolveçao do erro array
    if ($abrevPro_externa== null) {
        $this->session->set_flashdata('error','Selecione Proviniência Externa listada. Click <b><a href="javascript:window.history.go(-1)">aqui</b></a> para recuperar os dados introduzidos!');
        redirect(base_url() . 'index.php/correspondencias/adicionar?r=1');
        //exit();
    }
     if ($this->Correspondencias_model->add('correspondencias',$data,$numCorrespondencia,$refRec) == TRUE ) {
                    $this->session->set_flashdata('success','Correspondencia '.$numCorrespondencia.' adicionado com sucesso!');
                    redirect(base_url() . 'index.php/correspondencias/adicionar/');
                } 
     //Trabalhar nos erros            
        else if($this->Correspondencias_model->add('correspondencias',$data,$numCorrespondencia,$refRec) == FALSE ) {
        $this->session->set_flashdata('error','A Correspondência <b>'.$numCorrespondencia.'</b> já existe no Sistema!'); 
                }
        }
        

        $this->data['tipoDoc'] = $this->Geral_model->getActive('tipo_doc','*');

        $this->data['categorias'] = $this->Geral_model->getActive('categorias','*');

        $this->data['direcoes'] = $this->Geral_model->getActive('direcoes','*');

        $this->data['codigo'] = $this->Classificador_model->getActive('classificacao','*');

        $this->data['prioridades'] = $this->Geral_model->getActive('prioridades','*');
        
        $this->data['ultimoId']=$this->Correspondencias_model->getId();

        

        $this->data['view'] = 'correspondencias/adicionarOstensivo';
        $this->load->view('tema/topo', $this->data);

    }


    public function adicionarSigiloso() {
     if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar Correspondência.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('categorias', '', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } 
        else {           
            $data=$this->input->post('data');
            date_default_timezone_set("Africa/Maputo"); 

            if($data == null){
                $data = date('Y-m-d H:i:s');               
            }
            else{
                $data = explode('/',$data);
                $data = $data[2].'-'.$data[1].'-'.$data[0];
            }

    $direcoes = $this->input->post('direcoes');
    $abrevdirecoes=$this->Correspondencias_model->getDirecoes2($direcoes);

    $departamentos = $this->input->post('departamentos');
    $abrevDepartamentos=$this->Correspondencias_model->getDepartamentos2($departamentos);

    $reparticoes = $this->input->post('reparticoes');
    $abrevReparticoes=$this->Correspondencias_model->getReparticoes2($reparticoes);

    $pro_externa = $this->input->post('pro_externa_id');
    $abrevPro_externa=$this->Correspondencias_model->getPro_externa($pro_externa);

 if ($direcoes<>"" and $departamentos=="" and $reparticoes=="") {
                $proviniencia = $abrevdirecoes;

            }
 else if ($direcoes<>"" and $departamentos<>"" and $reparticoes=="") {
                $proviniencia = $abrevdirecoes.'/'.$abrevDepartamentos;
            }
 else if ($direcoes<>"" and $departamentos<>"" and $reparticoes<>"") {
                $proviniencia = $abrevdirecoes.'/'.$abrevDepartamentos.'/'.$abrevReparticoes; 
            }
            //Proviniencia Externa
 else if ($direcoes=="" and $departamentos=="" and $reparticoes=="") {
                $proviniencia = $abrevPro_externa;
            }



 $ano1=date('Y');  $ano=$ano1[2].$ano1[3]; 
  $id=$this->Correspondencias_model->lastId()+1;

           
    $numCorrespondencia='sigiloso Nº '.$id.'/'.$proviniencia.'/'.$ano;

    $data = array( 
    'numCorrespondencia'=>$numCorrespondencia,               
    'tipo_pro' => $this->input->post('tipo_pro'), 
    'categorias_id' => $this->input->post('categorias'),
    'pro_direcoes_id' => $this->input->post('direcoes'),
    'pro_departamentos_id' => $this->input->post('departamentos'),
    'pro_reparticoes_id' => $this->input->post('reparticoes'),
    'pro_externa_id' => $this->input->post('pro_externa_id'),            
    'nivel_conf_id' => $this->input->post('nivel_conf'),               
    'observacao' => $this->input->post('observacao'),
    'destinatarios_id'=>$this->input->post('idDestinatario'),
    'local_direcoes_id'=>$this->input->post('local_direcoes_id'),
    'local_departamentos_id'=>$this->input->post('local_departamentos_id'),
    'local_reparticoes_id'=>$this->input->post('local_reparticoes_id'),
    'usuarios_id' => $this->input->post('usuarios'),
    'data_normal' =>date('Y-m-d'),
    'date' => $data                
        );
    if ($this->Correspondencias_model->addSigiloso('corre_sigiloso', $data) == TRUE) {
    $this->session->set_flashdata('success','Correspondencia Sigiloso adicionado com sucesso!');
    redirect(base_url() . 'index.php/correspondencias/adicionarSigiloso/');
            } 
    else {
    $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }           
            
$this->data['categorias'] = $this->Geral_model->getActive('categorias','*');
$this->data['nivel_conf'] = $this->Geral_model->getActive('nivel_conf','*'); 
$this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');
        
$this->data['view'] = 'correspondencias/adicionarSigiloso';
$this->load->view('tema/topo', $this->data);

    }

    public function editar(){
 if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar Correspondência.');
          redirect(base_url());
        }     

        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', '', 'trim|required');
       
        if ($this->form_validation->run('') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">'.validation_errors().'</div>' : false);

        } else
        { 
                $data = array(
                    'nome' => set_value('nome'),
                    'abreviatura' => set_value('abreviatura'),
                    'email' => set_value('email'),
                    'responsavel' => set_value('responsavel'),
                    'direcoes_id' => set_value('direcoes'),
                    'departamentos_id' => set_value('departamentos'),
                    'data_alteracao' => date('Y-m-d')
                );             

           
            if ($this->Reparticoes_model->edit('reparticoes',$data,'id',$this->input->post('id')) == TRUE)
            {
                $this->session->set_flashdata('success','Correspondência editada com sucesso!');
                redirect(base_url().'index.php/correspondencias/editar/'.$this->input->post('id'));
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        } 

        $this->data['result'] = $this->Correspondencias_model->getById($this->uri->segment(3));

        $this->data['tipoDoc'] = $this->Geral_model->getActive('tipo_doc','*');

        $this->data['categorias'] = $this->Geral_model->getActive('categorias','*');

        $this->data['direcoes'] = $this->Geral_model->getActive('direcoes','*');

        $this->data['codigo'] = $this->Classificador_model->getActive('classificacao','*');

        $this->data['prioridades'] = $this->Geral_model->getActive('prioridades','*');
        
        $this->data['ultimoId']=$this->Correspondencias_model->getId();


        $this->data['view'] = 'correspondencias/editar';
        $this->load->view('tema/topo',$this->data);
    }


    public function visualizar(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
         $this->session->set_flashdata('error','Você não tem permissão para visualizar Correspondência.');
          redirect(base_url());
        }

        $this->data['custom_error'] = '';
       
        $this->data['result'] = $this->Correspondencias_model->getById2($this->uri->segment(3));
        $this->data['result2'] = $this->Correspondencias_model->getById3($this->uri->segment(3));
        $this->data['emitente'] = $this->sigdoc_model->getEmitente();
        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');
        
        $this->data['view'] = 'correspondencias/visualizar';
        $this->load->view('tema/topo', $this->data);
       
    }

    public function tra_par(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
         $this->session->set_flashdata('error','Você não tem permissão para visualizar Correspondência.');
          redirect(base_url());
        }

        $this->data['custom_error'] = '';
       
        $this->data['result'] = $this->Correspondencias_model->getById2($this->uri->segment(3));
        $this->data['emitente'] = $this->sigdoc_model->getEmitente();
         $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');
        
        $this->data['view'] = 'correspondencias/tra_par';
        $this->load->view('tema/topo', $this->data);
       
    }

    public function tramitar(){
        $data_tramitar = $this->input->post('data');
        
        
        date_default_timezone_set("Africa/Maputo"); 

            if($data_tramitar == null){

                $data_tramitar = date('Y-m-d H:i:s');
               
            }
            else{
                $data_tramitar = explode('/',$data_tramitar);
                $data_tramitar = $data_tramitar[2].'-'.$data_tramitar[1].'-'.$data_tramitar[0];
            }

        $data2 = array( 'estadoTra' => 1); 
        $id=$this->input->post('correspondencias_id');                     
                             
                

// if (($this->Correspondencias_model->addTramite($_POST,$data_tramitar)== TRUE) and ($this->Correspondencias_model->edit('correspondencias', $data2, 'id', $id)== TRUE)) {
$result1=$this->Correspondencias_model->addTramite($_POST,$data_tramitar,$id);
$result2=$this->Correspondencias_model->edit('correspondencias', $data2, 'id', $id);
 if ($result1==TRUE) {

                echo TRUE;
            }
            else{
                echo FALSE;
            }
            exit;

    }

public function parecer(){
         if(!$this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para parecer Correspondência.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';


        $this->form_validation->set_rules('direcoes', '', 'trim|required');     


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
           //id das correspondencia a tramiar
            $id = $this->input->post('tramitar_id');
            $idCorre = $this->input->post('correspondencias_id');

            date_default_timezone_set("Africa/Maputo"); 

            if($data_parecer == null){

                $data_parecer = date('Y-m-d H:i:s');
               
            }
            else{
                $data_parecer = explode('/',$data_parecer);
                $data_parecer = $data_parecer[2].'-'.$data_parecer[1].'-'.$data_parecer[0];
            }
            
            $direcoes = $this->input->post('direcoes');
            $departamentos = $this->input->post('departamentos');
            $reparticoes = $this->input->post('reparticoes');

            $local_direcoes=$this->input->post('local_direcoes_id');
            $local_departamentos=$this->input->post('local_departamentos_id');
            $local_reparticoes=$this->input->post('local_reparticoes_id');


            if ($direcoes<>"" and $departamentos=="" and $reparticoes=="") {
                $departamentos = 0;
                $reparticoes = 0;
            }
            else if ($direcoes<>"" and $departamentos<>"" and $reparticoes=="") {
                $reparticoes = 0;
                
            }

            if ($local_direcoes<>"" and $local_departamentos=="" and $local_reparticoes=="") {
                $local_departamentos = 0;
                $local_reparticoes = 0;
            }
            else if ($local_direcoes<>"" and $local_departamentos<>"" and $local_reparticoes=="") {
                $local_reparticoes = 0;
                
            }
            
                       
            // $direcoes = $this->input->post('direcoes');
            // $abrevdirecoes=$this->Correspondencias_model->getDirecoes2($direcoes);


            // $departamentos = $this->input->post('departamentos');
            // $abrevDepartamentos=$this->Correspondencias_model->getDepartamentos2($departamentos);

            // $reparticoes = $this->input->post('reparticoes');
            // $abrevReparticoes=$this->Correspondencias_model->getReparticoes2($reparticoes);

            // if ($direcoes<>"" and $departamentos=="" and $reparticoes=="") {
            //     $destino = $abrevdirecoes;
            // }
            // else if ($direcoes<>"" and $departamentos<>"" and $reparticoes=="") {
            //     $destino = $abrevdirecoes.'/'.$abrevDepartamentos;
            // }
            // else if ($direcoes<>"" and $departamentos<>"" and $reparticoes<>"") {
            //     $destino = $abrevdirecoes.'/'.$abrevDepartamentos.'/'.$abrevReparticoes; 
            // }

            
             $data = array(                
                'tramitar_id' => $id,
               // 'correspondencias_id' => $idCorre,
                'direcoes_id' => $this->input->post('direcoes'),
                'departamentos_id' =>$departamentos,
                'reparticoes_id' => $reparticoes,
                'parecer' => $this->input->post('parecer'),
                'data_parecer' => $data_parecer,
                'local_direcoes_id' => $this->input->post('local_direcoes_id'),             
                'local_departamentos_id' => $local_departamentos,             
                'local_reparticoes_id' => $local_reparticoes,             
                'usuarios_id' => $this->input->post('usuarios')
                );

            $data2 = array('estadoPar' =>1);
                
                

            if (($this->Correspondencias_model->addParecer('parecer', $data)== TRUE) and ($this->Correspondencias_model->edit('tramitar',$data2, 'id', $id)== TRUE)) {
               // $this->sendMail();
                
                $this->session->set_flashdata('success','Parecer efeituado com Sucesso!');
                redirect(base_url() . 'index.php/correspondencias/recebida');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        
        
        $this->data['view'] = 'correspondencias/recebida';
        $this->load->view('tema/topo', $this->data);


    }

    public function parecer2(){
         if(!$this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para parecer Correspondência.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';


        $this->form_validation->set_rules('direcoes', '', 'trim|required');     


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
           //id das correspondencia a tramiar
            $idTramitar = $this->input->post('tramitar_id');
            $idParecer = $this->input->post('parecer_id');

            date_default_timezone_set("Africa/Maputo"); 

            if($data_parecer == null){

                $data_parecer = date('Y-m-d H:i:s');
               
            }
            else{
                $data_parecer = explode('/',$data_parecer);
                $data_parecer = $data_parecer[2].'-'.$data_parecer[1].'-'.$data_parecer[0];
            }

            $direcoes = $this->input->post('direcoes');
            $departamentos = $this->input->post('departamentos');
            $reparticoes = $this->input->post('reparticoes');


            if ($direcoes<>"" and $departamentos=="" and $reparticoes=="") {
                $departamentos = 0;
                $reparticoes = 0;
            }
            else if ($direcoes<>"" and $departamentos<>"" and $reparticoes=="") {
                $reparticoes = 0;
                
            }
            

            
             $data = array(                
                'tramitar_id' => $idTramitar,
                //'correspondencias_id' => $this->input->post('correspondencias_id'),
                'direcoes_id' => $this->input->post('direcoes'),
                'departamentos_id' => $departamentos,
                'reparticoes_id' => $reparticoes,
                'parecer' => $this->input->post('parecer'),
                'data_parecer' => $data_parecer,
                'local_direcoes_id' => $this->input->post('local_direcoes_id'),             
                'local_departamentos_id' => $this->input->post('local_departamentos_id'),             
                'local_reparticoes_id' => $this->input->post('local_reparticoes_id'),
                'usuarios_id' => $this->input->post('usuarios')
                );

            $data2 = array('estadoPar2' =>1);
                
                

            if (($this->Correspondencias_model->addParecer('parecer', $data)== TRUE) and ($this->Correspondencias_model->edit('parecer',$data2, 'id', $idParecer)== TRUE)) {
               // $this->sendMail();
                
                $this->session->set_flashdata('success','Parecer efeituado com Sucesso!');
                redirect(base_url() . 'index.php/correspondencias/recebida');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }        
        
        $this->data['view'] = 'correspondencias/recebida';
        $this->load->view('tema/topo', $this->data);


    }

    public function despacho(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'despCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para visualizar Despachos.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('correspondencias_id', '', 'trim|required');
        $this->form_validation->set_rules('observacao', '', 'trim|required');     


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            // $arquivo = $this->do_upload();
            // $file = $arquivo['file_name'];
            // $path = $arquivo['full_path'];
            // $url = base_url().'assets/correspondencias/'.date('d-m-Y').'/'.$file;
            // $tamanho = $arquivo['file_size'];
            // $tipo = $arquivo['file_ext'];

            //id das correspondencia a despachar
            $idCorrespondencias = $this->input->post('correspondencias_id');
            $idTramitar = $this->input->post('tramitar_id');
            $idParecer = $this->input->post('parecer_id');
            

           date_default_timezone_set("Africa/Maputo"); 

            if($data_despacho == null){

                $data_despacho = date('Y-m-d H:i:s');
               
            }
            else{
                $data_despacho = explode('/',$data_despacho);
                $data_despacho = $data_despacho[2].'-'.$data_despacho[1].'-'.$data_despacho[0];
            }

              if (!empty($this->input->post('tirarCopias')) and !empty($this->input->post('tirarFotocopias'))) {
                 $tirarCopias=$this->input->post('tirarCopias').' Copias';
                 $tirarFotocopias=$this->input->post('tirarFotocopias').' Fotocopias';                 
              }
              else if (!empty($this->input->post('tirarCopias'))) {
                 $tirarFotocopias=$this->input->post('tirarCopias').' Copias';
              }
              else if (!empty($this->input->post('tirarFotocopias'))) {
                 $tirarFotocopias=$this->input->post('tirarFotocopias').' Fotocopias';
              }
               else {
                 $tirarFotocopias=null;
                 $tirarCopias=null;
              }

             $data = array(
                'tramitar_id'=>$idTramitar,
                'parecer_id'=>$idParecer,
                'correspondencias_id'=>$idCorrespondencias,
                'direcoes_id'=>$this->input->post('direcoes_id'),
                'departamentos_id'=>$this->input->post('departamentos_id'),
                'reparticoes_id'=>$this->input->post('reparticoes_id'),
                'data_despacho'=>$data_despacho,
                'usuarios_id'=>$this->input->post('usuarios'),
                'darSeguimento' =>$this->input->post('darSeguimento'), 
                'aguardarInstrucoes' =>$this->input->post('aguardarInstrucoes'), 
                'prepararCarta' =>$this->input->post('prepararCarta'),
                'apreciar' =>$this->input->post('apreciar'),
                'devolver' =>$this->input->post('devolver'), 
                'prepararResposta' =>$this->input->post('prepararResposta'),
                'aprovar' =>$this->input->post('aprovar'),
                'esclarecer' =>$this->input->post('esclarecer'), 
                'providenciar' =>$this->input->post('providenciar'),
                'arquivar' =>$this->input->post('arquivar'),
                'enviarProcesso' =>$this->input->post('enviarProcesso'), 
                'reter' =>$this->input->post('reter'),
                'assinar' =>$this->input->post('assinar'),
                'estudar' =>$this->input->post('estudar'), 
                'tirarCopias' =>$tirarCopias,
                'autorizar' =>$this->input->post('autorizar'),
                'falarComigo' =>$this->input->post('falarComigo'), 
                'tirarFotocopias' =>$tirarFotocopias,
                'conferir' =>$this->input->post('conferir'),
                'habilitar' =>$this->input->post('habilitar'), 
                'tomarConhecimento' =>$this->input->post('tomarConhecimento'),
                'confirmar' =>$this->input->post('confirmar'),
                'informar' =>$this->input->post('informar'), 
                'traduzir' =>$this->input->post('traduzir'),
                'corrigir' =>$this->input->post('corrigir'),
                'reuniao' =>$this->input->post('reuniao'),
                'voltarProcesso' =>$this->input->post('voltarProcesso'),
                'darParecer' =>$this->input->post('darParecer'),
                'visar' =>$this->input->post('visar'),
                'dactilografar' =>$this->input->post('dactilografar'), 
                'juntarProcesso' =>$this->input->post('juntarProcesso'),
                'passarAoSr' =>$this->input->post('passarAoSr'), 
                // 'file' => $file,
                // 'path' => $path,
                // 'url' => $url,              
                'observacao'=>$this->input->post('observacao')              
                
             );
             $data2 = array('estadoDes' => 1);                               
                
         if (empty($idParecer)) {
                if (($this->Correspondencias_model->addDespacho('despacho', $data)== TRUE) and ($this->Correspondencias_model->edit('tramitar', $data2, 'id', $idTramitar)== TRUE) and ($this->Correspondencias_model->edit('correspondencias', $data2, 'id', $idCorrespondencias)== TRUE)) {
                $this->session->set_flashdata('success','Despacho efectuar com Sucesso!');
                redirect(base_url() . 'index.php/correspondencias/recebida');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
         } else {
              if (($this->Correspondencias_model->addDespacho('despacho', $data)== TRUE) and ($this->Correspondencias_model->edit('parecer', $data2, 'id', $idParecer)== TRUE) and ($this->Correspondencias_model->edit('correspondencias', $data2, 'id', $idCorrespondencias)== TRUE)) {
                $this->session->set_flashdata('success','Despacho efectuar com Sucesso!');
                redirect(base_url() . 'index.php/correspondencias/recebida');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
         }
         
        }
        
        $this->data['view'] = 'correspondencias/recebida';
        $this->load->view('tema/topo', $this->data);

    }

    public function estadosOstensivo(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Correspondencia.');
           redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){            
                       
            $this->data['results'] = $this->Correspondencias_model->getRastreio($this->uri->segment(3));                   
        }
        else{            

            $this->data['results'] = $this->Correspondencias_model->search($pesquisa, $de, $ate);
        }

        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');        
        $this->data['departamentos'] = $this->Departamentos_model->getActive('departamentos','*');       
        $this->data['reparticoes'] = $this->Reparticoes_model->getActive('reparticoes','*');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','*');

        $this->data['view'] = 'correspondencias/estadosOstensivo';
        $this->load->view('tema/topo',$this->data);
    }

     public function recebida(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar correspondencias.');
           redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){    
            
        $this->data['resultsTra'] = $this->Correspondencias_model->getTramitar($this->uri->segment(3));
        $this->data['resultsPar'] = $this->Correspondencias_model->getParecer($this->uri->segment(3)); 
        }
        else{

           $this->data['resultsTra'] = $this->Correspondencias_model->search_recebida_tra($pesquisa, $de, $ate);
            $this->data['resultsPar'] = $this->Correspondencias_model->search_recebida_par($pesquisa, $de, $ate);
            
        }

        $this->data['resultDir'] = $this->Direcoes_model->getActive('direcoes','*');

        $this->data['resultDep'] = $this->Departamentos_model->getActive('departamentos','*');

        $this->data['resultRep'] = $this->Reparticoes_model->getActive('reparticoes','*');

        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','*');

        $this->data['view'] = 'correspondencias/recebida';
        $this->load->view('tema/topo',$this->data);
    }




    public function listaSigiloso(){

    if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Correspondência.');
           redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){    
       
        $this->data['results'] = $this->Correspondencias_model->get_sigiloso($this->uri->segment(3));
                   
        
        }
        else{

        $this->data['results'] = $this->Correspondencias_model->search_sigiloso($pesquisa, $de, $ate);
        }
        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');
        $this->data['departamentos'] = $this->Departamentos_model->getActive('departamentos','*');
        $this->data['reparticoes'] = $this->Reparticoes_model->getActive('reparticoes','*');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','*');         
        $this->data['tipodoc'] = $this->Tipo_doc_model->getActive('tipo_doc','*');

       

        $this->data['view'] = 'correspondencias/listaSigiloso';
        $this->load->view('tema/topo',$this->data);
    }

    public function estadosDespacho(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar correspondencias.');
           redirect(base_url());
        }

       

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){    
            
           // $this->data['results'] = $this->Correspondencias_model->get('correspondencias','*','',$this->uri->segment(3));
             $this->data['results'] = $this->Correspondencias_model->getEstadosDespacho($this->uri->segment(3));

            
        
        }
        else{

            if($de != null){

                $de = explode('/', $de);
                $de = $de[2].'-'.$de[1].'-'.$de[0];

                if($ate != null){
                    $ate = explode('/', $ate);
                    $ate = $ate[2].'-'.$ate[1].'-'.$ate[0]; 
                }
                else{
                    $ate = $de;
                }
            }

            $this->data['results'] = $this->Correspondencias_model->search($pesquisa, $de, $ate);
        }

        
        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');
      
        $this->data['departamentos'] = $this->Departamentos_model->getActive('departamentos','*');

        $this->data['reparticoes'] = $this->Reparticoes_model->getActive('reparticoes','*');

        $this->load->model('Usuarios_model');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','*');

        $this->data['view'] = 'correspondencias/despacho';
        $this->load->view('tema/topo',$this->data);
    }

   public function pendente(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar correspondencias.');
           redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){    
            
            $this->data['resultsTra'] = $this->Correspondencias_model->getPendenteTra($this->uri->segment(3));

             $this->data['resultsPar'] = $this->Correspondencias_model->getPendentePar($this->uri->segment(3));

            
        
        }
        else{

            if($de != null){

                $de = explode('/', $de);
                $de = $de[2].'-'.$de[1].'-'.$de[0];

                if($ate != null){
                    $ate = explode('/', $ate);
                    $ate = $ate[2].'-'.$ate[1].'-'.$ate[0]; 
                }
                else{
                    $ate = $de;
                }
            }

        $this->data['results'] = $this->Correspondencias_model->search($pesquisa, $de, $ate);
        }

        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');

        $this->data['departamento'] = $this->Departamentos_model->getActive('departamentos','*');

        $this->data['reparticao'] = $this->Reparticoes_model->getActive('reparticoes','*');

        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','*');

        $this->data['view'] = 'correspondencias/pendente';
        $this->load->view('tema/topo',$this->data);
    }

        


      
    


     function pro_externa(){  
          
        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';

        //Validacao dos campos do formulario
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';


        //Variaveis Globais
            //Localização do usuario logado
            $local_direcoes = $this->session->userdata('local_direcoes');
            $local_departamentos=$this->input->post('local_departamentos_id'); 
            $local_reparticoes=$this->input->post('local_reparticoes_id');

            //Envia dados de numero de correspodencia por sector para o formulario adicionar
            $this->data['nrCorreSector']=$this->Correspondencias_model->getNrCorreSector($local_direcoes);

        if ($this->form_validation->run('pro_externa') == false)
        {
             $this->session->set_flashdata('error','A proviniencia já existe no sistema!');
                redirect(base_url().'index.php/correspondencias/adicionar');

        } else
        { 
            $data = $this->input->post('data');

            if($data == null){
                $data = date('Y-m-d');
            }
            else{
                $data = explode('/',$data);
                $data = $data[2].'-'.$data[1].'-'.$data[0];
            }
            
          $data = array(
                    'nome' => set_value('nome'),
                    'abreviatura' => set_value('abreviatura'),
                    'email' => set_value('email'),
                    'contacto' => set_value('contacto'),
                    'endereco' => set_value('endereco'),
                    'data_criacao' => $data
        
            );
           
            if ($this->pro_externa_model->add('pro_externa',$data) == TRUE)
            {
                $this->session->set_flashdata('success','Proviniencia Externa cadastrada com sucesso!');
                redirect(base_url().'index.php/correspondencias/adicionar');

            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

            }
        }
        

         $this->load->model('pro_externa_model');
         $this->data['provinienciaexterna'] = $this->pro_externa_model->getActive('pro_externa','*');
        $this->data['tipoDoc'] = $this->Geral_model->getActive('tipo_doc','*');

        $this->data['categorias'] = $this->Geral_model->getActive('categorias','*');

        $this->data['direcoes'] = $this->Geral_model->getActive('direcoes','*');

        $this->data['codigo'] = $this->Classificador_model->getActive('classificacao','*');

        $this->data['prioridades'] = $this->Geral_model->getActive('prioridades','*');
        
        $this->data['ultimoId']=$this->Correspondencias_model->getId();

       $this->data['view'] = 'correspondencias/adicionarOstensivo';
       $this->load->view('tema/topo',$this->data);
   
       
    }
     

    public function pareceres_feitos(){
        //  if(!$this->permission->checkPermission($this->session->userdata('permissao'),'tCorrespondencia')){
        //   $this->session->set_flashdata('error','Você não tem permissão para tramitar Correspondência.');
        //   redirect(base_url());
        // }

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){    
            
        
        $this->data['resultsPar'] = $this->Correspondencias_model->getParecerFeitos(); 
        }
        else{

        $this->data['resultsPar'] = $this->Correspondencias_model->search_pareceres_feitos($pesquisa, $de, $ate);
                
        }

        $this->data['resultDir'] = $this->Direcoes_model->getActive('direcoes','*');

        $this->data['resultDep'] = $this->Departamentos_model->getActive('departamentos','*');

        $this->data['resultRep'] = $this->Reparticoes_model->getActive('reparticoes','*');

        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','*');

        $this->data['view'] = 'correspondencias/pareceres_feitos';
        $this->load->view('tema/topo',$this->data);


    }

    public function despachos_feitos(){
        //  if(!$this->permission->checkPermission($this->session->userdata('permissao'),'tCorrespondencia')){
        //   $this->session->set_flashdata('error','Você não tem permissão para tramitar Correspondência.');
        //   redirect(base_url());
        // }

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){    
            
        
        $this->data['resultsDes'] = $this->Correspondencias_model->getDespachoFeitos(); 
        }
        else{

        $this->data['resultsDes'] = $this->Correspondencias_model->search_despachos_feitos($pesquisa, $de, $ate);
                
        }


        $this->data['resultDir'] = $this->Direcoes_model->getActive('direcoes','*');

        $this->data['resultDep'] = $this->Departamentos_model->getActive('departamentos','*');

        $this->data['resultRep'] = $this->Reparticoes_model->getActive('reparticoes','*');

        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','*');

        $this->data['view'] = 'correspondencias/despachos_feitos';
        $this->load->view('tema/topo',$this->data);


    }

    public function visualizar_meus_pareceres(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('sigdoc');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'estDespacho')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar .');
           redirect(base_url());
        }

       $this->data['custom_error'] = '';
       $this->data['result'] = $this->Correspondencias_model->getById($this->uri->segment(3));
       $this->data['resultTra'] = $this->Correspondencias_model->historicoTramitar();
       $this->data['resultPar'] = $this->Correspondencias_model->historicoParecer(); 
       
        $this->data['view'] = 'correspondencias/visualizar_meus_pareceres';
        $this->load->view('tema/topo', $this->data);

        
    }

    public function visualizar_meus_despachos(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('sigdoc');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'estDespacho')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar .');
           redirect(base_url());
        }

       $this->data['custom_error'] = '';
       $this->data['result'] = $this->Correspondencias_model->getById($this->uri->segment(3));
             $this->data['resultDes1'] = $this->Correspondencias_model->historicoDespacho(); 
       $this->data['resultDes2'] =$this->Correspondencias_model->historicoDespacho2($this->uri->segment(3));
       
       $this->data['view'] = 'correspondencias/visualizar_meus_despachos';
       $this->load->view('tema/topo', $this->data);

        
    }

    public function do_upload(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar correspondencias.');
          redirect(base_url());
        }
    
        $date = date('d-m-Y');

        $config['upload_path'] = './assets/correspondencias/'.$date;
        $config['allowed_types'] = 'txt|jpg|jpeg|gif|png|pdf|PDF|JPG|JPEG|GIF|PNG';
        $config['max_size']     = 0;
        $config['max_width']  = '3000';
        $config['max_height']  = '2000';
        $config['encrypt_name'] = true;


        if (!is_dir('./assets/correspondencias/'.$date)) {

            mkdir('./assets/correspondencias/' . $date, 0777, TRUE);

        }

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            $this->session->set_flashdata('error','Erro ao fazer upload do arquivo, verifique se a extensão do arquivo é permitida.');
            redirect(base_url() . 'index.php/correspondencias/adicionar/');
        }
        else
        {
            //$data = array('upload_data' => $this->upload->data());
            return $this->upload->data();
        }
    }



 
 public function visualizarDespacho(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('sigdoc');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'estDespacho')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar .');
           redirect(base_url());
        }

       $this->data['custom_error'] = '';
       $this->data['result'] = $this->Correspondencias_model->getById($this->uri->segment(3));
       $this->data['resultTra'] = $this->Correspondencias_model->historicoTramitar();
       $this->data['resultPar'] = $this->Correspondencias_model->historicoParecer();
       $this->data['resultDes'] = $this->Correspondencias_model->historicoDespacho(); 
       $this->data['resultDes2'] =$this->Correspondencias_model->historicoDespacho2($this->uri->segment(3)); 
       
        $this->data['view'] = 'correspondencias/visualizarDespacho';
        $this->load->view('tema/topo', $this->data);

        
    }

     public function visualizar_correspondencia(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('sigdoc');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'estDespacho')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar .');
           redirect(base_url());
        }

       $this->data['custom_error'] = '';
       $this->data['result'] = $this->Correspondencias_model->getById($this->uri->segment(3));
      
       
        $this->data['view'] = 'correspondencias/visualizar_inicial';
        $this->load->view('tema/topo', $this->data);

        
    }

     public function visualizar_dados(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('sigdoc');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'estDespacho')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar .');
           redirect(base_url());
        }

       $this->data['custom_error'] = '';
       $this->data['result'] = $this->Correspondencias_model->getById($this->uri->segment(3));
       $this->data['resultTra'] = $this->Correspondencias_model->historicoTramitar();
       $this->data['resultPar'] = $this->Correspondencias_model->historicoParecer();
       $this->data['resultDes'] = $this->Correspondencias_model->historicoDespacho(); 
       $this->data['resultDes2'] =$this->Correspondencias_model->historicoDespacho2($this->uri->segment(3)); 
       
        $this->data['view'] = 'correspondencias/visualizar_dados';
        $this->load->view('tema/topo', $this->data);

        
    }

public function autoClassificador(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
         $teste=$this->Correspondencias_model->autoClassificador($q);
        }
        

    }

public function autoCompleteProvinienciaExterna(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
         $teste=$this->Correspondencias_model->autoCompleteProvinienciaExterna($q);
        }
        

    }

public function autoCompleteDestinatario(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
         $teste=$this->Correspondencias_model->autoCompleteDestinatario($q);
        }
        

    }

public function autoCompleteUsuarios(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
         $teste=$this->Correspondencias_model->autoCompleteUsuarios($q);
        }
        

    }

public function dirDep() {
        //pega o id selecionado
        $id = $this->input->post('direcoes');        
        
        if($id){
           
            $departamentos = $this->Correspondencias_model->getDepartamentos($id);
            echo '<option value="">Selecione Departamento</option>';
            foreach($departamentos as $dep){
                echo '<option value="'. $dep->id .'">'. $dep->nome .'</option>';
            }
        }  else {
        
            echo '<option value="">Selecione Departamento</option>';
        }

        
    }

    public function depRep() {
        //pega o id selecionado
        $id = $this->input->post('departamentos');        
        
        if($id){
           
            $reparticoes = $this->Correspondencias_model->getReparticoes($id);
            echo '<option value="">Selecione Repartição</option>';
            foreach($reparticoes as $rep){
                echo '<option value="'. $rep->id .'">'. $rep->nome .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Repartição</option>';
        }

        
    }

     

    public function fillCiudadesAdicionar2(){
        $idDepartamento = $this->input->post('idDepartamento');
        if($idDepartamento){
            $this->load->model('Correspondencias_model');
            $reparticao = $this->Correspondencias_model->getCiudades2($idDepartamento);
            echo '<option value="">Selecione Reparticao</option>';
            foreach($reparticao as $fila){
                echo '<option value="'. $fila->idReparticao .'">'. $fila->abrevReparticao .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Reparticao</option>';
        }
    }

 public function fillCiudadesTramite() {
        $iddirecoes = $this->input->post('iddirecoes');
        
        
        if($iddirecoes){
            $this->load->model('Correspondencias_model');
            $departamento = $this->Correspondencias_model->getCiudades($iddirecoes);
            echo '<option value="">Selecione Departamento</option>';
            foreach($departamento as $dep){
                echo '<option value="'. $dep->idDepartamento .'">'. $dep->abrevDepartamento .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Departamento</option>';
        }

        
    }

    public function fillCiudadesTramite2(){
        $idDepartamento = $this->input->post('idDepartamento');
        if($idDepartamento){
            $this->load->model('Correspondencias_model');
            $reparticao = $this->Correspondencias_model->getCiudades2($idDepartamento);
            echo '<option value="">Selecione Reparticao</option>';
            foreach($reparticao as $fila){
                echo '<option value="'. $fila->idReparticao .'">'. $fila->abrevReparticao .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Reparticao</option>';
        }
    }
  
 public function fillCiudadesParecer() {
        $iddirecoes = $this->input->post('iddirecoes2');
        
        
        if($iddirecoes){
            $this->load->model('Correspondencias_model');
            $departamento = $this->Correspondencias_model->getCiudades($iddirecoes);
            echo '<option value="">Selecione Departamento</option>';
            foreach($departamento as $dep){
                echo '<option value="'. $dep->idDepartamento .'">'. $dep->abrevDepartamento .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Departamento</option>';
        }

        
    }

    public function fillCiudadesParecer2(){
        $idDepartamento = $this->input->post('idDepartamento2');
        if($idDepartamento){
            $this->load->model('Correspondencias_model');
            $reparticao = $this->Correspondencias_model->getCiudades2($idDepartamento);
            echo '<option value="">Selecione Reparticao</option>';
            foreach($reparticao as $fila){
                echo '<option value="'. $fila->idReparticao .'">'. $fila->abrevReparticao .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Reparticao</option>';
        }
    }

// public function sendMail()
//     {
//         //Carga a biblioteca email de CI
//         $this->load->library("email");

//         $this->email->from('armandomaviee@gmail.com','Sistema de Gestão de Documentos');
//         $this->email->to("armandomaviee@gmail.com");
//         $this->email->subject('Notificação: Correspondência Urgente Recebida ');
//         $this->email->message('Caro Usuario!  uma Correspondência de prioridade Urgente foi tramitada para sua Dirreção!');


//         for ($i=1; $i <=1 ; $i++) { 
//             if ($this->email->send()) {
//                 echo "Enviado com sucesso";
//             }else{
//                 show_error($this->email->print_debugger());
//             }
//             sleep(1);
//         }
        
//     }


}

/* End of file correspondencias.php */
/* Location: ./application/controllers/correspondencias.php */

//      1/001.2/DPC/17
//      1/001.2/DPC/1
