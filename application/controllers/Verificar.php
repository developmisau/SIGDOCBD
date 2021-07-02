<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verificar extends CI_Controller {

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
        $this->load->model('verificar_model','',TRUE);
        $this->load->model('Usuarios_model','',TRUE);
        $this->data['menuRecebida'] = 'Recebida';
	}

    public function index(){
       $this->gerenciar();
       $this->verificar();
    }
	public function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar correspondencia.');
           redirect(base_url());
        }

		$this->load->library('pagination');

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){

            
                   
            $config['base_url'] = base_url().'index.php/verificar/gerenciar';
            $config['total_rows'] = $this->verificar_model->count('documentos');
            $config['per_page'] = 10;
            $config['next_link'] = 'Próxima';
            $config['prev_link'] = 'Anterior';
            $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            
            $this->pagination->initialize($config);     
            
            $this->data['results'] = $this->verificar_model->get('correspondencia','*','',$config['per_page'],$this->uri->segment(3));

            
        
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

            $this->data['results'] = $this->verificar_model->search($pesquisa, $de, $ate);
        }

        $this->load->model('Usuarios_model');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','usuarios.nome,usuarios.local');

       	$this->data['view'] = 'recebida/verificar';
		$this->load->view('tema/topo',$this->data);
	}

    public function verificar(){
    	if(!$this->permission->checkPermission($this->session->userdata('permissao'),'confRecepcao')){
          $this->session->set_flashdata('error','Você não tem permissão confirmar a recepção.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

         $this->form_validation->set_rules('estadoVer', '', 'trim|required'); 

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            $id = $this->input->post('id');
            
            
             $data2 = array(
                
                'estadoVer' => $this->input->post('estadoVer'));

            if (($this->verificar_model->edit('correspondencia', $data2, 'idCorrespondencia', $id)== TRUE)) {
                $this->session->set_flashdata('success','Correspondencia Verificada com Sucesso!');
                redirect(base_url() . 'index.php/verificar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        
        $this->data['view'] = 'recebida/verificar';
        $this->load->view('tema/topo', $this->data);

    }

    
}

/* End of file arquivos.php */
/* Location: ./application/controllers/arquivos.php */