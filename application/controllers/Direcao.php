<?php

class Direcao extends CI_Controller {

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
        $this->load->model('direcoes_model', '', TRUE);
        $this->data['menuUsuarios'] = 'Direção';
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
       
        $this->data['results'] = $this->direcoes_model->get($this->uri->segment(3));                   
        
        }
        else{

        $this->data['results'] = $this->direcoes_model->search($pesquisa, $de, $ate);
        }
        
       
       
	    $this->data['view'] = 'direcao/direcao';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
	
    function adicionar(){  
          
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
        if ($this->form_validation->run('direcoes') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        {            

            $data = array(
                    'nome' => set_value('nome'),
					'abreviatura' => set_value('abreviatura'),
					'email' => set_value('email'),
					'responsavel' => set_value('responsavel'),
					'data_criacao' => date('Y-m-d')
            );
           
			if ($this->direcoes_model->add('direcoes',$data) == TRUE)
			{
                                $this->session->set_flashdata('success','Direção registrado com sucesso!');
				redirect(base_url().'index.php/direcao/adicionar/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

			}
		}

		$this->data['view'] = 'direcao/adicionar';
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
                    'data_alteracao' => date('Y-m-d')
                );
              

           
			if ($this->direcoes_model->edit('direcoes',$data,'id',$this->input->post('id')) == TRUE)
			{
                $this->session->set_flashdata('success','Direção editado com sucesso!');
				redirect(base_url().'index.php/direcao/editar/'.$this->input->post('id'));
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

			}
		} 
        $this->data['result'] = $this->direcoes_model->getById($this->uri->segment(3));

		$this->data['view'] = 'direcao/editar';
        $this->load->view('tema/topo',$this->data);

    }


}



