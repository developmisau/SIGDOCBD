<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arquivos extends CI_Controller {

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
        //$this->load->model('TipoDoc_model','',TRUE);
        $this->load->model('arquivos_model','',TRUE);
        $this->load->model('Usuarios_model','',TRUE);
        $this->load->model('Classificacao_model','',TRUE);
        $this->load->model('Pendente_model','',TRUE);
        $this->data['menuCorrespondencias'] = 'Correspondencia';
    }

     public function index(){
     $this->gerenciar();
    //   $this->despacho();
        //$this->tramitar();
        //$this->parecer();
     }
    public function gerenciar(){


    if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Correspondência.');
           redirect(base_url());
        }

    $this->load->library('pagination');

        $pesquisa = $this->input->get('pesquisa');
        $prioridade = $this->input->get('prioridade');
         $proviniencia = $this->input->get('proviniencia');
         $tipoProviniencia = $this->input->get('tipoProviniencia');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $prioridade == null && $proviniencia==null && $tipoProviniencia == null && $de == null && $ate == null){

            
                   
            $config['base_url'] = base_url().'index.php/arquivos/gerenciar';
            $config['total_rows'] = $this->arquivos_model->count('correspondencia');
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
            
            $this->data['results'] = $this->arquivos_model->get('correspondencia','*','',$config['per_page'],$this->uri->segment(3));

            
        
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

            $this->data['results'] = $this->arquivos_model->search($pesquisa, $de, $ate);
        }

         $this->load->model('Direcao_model');
         $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');

        $this->load->model('Usuarios_model');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','usuarios.nome,usuarios.local');

        $this->load->model('TipoDoc_model');
        $this->data['tipodoc'] = $this->TipoDoc_model->getActive('tipodoc','*');

        $this->data['view'] = 'arquivos/arquivos';
    $this->load->view('tema/topo',$this->data);
  }

    public function todasCorrespondencias(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Correspondencia.');
           redirect(base_url());
        }

        $this->load->library('pagination');

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){

            
                   
            $config['base_url'] = base_url().'index.php/arquivos/gerenciar';
            $config['total_rows'] = $this->arquivos_model->count('documentos');
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
            
            $this->data['results'] = $this->arquivos_model->get('correspondencia','*','',$config['per_page'],$this->uri->segment(3));

            
        
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

            $this->data['results'] = $this->arquivos_model->search($pesquisa, $de, $ate);
        }

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');

        $this->load->model('Usuarios_model');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','usuarios.nome,usuarios.local');

        $this->data['view'] = 'arquivos/todasCorrespondencias';
        $this->load->view('tema/topo',$this->data);
    }

    public function correspondenciasDespachada(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar arquivos.');
           redirect(base_url());
        }

        $this->load->library('pagination');

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){

            
                   
            $config['base_url'] = base_url().'index.php/arquivos/gerenciar';
            $config['total_rows'] = $this->arquivos_model->count('documentos');
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
            
            $this->data['results'] = $this->arquivos_model->get('correspondencia','*','',$config['per_page'],$this->uri->segment(3));

            
        
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

            $this->data['results'] = $this->arquivos_model->search($pesquisa, $de, $ate);
        }

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');

        $this->load->model('Usuarios_model');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','usuarios.nome,usuarios.local');

        $this->data['view'] = 'arquivos/correspondenciasDespachada';
        $this->load->view('tema/topo',$this->data);
    }
   public function verificar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar arquivos.');
           redirect(base_url());
        }

        $this->load->library('pagination');

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){

            
                   
            $config['base_url'] = base_url().'index.php/arquivos/verificar';
            $config['total_rows'] = $this->arquivos_model->count('correspondencia');
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
            
            $this->data['results'] = $this->arquivos_model->get('correspondencia','*','',$config['per_page'],$this->uri->segment(3));

            
        
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

            $this->data['results'] = $this->arquivos_model->search($pesquisa, $de, $ate);
        }

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');

        $this->load->model('Usuarios_model');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','usuarios.nome,usuarios.local');

        $this->data['view'] = 'arquivos/verificar';
        $this->load->view('tema/topo',$this->data);
    }

        public function pendente(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar arquivos.');
           redirect(base_url());
        }

        $this->load->library('pagination');

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if($pesquisa == null && $de == null && $ate == null){

            
                   
            $config['base_url'] = base_url().'index.php/arquivos/verificar';
            $config['total_rows'] = $this->arquivos_model->count('correspondencia');
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
            
            $this->data['results'] = $this->arquivos_model->get('correspondencia','*','',$config['per_page'],$this->uri->segment(3));

            
        
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

            $this->data['results'] = $this->arquivos_model->search($pesquisa, $de, $ate);
        }

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');

        $this->load->model('Usuarios_model');
        $this->data['usuarios'] = $this->Usuarios_model->getActive('usuarios','usuarios.nome,usuarios.local');

        $this->data['view'] = 'arquivos/pendente';
        $this->load->view('tema/topo',$this->data);
    }

    public function adicionar() {

         if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar Correspondência.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('categoria', '', 'trim|required');
             
         if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {


            $arquivo = $this->do_upload();

            $file = $arquivo['file_name'];
            $path = $arquivo['full_path'];
            $url = base_url().'assets/arquivos/'.date('d-m-Y').'/'.$file;
            $tamanho = $arquivo['file_size'];
            $tipo = $arquivo['file_ext'];

            $data = $this->input->post('data');

            if($data == null){
                $data = date('Y-m-d');
            }
            else{
                $data = explode('/',$data);
                $data = $data[2].'-'.$data[1].'-'.$data[0];
            }

            $direcao = $this->input->post('idDirecao');
            $abrevDirecao=$this->arquivos_model->getDirecao($direcao);


            $departamento = $this->input->post('idDepartamento');
            $abrevDepartamento=$this->arquivos_model->getDepartamento($departamento);

            $reparticao = $this->input->post('idReparticao');
             $abrevReparticao=$this->arquivos_model->getReparticao($reparticao);

            if ($direcao<>"" and $departamento=="" and $reparticao=="") {
                $proviniencia = $abrevDirecao;
            }
            else if ($direcao<>"" and $departamento<>"" and $reparticao=="") {
                $proviniencia = $abrevDirecao.'/'.$abrevDepartamento;
            }
            else if ($direcao<>"" and $departamento<>"" and $reparticao<>"") {
                $proviniencia = $abrevDirecao.'/'.$abrevDepartamento.'/'.$abrevReparticao; 
            }

             else if ($direcao=="" and $departamento=="" and $reparticao=="") {
                $proviniencia = $this->input->post('externa');
            }


            
            $ano1=date('Y');
            $ano=$ano1[2].$ano1[3];
            $numCorrespondencia=$this->input->post('refRec').'/'.$this->input->post('codigo').'/'.$proviniencia.'/'.$ano;


                $data = array( 
                'numCorrespondencia'=>$numCorrespondencia,               
                'categoria' => $this->input->post('categoria'),
                'refProv' => $this->input->post('refProv'),
                'refRec' => $this->input->post('refRec'),
                'codigoAssunto' => $this->input->post('codigo'),
                'assunto' => $this->input->post('assunto'),
                'tipoDoc' => $this->input->post('tipoDoc'),
                'origem' => $this->input->post('origem'),
                'usuarioId' => $this->input->post('usuario'),
                'proviniencia' => $proviniencia,
                'direcao' => $this->input->post('idDirecao'),
                'departamento' => $this->input->post('idDepartamento'),
                'reparticao' => $this->input->post('idReparticao'),
                'prioridade' => $this->input->post('prioridade'),               
                'observacao' => $this->input->post('observacao'),
                'estadoTra' => $this->input->post('estadoTra'),
                'estadoVer' => $this->input->post('estadoVer'),
                'estadoDes' => $this->input->post('estadoDes'),
                'estadoPar' => $this->input->post('estadoPar'),
                'tipoProviniencia' => $this->input->post('tipoProviniencia'),
                'dataEmissao' => $data,
                //'verUnicidadeCorre'=>$verUnicidadeCorre,
                'file' => $file,
                'path' => $path,
                'url' => $url
            );
        
            

            if ($this->arquivos_model->add('correspondencia', $data) == TRUE) {
                $this->session->set_flashdata('success','Correspondencia adicionado com sucesso!');
                redirect(base_url() . 'index.php/arquivos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->load->model('TipoDoc_model');
        $this->data['tipoDoc'] = $this->TipoDoc_model->getActive('tipoDoc','*');

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->data['codigo'] = $this->Classificacao_model->getActive('classificacao','classificacao.codigo,classificacao.assunto');

        $this->data['view'] = 'arquivos/adicionarArquivo';
        $this->load->view('tema/topo', $this->data);

    }


    public function despacho(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'despCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para visualizar Despachos.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';


        $this->form_validation->set_rules('id', '', 'trim|required');
        $this->form_validation->set_rules('observacao', '', 'trim|required');     


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            $id = $this->input->post('id'); 
            if($data == null){
                $data = date('Y-m-d');
            }
            else{
                $data = explode('/',$data);
                $data = $data[2].'-'.$data[1].'-'.$data[0];
            }
             $data = array(
                'estadoDes' => $this->input->post('estadoDes'),
                'observacaoDes'=>$this->input->post('observacao'),
                'dataFinal'=>$data
                );

            if (($this->arquivos_model->edit('correspondencia', $data, 'idCorrespondencia', $id)== TRUE)) {
                $this->session->set_flashdata('success','Correspondencia Despachado com Sucesso!');
                redirect(base_url() . 'index.php/arquivos/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        

        $this->load->model('TipoDoc_model');
        $this->data['tipoDoc'] = $this->TipoDoc_model->getActive('tipoDoc','*');

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');
        
        $this->data['view'] = 'arquivos/arquivos';
        $this->load->view('tema/topo', $this->data);

    }

    public function tramitar(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'tCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para tramitar Correspondência.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';


        $this->form_validation->set_rules('idDirecao', '', 'trim|required');     


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            $id = $this->input->post('id');
            
           
            $direcao = $this->input->post('idDirecao');
            $abrevDirecao=$this->arquivos_model->getDirecao($direcao);


            $departamento = $this->input->post('idDepartamento');
            $abrevDepartamento=$this->arquivos_model->getDepartamento($departamento);

            $reparticao = $this->input->post('idReparticao');
             $abrevReparticao=$this->arquivos_model->getReparticao($reparticao);

            if ($direcao<>"" and $departamento=="" and $reparticao=="") {
                $destino = $abrevDirecao;
            }
            else if ($direcao<>"" and $departamento<>"" and $reparticao=="") {
                $destino = $abrevDirecao.'/'.$abrevDepartamento;
            }
            else if ($direcao<>"" and $departamento<>"" and $reparticao<>"") {
                $destino = $abrevDirecao.'/'.$abrevDepartamento.'/'.$abrevReparticao; 
            }

            
             $data = array(
                'estadoTra' => $this->input->post('estadoTra'),
                'observacaoTra' => $this->input->post('observacao'),
                'destino'=>$destino
                );

            if (($this->arquivos_model->edit('correspondencia', $data, 'idCorrespondencia', $id)== TRUE)) {
                $this->sendMail();
                
                $this->session->set_flashdata('success','Correspondencia Tramitado com Sucesso!');
                redirect(base_url() . 'index.php/arquivos/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->load->model('TipoDoc_model');
        $this->data['tipoDoc'] = $this->TipoDoc_model->getActive('tipoDoc','*');

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');
        
        $this->data['view'] = 'arquivos/arquivos';
        $this->load->view('tema/topo', $this->data);

    }

     public function parecer(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para dar parecer a Correspondência.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';


        $this->form_validation->set_rules('id', '', 'trim|required');
        //$this->form_validation->set_rules('observacao', '', 'trim|required');
        $direcao = $this->input->post('idDirecao2');
            $abrevDirecao=$this->arquivos_model->getDirecao($direcao);


            $departamento = $this->input->post('idDepartamento2');
            $abrevDepartamento=$this->arquivos_model->getDepartamento($departamento);

            $reparticao = $this->input->post('idReparticao2');
             $abrevReparticao=$this->arquivos_model->getReparticao($reparticao);

            if ($direcao<>"" and $departamento=="" and $reparticao=="") {
                $destino = $abrevDirecao;
            }
            else if ($direcao<>"" and $departamento<>"" and $reparticao=="") {
                $destino = $abrevDirecao.'/'.$abrevDepartamento;
            }
            else if ($direcao<>"" and $departamento<>"" and $reparticao<>"") {
                $destino = $abrevDirecao.'/'.$abrevDepartamento.'/'.$abrevReparticao; 
            }
     


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
           
            $id = $this->input->post('id'); 
            if($data == null){
                $data = date('Y-m-d');
            }
            else{
                $data = explode('/',$data);
                $data = $data[2].'-'.$data[1].'-'.$data[0];
            }
            $data2 = array(
                'correspondenciaId'=>$this->input->post('id'),
                //'usuarioId'=>$this->input->post('idUsuario'),
                'parecer' => $this->input->post('parecer'),
                'dataParecer'=>$data
                );
             $data = array(
                'estadoPar' => $this->input->post('estadoPar'),
                'destino'=>$destino,
                'estadoTra'=>$this->input->post('estadoTra')
             
                );

           

      if (($this->arquivos_model->edit('correspondencia', $data, 'idCorrespondencia', $id)== TRUE) and ($this->arquivos_model->add('parecer', $data2)== TRUE)) {
                $this->session->set_flashdata('success','Parecer efeituado com Sucesso!');
                redirect(base_url() . 'index.php/arquivos/gerenciar');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        

        $this->load->model('TipoDoc_model');
        $this->data['tipoDoc'] = $this->TipoDoc_model->getActive('tipoDoc','*');

        $this->load->model('Direcao_model');
        $this->data['direcao'] = $this->Direcao_model->getActive('direcao','direcao.idDirecao,direcao.nomeDirecao,direcao.abrevDirecao');

        $this->load->model('Departamento_model');
        $this->data['departamento'] = $this->Departamento_model->getActive('departamento','departamento.idDepartamento,departamento.nomeDepartamento,departamento.abrevDepartamento');

        $this->load->model('Reparticao_model');
        $this->data['reparticao'] = $this->Reparticao_model->getActive('reparticao','reparticao.idReparticao,reparticao.nomeReparticao,reparticao.abrevReparticao');
        
        $this->data['view'] = 'arquivos/arquivos';
        $this->load->view('tema/topo', $this->data);

    }

    public function do_upload(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar arquivos.');
          redirect(base_url());
        }
    
        $date = date('d-m-Y');

        $config['upload_path'] = './assets/arquivos/'.$date;
        $config['allowed_types'] = 'txt|jpg|jpeg|gif|png|pdf|PDF|JPG|JPEG|GIF|PNG';
        $config['max_size']     = 0;
        $config['max_width']  = '3000';
        $config['max_height']  = '2000';
        $config['encrypt_name'] = true;


        if (!is_dir('./assets/arquivos/'.$date)) {

            mkdir('./assets/arquivos/' . $date, 0777, TRUE);

        }

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            $this->session->set_flashdata('error','Erro ao fazer upload do arquivo, verifique se a extensão do arquivo é permitida.');
            redirect(base_url() . 'index.php/arquivos/adicionar/');
        }
        else
        {
            //$data = array('upload_data' => $this->upload->data());
            return $this->upload->data();
        }
    }

 public function visualizar(){

        // if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
        //     $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
        //     redirect('sigdoc');
        // }
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){
          $this->session->set_flashdata('error','Você não tem permissão para visualizar Correspondência.');
          redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->load->model('sigdoc_model');
        $this->data['result'] = $this->arquivos_model->getById2($this->uri->segment(3));
       // $this->data['produtos'] = $this->arquivos_model->getProdutos($this->uri->segment(3));
        $this->data['emitente'] = $this->sigdoc_model->getEmitente();
        
        $this->data['view'] = 'arquivos/visualizarArquivos';
        $this->load->view('tema/topo', $this->data);
       
    }
 public function visualizarDespacho(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('sigdoc');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'estDespacho')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar clientes.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->arquivos_model->getById($this->uri->segment(3));
        // $this->data['results'] = $this->arquivos_model->getOsByCliente($this->uri->segment(3));
        $this->data['view'] = 'arquivos/visualizarDespacho';
        $this->load->view('tema/topo', $this->data);

        
    }

public function autoCompleteCliente(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
         $teste=$this->arquivos_model->autoCompleteCliente($q);
        }
        

    }

public function fillCiudadesAdicionar() {
        $idDirecao = $this->input->post('idDirecao');
        
        
        if($idDirecao){
            $this->load->model('arquivos_model');
            $departamento = $this->arquivos_model->getCiudades($idDirecao);
            echo '<option value="">Selecione Departamento</option>';
            foreach($departamento as $dep){
                echo '<option value="'. $dep->idDepartamento .'">'. $dep->abrevDepartamento .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Departamento</option>';
        }

        
    }

    public function fillCiudadesAdicionar2(){
        $idDepartamento = $this->input->post('idDepartamento');
        if($idDepartamento){
            $this->load->model('arquivos_model');
            $reparticao = $this->arquivos_model->getCiudades2($idDepartamento);
            echo '<option value="">Selecione Reparticao</option>';
            foreach($reparticao as $fila){
                echo '<option value="'. $fila->idReparticao .'">'. $fila->abrevReparticao .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Reparticao</option>';
        }
    }

 public function fillCiudadesTramite() {
        $idDirecao = $this->input->post('idDirecao');
        
        
        if($idDirecao){
            $this->load->model('arquivos_model');
            $departamento = $this->arquivos_model->getCiudades($idDirecao);
            echo '<option value="">Selecione Departamento</option>';
            foreach($departamento as $dep){
                echo '<option value="'. $dep->idDepartamento .'">'. $dep->abrevDepartamento .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Departamento</option>';
        }

        
    }

    public function fillCiudadesTramite2(){
        $idDepartamento = $this->input->post('idDepartamento');
        if($idDepartamento){
            $this->load->model('arquivos_model');
            $reparticao = $this->arquivos_model->getCiudades2($idDepartamento);
            echo '<option value="">Selecione Reparticao</option>';
            foreach($reparticao as $fila){
                echo '<option value="'. $fila->idReparticao .'">'. $fila->abrevReparticao .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Reparticao</option>';
        }
    }
  
 public function fillCiudadesParecer() {
        $idDirecao = $this->input->post('idDirecao2');
        
        
        if($idDirecao){
            $this->load->model('arquivos_model');
            $departamento = $this->arquivos_model->getCiudades($idDirecao);
            echo '<option value="">Selecione Departamento</option>';
            foreach($departamento as $dep){
                echo '<option value="'. $dep->idDepartamento .'">'. $dep->abrevDepartamento .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Departamento</option>';
        }

        
    }

    public function fillCiudadesParecer2(){
        $idDepartamento = $this->input->post('idDepartamento2');
        if($idDepartamento){
            $this->load->model('arquivos_model');
            $reparticao = $this->arquivos_model->getCiudades2($idDepartamento);
            echo '<option value="">Selecione Reparticao</option>';
            foreach($reparticao as $fila){
                echo '<option value="'. $fila->idReparticao .'">'. $fila->abrevReparticao .'</option>';
            }
        }  else {
            echo '<option value="">Selecione Reparticao</option>';
        }
    }

public function sendMail()
    {
        //Carga a biblioteca email de CI
        $this->load->library("email");

        $this->email->from('armandomaviee@gmail.com','Sistema de Gestão de Documentos');
        $this->email->to("momad.s@misau.gov.mz");
        $this->email->subject('Notificação: Correspondência Urgente Recebida ');
        $this->email->message('Caro Usuario!  uma Correspondência de prioridade Urgente foi tramitada para sua Dirreção!');


        for ($i=1; $i <=1 ; $i++) { 
            if ($this->email->send()) {
                echo "Enviado com sucesso";
            }else{
                show_error($this->email->print_debugger());
            }
            sleep(1);
        }
        
    }


}

/* End of file arquivos.php */
/* Location: ./application/controllers/arquivos.php */

//      1/001.2/DPC/17
//      1/001.2/DPC/1
