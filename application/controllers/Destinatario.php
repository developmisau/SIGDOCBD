<?php

class destinatario extends CI_Controller {

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
        $this->load->model('destinatario_model', '', TRUE);
        $this->load->model('cargo_model', '', TRUE);
        $this->data['menuUsuarios'] = 'Destinatario';
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
       
        $this->data['results'] = $this->destinatario_model->get($this->uri->segment(3));                 
        
        }
        else{

        $this->data['results'] = $this->destinatario_model->search($pesquisa, $de, $ate);
        }
        
       
       
        $this->data['view'] = 'destinatario/destinatario';
        $this->load->view('tema/topo',$this->data);

       
        
    }
    
    function adicionar(){  
          
        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('destinatario') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        {            

            $data = array(
                    'nomeDestinatario' => set_value('nome'),
                    'cargoId' => set_value('cargo'),
                    'data_criacao' => date('Y-m-d')
            );
           
            if ($this->destinatario_model->add('destinatario',$data) == TRUE)
            {
                                $this->session->set_flashdata('success','Destinatario registrado com sucesso!');
                redirect(base_url().'index.php/destinatario/adicionar/');
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

            }
        }
         $this->data['cargo'] = $this->cargo_model->getActive('cargo','*'); 

        $this->data['view'] = 'destinatario/adicionar';
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
                    'nomeDestinatario' => set_value('nome'),
                    'cargoId' => set_value('cargo'),
                    'data_alteracao' => date('Y-m-d')
                );
              

           
            if ($this->destinatario_model->edit('destinatario',$data,'idDestinatario',$this->input->post('id')) == TRUE)
            {
                $this->session->set_flashdata('success','Destinatario editado com sucesso!');
                redirect(base_url().'index.php/destinatario/editar/'.$this->input->post('id'));
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        } 
        $this->data['cargo'] = $this->cargo_model->getActive('cargo','*'); 
        $this->data['result'] = $this->destinatario_model->getById($this->uri->segment(3));


        $this->data['view'] = 'destinatario/editar';
        $this->load->view('tema/topo',$this->data);

    }


}



