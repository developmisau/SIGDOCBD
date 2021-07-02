<?php

class Cargo extends CI_Controller {

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
          $this->session->set_flashdata('error','Você não tem permissão para configurar os Cargos.');
          redirect(base_url());
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('Cargo_model', '', TRUE);
        $this->data['menuUsuarios'] = 'Cargo Funcionário';
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
       
         $this->data['results'] = $this->Cargo_model->get($this->uri->segment(3));            
        
        }
        else{

        $this->data['results'] = $this->Cargo_model->search($pesquisa, $de, $ate);
        }

		
        
       
       
	    $this->data['view'] = 'cargo/cargo';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
	
    function adicionar(){  
          
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
        if ($this->form_validation->run('cargo') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        { 
          $data = array(
                    'nomeCargo' => set_value('nome'),
                    'descricao' => set_value('descricao'),
                    'data_criacao' => date('Y-m-d')                    
        
            );
           
			if ($this->Cargo_model->add('cargo',$data) == TRUE)
			{
                                $this->session->set_flashdata('success','Cargo do funcionário registrado com sucesso!');
				redirect(base_url().'index.php/cargo/adicionar/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

			}
		}

         $this->load->model('Cargo_model');
         $this->data['cargo'] = $this->Cargo_model->getActive('cargo','*');

		$this->data['view'] = 'cargo/adicionar';
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
        

        if ($this->form_validation->run('') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">'.validation_errors().'</div>' : false);

        } else
        { 
                $data = array(
                    'nomeCargo' => set_value('nome'),
                    'descricao' => set_value('descricao'),
                    'data_alteracao' => date('Y-m-d')
                    
                );

            if ($this->Cargo_model->edit('cargo',$data,'idCargo',$this->input->post('idCargo')) == TRUE)
            {
                $this->session->set_flashdata('success','Cargo do funcionário editada com sucesso!');
                redirect(base_url().'index.php/cargo/editar/'.$this->input->post('idCargo'));
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        } 
        $this->data['result'] = $this->Cargo_model->getById($this->uri->segment(3));
        

        $this->data['view'] = 'cargo/editar';
        $this->load->view('tema/topo',$this->data);
    }
       
}



