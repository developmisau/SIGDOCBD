<?php

class Departamento extends CI_Controller {
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
        $this->data['menuDepartamentos'] = 'Departamentos';
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
       
        $this->data['results'] = $this->Departamentos_model->get($this->uri->segment(3));                
        
        }
        else{

        $this->data['results'] = $this->Departamentos_model->search($pesquisa, $de, $ate);
        }      
       
        $this->data['view'] = 'departamento/departamento';
        $this->load->view('tema/topo',$this->data);

       
        
    }
    
    function adicionar(){  
          
        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('departamentos') == false)
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
                    'data_criacao' => date('Y-m-d')
            );
           
            if ($this->Departamentos_model->add('departamentos',$data) == TRUE)
            {
                                $this->session->set_flashdata('success','Departamento registrado com sucesso!');
                redirect(base_url().'index.php/departamento/adicionar/');
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

            }
        }
         $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*'); 

        $this->data['view'] = 'departamento/adicionar';
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
                    'data_alteracao' => date('Y-m-d')
                );
              

           
            if ($this->Departamentos_model->edit('departamentos',$data,'id',$this->input->post('id')) == TRUE)
            {
                $this->session->set_flashdata('success','Departamento editado com sucesso!');
                redirect(base_url().'index.php/departamento/editar/'.$this->input->post('id'));
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        } 
        $this->data['result'] = $this->Departamentos_model->getById($this->uri->segment(3));
        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*'); 


        $this->data['view'] = 'departamento/editar';
        $this->load->view('tema/topo',$this->data);

    }
        
}



