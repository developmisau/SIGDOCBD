<?php

class Usuarios extends CI_Controller {

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
        $this->load->model('usuarios_model', '', TRUE);
        $this->data['menuUsuarios'] = 'Usuários';
        $this->data['menuConfiguracoes'] = 'Configurações';
        

    }

    function index(){
        $this->gerenciar();
    }

    function gerenciar(){

        $direcoes = $this->input->get('direcoes');
        $nome = $this->input->get('nome');
        $email = $this->input->get('email');


        if($nome == null && $email == null && $direcoes== null){    
            $this->data['results'] = $this->usuarios_model->get($this->uri->segment(3));
        }
        else{
        $this->data['results'] = $this->usuarios_model->search($nome, $email, $direcoes);
        }

        $this->load->model('Direcoes_model');
        $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');
        $this->data['view'] = 'usuarios/usuarios';
        $this->load->view('tema/topo',$this->data);

       
        
    }
    
    function adicionar(){  
          
        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('usuarios') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        {  

            date_default_timezone_set("Africa/Maputo");                

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));

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
                    'nome' => set_value('nome'),
                    'apelido' => set_value('apelido'),
                    'email' => set_value('email'),
                    'senha' => $this->encryption->encrypt($this->input->post('senha')),
                    'direcoes_id' => $direcoes,
                    'departamentos_id' => $departamentos,
                    'reparticoes_id' => $reparticoes,
                    'situacao' => set_value('situacao'),
                    'permissoes_id' => $this->input->post('permissoes_id'),
                    'dataCadastro' => date('Y-m-d H:i:s')
            );
           
            if ($this->usuarios_model->add('usuarios',$data) == TRUE)
            {
                                $this->session->set_flashdata('success','Usuário cadastrado com sucesso!');
                redirect(base_url().'index.php/usuarios/adicionar/');
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

            }
        }
        
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('permissoes','permissoes.idPermissao,permissoes.nome'); 

         $this->load->model('Direcoes_model');
         $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*');

        $this->data['view'] = 'usuarios/adicionarUsuario';
        $this->load->view('tema/topo',$this->data);
   
       
    }   
    
    function editar(){  
        
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('sigdoc');
        }

        $this->load->library('form_validation');    
        $this->data['custom_error'] = '';
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('apelido', 'Apelido', 'trim|required');
        
        $this->form_validation->set_rules('direcoes', 'Direção', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|Valid_email');
        $this->form_validation->set_rules('situacao', 'Situação', 'trim|required');
        $this->form_validation->set_rules('permissoes_id', 'Permissão', 'trim|required');

        if ($this->form_validation->run() == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">'.validation_errors().'</div>' : false);

        } else
        { 


            if ($this->input->post('id') == 1 && $this->input->post('situacao') == 0)
            {
                $this->session->set_flashdata('error','O usuário super admin não pode ser desativado!');
                redirect(base_url().'index.php/usuarios/editar/'.$this->input->post('id'));
            }

            $senha = $this->input->post('senha'); 
            if($senha != null){

                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt'));

            date_default_timezone_set("Africa/Maputo");                

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
                $senha = $this->encryption->encrypt($senha);

                $data = array(
                    'nome' => set_value('nome'),
                    'apelido' => set_value('apelido'),
                    'email' => set_value('email'),
                    'senha' => $this->encryption->encrypt($this->input->post('senha')),
                    'direcoes_id' => $direcoes,
                    'departamentos_id' => $departamentos,
                    'reparticoes_id' => $reparticoes,
                    'situacao' => set_value('situacao'),
                    'permissoes_id' => $this->input->post('permissoes_id'),
                );
            }  

            else{

            date_default_timezone_set("Africa/Maputo");                

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
                     'nome' => set_value('nome'),
                    'apelido' => set_value('apelido'),                    
                    'email' => set_value('email'),
                    'direcoes_id' => $direcoes,
                    'departamentos_id' => $departamentos,
                    'reparticoes_id' => $reparticoes,
                    'situacao' => set_value('situacao'),
                    'permissoes_id' => $this->input->post('permissoes_id'),
                );

            }  

           
            if ($this->usuarios_model->edit('usuarios',$data,'id',$this->input->post('id')) == TRUE)
            {
                $this->session->set_flashdata('success','Usuário editado com sucesso!');
                redirect(base_url().'index.php/usuarios/editar/'.$this->input->post('id'));
            }
            else
            {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        }

        $this->data['result'] = $this->usuarios_model->getById($this->uri->segment(3));
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('permissoes','permissoes.idPermissao,permissoes.nome');
         $this->load->model('Direcoes_model');
         $this->data['direcoes'] = $this->Direcoes_model->getActive('direcoes','*'); 
         $this->data['departamentos'] = $this->Direcoes_model->getActive('departamentos','*'); 
         $this->data['reparticoes'] = $this->Direcoes_model->getActive('reparticoes','*'); 

        $this->data['view'] = 'usuarios/editarUsuario';
        $this->load->view('tema/topo',$this->data);
            
      
    }
    
    public function excluir(){

            $ID =  $this->uri->segment(3);
            $this->usuarios_model->delete('usuarios','id',$ID);             
            redirect(base_url().'index.php/usuarios/gerenciar/');
    }



}



