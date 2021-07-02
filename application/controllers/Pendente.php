<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendente extends CI_Controller {

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
        $this->load->model('pendente_model','',TRUE);
         $this->load->model('arquivos_model','',TRUE);
        $this->load->model('Usuarios_model','',TRUE);
        $this->data['menuRecebida'] = 'Recebida';
	}

    public function index(){
       $this->gerenciar();
       $this->tramitar();
    }
	public function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCliente')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar arquivos.');
           redirect(base_url());
        }

		$this->load->library('pagination');

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){

            
                   
            $config['base_url'] = base_url().'index.php/pendente/gerenciar';
            $config['total_rows'] = $this->pendente_model->count('correspondencia');
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
            
             $this->data['results'] = $this->pendente_model->get('correspondencia','*','',$config['per_page'],$this->uri->segment(3));

            
        
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

            $this->data['results'] = $this->pendente_model->search($pesquisa, $de, $ate);
        }

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');

        $this->load->model('Usuarios_model');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','usuarios.nome,usuarios.local');



       	$this->data['view'] = 'recebida/pendente';
		$this->load->view('tema/topo',$this->data);
	}

    

    public function download($id = null){
    	
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vArquivo')){
          $this->session->set_flashdata('error','Você não tem permissão para visualizar arquivos.');
          redirect(base_url());
        }

    	if($id == null || !is_numeric($id)){
    		$this->session->set_flashdata('error','Erro! O arquivo não pode ser localizado.');
            redirect(base_url() . 'index.php/arquivos/');
    	}

    	$file = $this->pendente_model->getById($id);

    	$this->load->library('zip');

    	$path = $file->path;

		$this->zip->read_file($path); 

		$this->zip->download('file'.date('d-m-Y-H.i.s').'.zip');
    }


    public function tramitar(){

   if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dArquivo')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar arquivos.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';  

         $this->form_validation->set_rules('direcao', '', 'trim|required');    

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            $id = $this->input->post('id');            
            $direcao = $this->input->post('direcao');
            $departamento = $this->input->post('departamento');
            $reparticao = $this->input->post('reparticao');
            $destino = $direcao.'/'.$departamento.'/'.$reparticao;
            
             $data = array(
                'destino'=>$destino,
                'estadoVer'=>$this->input->post('estadoVer') );

            if (($this->pendente_model->edit('correspondencia', $data, 'idCorrespondencia', $id)== TRUE)) {
                $this->session->set_flashdata('success','Correspondencia Tramitado com Sucesso!');
                redirect(base_url() . 'index.php/pendente/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'recebida/pendente';
        $this->load->view('tema/topo', $this->data);

    }
}

/* End of file arquivos.php */
/* Location: ./application/controllers/arquivos.php */