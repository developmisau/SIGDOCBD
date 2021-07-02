<?php

class classificador extends CI_Controller {

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
        $this->load->model('classificador_model', '', TRUE);
        $this->data['menuUsuarios'] = 'Classificador';
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
       
        $this->data['results'] = $this->classificador_model->get($this->uri->segment(3));                 
        
        }
        else{

        $this->data['results'] = $this->classificador_model->search($pesquisa, $de, $ate);
        }
        
       
       
        $this->data['view'] = 'classificador/classificador';
        $this->load->view('tema/topo',$this->data);

       
        
    }
    
    function adicionar(){  
          
        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('classificador') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        {            

            $data = array(
                    'nome' => set_value('nome'),
                    'codigo' => set_value('codigo'),
                    'data_criacao' => date('Y-m-d')
            );
           
            if ($this->classificador_model->add('classificacao',$data) == TRUE)
            {
                                $this->session->set_flashdata('success','Classificador registrado com sucesso!');
                redirect(base_url().'index.php/classificador/adicionar/');
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

            }
        }

        $this->data['view'] = 'classificador/adicionar';
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
                    'codigo' => set_value('codigo'),
                    'data_alteracao' => date('Y-m-d')
                );
              

           
            if ($this->classificador_model->edit('classificacao',$data,'id',$this->input->post('id')) == TRUE)
            {
                $this->session->set_flashdata('success','Classificador editado com sucesso!');
                redirect(base_url().'index.php/classificador/editar/'.$this->input->post('id'));
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        } 
        $this->data['result'] = $this->classificador_model->getById($this->uri->segment(3));

        $this->data['view'] = 'classificador/editar';
        $this->load->view('tema/topo',$this->data);

    }


}



