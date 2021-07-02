<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sigdoc extends CI_Controller {


    /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Sigdoc_model','',TRUE);
        $this->load->model('Correspondencias_model','',TRUE);
        
    }

    public function index() {
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }
        $this->data['results'] = $this->Correspondencias_model->get();
        $this->data['resultsTra'] = $this->Correspondencias_model->getTramitar();
       
        $this->data['menuPainel'] = 'Painel';
        $this->data['view'] = 'sigdoc/painel';
        $this->load->view('tema/topo',  $this->data);
      
    }

    public function minhaConta() {
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        $this->data['usuario'] = $this->Sigdoc_model->getById($this->session->userdata('id'));
        $this->data['view'] = 'sigdoc/minhaConta';
        $this->load->view('tema/topo',  $this->data);
     
    }

    public function alterarSenha() {
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        $this->load->library('encryption');
        $this->encryption->initialize(array('driver' => 'mcrypt'));
        
        $oldSenha = $this->input->post('oldSenha');
        $senha = $this->input->post('novaSenha');
        $result = $this->Sigdoc_model->alterarSenha($senha,$oldSenha,$this->session->userdata('id'));
        if($result){
            $this->session->set_flashdata('success','Senha Alterada com sucesso!');
            redirect(base_url() . 'index.php/sigdoc/minhaConta');
        }
        else{
            $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar a senha!');
            redirect(base_url() . 'index.php/sigdoc/minhaConta');
            
        }
    }

    public function pesquisar() {
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }
        
        $termo = $this->input->get('termo');

        $data['results'] = $this->Sigdoc_model->pesquisar($termo);
        // $this->data['produtos'] = $data['results']['produtos'];
        // $this->data['servicos'] = $data['results']['servicos'];
        // $this->data['os'] = $data['results']['os'];
        // $this->data['clientes'] = $data['results']['clientes'];
        $this->data['view'] = 'sigdoc/pesquisa';
        $this->load->view('tema/topo',  $this->data);
      
    }

    public function login(){
        
        $this->load->view('sigdoc/login');
        
    }
    public function sair(){
        $this->session->sess_destroy();
        redirect('sigdoc/login');
    }


    public function verificarLogin(){
        
        header('Access-Control-Allow-Origin: '.base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','E-mail','valid_email|required|trim');
        $this->form_validation->set_rules('senha','Senha','required|trim');
        if ($this->form_validation->run() == false) {
            $json = array('result' => false, 'message' => validation_errors());
            echo json_encode($json);
        }
        else {
            $email = $this->input->post('email');
            $password = $this->input->post('senha');
            $this->load->model('Sigdoc_model');
            $user = $this->Sigdoc_model->check_credentials($email);

            if($user){

                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt'));
                $password_stored =  $this->encryption->decrypt($user->senha);

        if($password == $password_stored){
    //abreviatura das direcoes, departamentos e reparticoes
    $abredir=$this->Correspondencias_model->getDirecoes2($user->direcoes_id);
    $abredep=$this->Correspondencias_model->getDepartamentos2($user->departamentos_id);
    $abrerep=$this->Correspondencias_model->getReparticoes2($user->reparticoes_id);

    //nome das direcoes, departamentos e reparticoes
    $ndir=$this->Correspondencias_model->getDirecoesUser($user->direcoes_id);
    $ndep=$this->Correspondencias_model->getDepartamentosUser($user->departamentos_id);
    $nrep=$this->Correspondencias_model->getReparticoesUser($user->reparticoes_id);
         $session_data = array(
                'nome' => $user->nome,
                'abrev_direcoes' => $abredir,
                'abrev_departamentos' => $abredep,
                'abrev_reparticoes' => $abrerep,
                'nome_direcoes' => $ndir,
                'nome_departamentos' => $ndep,
                'nome_reparticoes' => $nrep,
                'local_direcoes' => $user->direcoes_id,
                'local_departamentos' => $user->departamentos_id,
                'local_reparticoes' => $user->reparticoes_id,
                'email' => $user->email, 
                'id' => $user->id,
                'permissao' => $user->permissoes_id ,
                'logado' => TRUE);
                    $this->session->set_userdata($session_data);

                    $json = array('result' => true);
                    echo json_encode($json);

                    //$this->session->set_userdata('teste','teste');
                    //$this->load->view('tema/topo',  $this->data);
                    
                }
                else{
                    $json = array('result' => false, 'message' => 'Os dados de acesso estão incorretos.');
                    echo json_encode($json);
                }
            }
            else{
                $json = array('result' => false, 'message' => 'Usuário não encontrado, verifique se suas credenciais estão corretass.');
                echo json_encode($json);
            }
        }
        die();

     
      
    }


    public function backup(){

        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cBackup')){
           $this->session->set_flashdata('error','Você não tem permissão para efetuar backup.');
           redirect(base_url());
        }

        
        
        $this->load->dbutil();
        $prefs = array(
                'format'      => 'zip',
                'filename'    => 'backup'.date('d-m-Y').'.sql'
              );

        $backup =& $this->dbutil->backup($prefs);

        $this->load->helper('file');
        write_file(base_url().'backup/backup.zip', $backup);

        $this->load->helper('download');
        force_download('backup'.date('d-m-Y H:m:s').'.zip', $backup);
    }


    public function emitente(){   

        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $data['menuConfiguracoes'] = 'Configuracoes';
        $data['dados'] = $this->Sigdoc_model->getEmitente();
        $data['view'] = 'sigdoc/emitente';
        $this->load->view('tema/topo',$data);
        $this->load->view('tema/rodape');
    }

    function do_upload(){

        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp',
            'max_size'      => 2048,
            'remove_space'  => TRUE,
            'encrypt_name'  => TRUE,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            print_r($upload_error);
            exit();
        } else {
            $file_info = array($this->upload->data());
            return $file_info[0]['file_name'];
        }

    }


    public function cadastrarEmitente() {

        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Razão Social','required|trim');
        $this->form_validation->set_rules('cnpj','CNPJ','required|trim');
        $this->form_validation->set_rules('ie','IE','required|trim');
        $this->form_validation->set_rules('logradouro','Logradouro','required|trim');
        $this->form_validation->set_rules('numero','Número','required|trim');
        $this->form_validation->set_rules('bairro','Bairro','required|trim');
        $this->form_validation->set_rules('cidade','Cidade','required|trim');
        $this->form_validation->set_rules('uf','UF','required|trim');
        $this->form_validation->set_rules('telefone','Telefone','required|trim');
        $this->form_validation->set_rules('email','E-mail','required|trim');


        

        if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('error','Campos obrigatórios não foram preenchidos.');
            redirect(base_url().'index.php/sigdoc/emitente');
            
        } 
        else {

            $nome = $this->input->post('nome');
            $cnpj = $this->input->post('cnpj');
            $ie = $this->input->post('ie');
            $logradouro = $this->input->post('logradouro');
            $numero = $this->input->post('numero');
            $bairro = $this->input->post('bairro');
            $cidade = $this->input->post('cidade');
            $uf = $this->input->post('uf');
            $telefone = $this->input->post('telefone');
            $email = $this->input->post('email');
            $image = $this->do_upload();
            $logo = base_url().'assets/uploads/'.$image;


            $retorno = $this->Sigdoc_model->addEmitente($nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$email, $logo);
            if($retorno){

                $this->session->set_flashdata('success','As informações foram inseridas com sucesso.');
                redirect(base_url().'index.php/sigdoc/emitente');
            }
            else{
                $this->session->set_flashdata('error','Ocorreu um erro ao tentar inserir as informações.');
                redirect(base_url().'index.php/sigdoc/emitente');
            }
            
        }
    }


    public function editarEmitente() {

        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Razão Social','required|trim');
        $this->form_validation->set_rules('cnpj','CNPJ','required|trim');
        $this->form_validation->set_rules('ie','IE','required|trim');
        $this->form_validation->set_rules('logradouro','Logradouro','required|trim');
        $this->form_validation->set_rules('numero','Número','required|trim');
        $this->form_validation->set_rules('bairro','Bairro','required|trim');
        $this->form_validation->set_rules('cidade','Cidade','required|trim');
        $this->form_validation->set_rules('uf','UF','required|trim');
        $this->form_validation->set_rules('telefone','Telefone','required|trim');
        $this->form_validation->set_rules('email','E-mail','required|trim');


        

        if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('error','Campos obrigatórios não foram preenchidos.');
            redirect(base_url().'index.php/sigdoc/emitente');
            
        } 
        else {

            $nome = $this->input->post('nome');
            $cnpj = $this->input->post('cnpj');
            $ie = $this->input->post('ie');
            $logradouro = $this->input->post('logradouro');
            $numero = $this->input->post('numero');
            $bairro = $this->input->post('bairro');
            $cidade = $this->input->post('cidade');
            $uf = $this->input->post('uf');
            $telefone = $this->input->post('telefone');
            $email = $this->input->post('email');
            $id = $this->input->post('id');


            $retorno = $this->Sigdoc_model->editEmitente($id, $nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$email);
            if($retorno){

                $this->session->set_flashdata('success','As informações foram alteradas com sucesso.');
                redirect(base_url().'index.php/sigdoc/emitente');
            }
            else{
                $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar as informações.');
                redirect(base_url().'index.php/sigdoc/emitente');
            }
            
        }
    }


    public function editarLogo(){
        
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $id = $this->input->post('id');
        if($id == null || !is_numeric($id)){
           $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar a logomarca.');
           redirect(base_url().'index.php/sigdoc/emitente'); 
        }
        $this->load->helper('file');
        delete_files(FCPATH .'assets/uploads/');

        $image = $this->do_upload();
        $logo = base_url().'assets/uploads/'.$image;

        $retorno = $this->Sigdoc_model->editLogo($id, $logo);
        if($retorno){

            $this->session->set_flashdata('success','As informações foram alteradas com sucesso.');
            redirect(base_url().'index.php/sigdoc/emitente');
        }
        else{
            $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar as informações.');
            redirect(base_url().'index.php/sigdoc/emitente');
        }

    }
}
