<?php

class pro_externa extends CI_Controller {

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
        $this->load->model('pro_externa_model', '', TRUE);
        $this->data['menuUsuarios'] = 'Proviniência Externa';
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
       
        $this->data['results'] = $this->pro_externa_model->get($this->uri->segment(3));                   
        
        }
        else{

        $this->data['results'] = $this->pro_externa_model->search($pesquisa, $de, $ate);
        }
        
        
       
       
	    $this->data['view'] = 'pro_externa/externa';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
	
    function adicionar(){  
          
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
        if ($this->form_validation->run('pro_externa') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

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
                    'data_criacao' => date('Y-m-d')
        
            );
           
			if ($this->pro_externa_model->add('pro_externa',$data) == TRUE)
			{
                                $this->session->set_flashdata('success','Proviniencia Externa registrado com sucesso!');
				redirect(base_url().'index.php/pro_externa/adicionar/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

			}
		}

         $this->load->model('pro_externa_model');
         $this->data['pro_externa'] = $this->pro_externa_model->getActive('pro_externa','*');

		$this->data['view'] = 'pro_externa/adicionar';
        $this->load->view('tema/topo',$this->data);
   
       
    }	
    
    function editar(){  
    if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('sigdoc');
        }

        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', '', 'trim|required');
          $this->form_validation->set_rules('abreviatura', '', 'trim|required');

        if ($this->form_validation->run('') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">'.validation_errors().'</div>' : false);

        } else
        { 
                $data = array(
                     'nome' => set_value('nome'),
                    'abreviatura' => set_value('abreviatura'),
                    'email' => set_value('email'),
                    'contacto' => set_value('contacto'),
                    'endereco' => set_value('endereco'),
                    'data_alteracao' => date('Y-m-d')

                );

            if ($this->pro_externa_model->edit('pro_externa',$data,'id',$this->input->post('id')) == TRUE)
            {
                $this->session->set_flashdata('success','Proviniencia Externa editada com sucesso!');
                redirect(base_url().'index.php/pro_externa/editar/'.$this->input->post('id'));
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        } 
        $this->data['result'] = $this->pro_externa_model->getById($this->uri->segment(3));
        

        $this->data['view'] = 'pro_externa/editar';
        $this->load->view('tema/topo',$this->data);
    }
       

        function adicionarPopUp(){  
          
        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('pro_externa') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        { 
          $data = array(
                    'pro_externa' => set_value('pro_externa'),
                    'abrevpro_externa' => set_value('abrevpro_externa')
                    
        
            );
           
            if ($this->pro_externa_model->add('pro_externa',$data) == TRUE)
            {
                                $this->session->set_flashdata('success','Proviniencia Externa cadastrada com sucesso!');
                redirect(base_url().'index.php/arquivos/adicionar');

            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

            }
        }

         $this->load->model('pro_externa_model');
         $this->data['pro_externa'] = $this->pro_externa_model->getActive('pro_externa','*');

       $this->data['view'] = 'pro_externa/adicionarExterna';
       $this->load->view('tema/topo',$this->data);
   
       
    }   
    

}



