<?php

class Reparticao extends CI_Controller {
 /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */
    
    function __construct() {

        parent::__construct();
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cUsuario')){
          $this->session->set_flashdata('error','Você não tem permissão para configurar os usuários.');
          redirect(base_url());
        }

        $this->load->helper(array('form', 'codegen_helper'));
         $this->load->model('Direcoes_model','',TRUE);
        $this->load->model('Departamentos_model','',TRUE);
        $this->load->model('Reparticoes_model','',TRUE);
        $this->data['menuDepartamentos'] = 'Departamentos';
        $this->data['menuReparticoes'] = 'Repartições';
        $this->data['menuConfiguracoes'] = 'Configurações';
    }

    function index(){
        $this->gerenciar();
    }

    function gerenciar(){

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){    
       
        $this->data['results'] = $this->Reparticoes_model->get($this->uri->segment(3));                
        
        }
        else{

        $this->data['results'] = $this->Reparticoes_model->search($pesquisa, $de, $ate);
        }      
       
        $this->data['view'] = 'reparticao/reparticao';
        $this->load->view('tema/topo',$this->data);

       
        
    }
    
    function adicionar(){  
          
        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('reparticoes') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        {            

            $data = array(
                    'nome' => set_value('nome'),
                    'abreviatura' => set_value('abreviatura'),
                    'email' => set_value('email'),
                    'responsavel' => set_value('responsavel'),
                    'direcoes_id' => set_value('direcoes'),
                    'departamentos_id' => set_value('departamentos'),
                    'data_criacao' => date('Y-m-d')
            );
           
            if ($this->Reparticoes_model->add('reparticoes',$data) == TRUE)
            {
                                $this->session->set_flashdata('success','Repartição registrado com sucesso!');
                redirect(base_url().'index.php/reparticao/adicionar/');
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

            }
        }
         $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*'); 
         $this->data['departamentos'] = $this->Departamentos_model->getActive('departamentos','*'); 

        $this->data['view'] = 'reparticao/adicionar';
        $this->load->view('tema/topo',$this->data);
   
       
    }   
    
    function editar(){  
        
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
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
                $this->session->set_flashdata('success','Repartição editado com sucesso!');
                redirect(base_url().'index.php/reparticao/editar/'.$this->input->post('id'));
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        } 
        $this->data['result'] = $this->Reparticoes_model->getById($this->uri->segment(3));
        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*'); 
        $this->data['departamentos'] = $this->Departamentos_model->getActive('departamentos','*'); 


        $this->data['view'] = 'reparticao/editar';
        $this->load->view('tema/topo',$this->data);

    }
        
}



