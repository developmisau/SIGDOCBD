<?php

class Permissoes extends CI_Controller {
  
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

      if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao')){
        $this->session->set_flashdata('error','Você não tem permissão para configurar as permissões no sistema.');
        redirect(base_url());
      }

      $this->load->helper(array('form', 'codegen_helper'));
      $this->load->model('permissoes_model', '', TRUE);
      $this->load->model('usuarios_model', '', TRUE);
      $this->data['menuConfiguracoes'] = 'Permissões';
  }
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){
        
        //$this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/permissoes/gerenciar/';
        $config['total_rows'] = $this->permissoes_model->count('permissoes');
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

       // $this->pagination->initialize($config); 	

		  $this->data['results'] = $this->permissoes_model->get('permissoes','idPermissao,nome,data,situacao','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'permissoes/permissoes';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
	
    function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $nomePermissao = $this->input->post('nome');
            $cadastro = date('Y-m-d');
            $situacao = 1;

            $permissoes = array(

                  'aCorrespondencia' => $this->input->post('aCorrespondencia'),
                  'eCorrespondencia' => $this->input->post('eCorrespondencia'),
                  'dCorrespondencia' => $this->input->post('dCorrespondencia'),
                  'vCorrespondencia' => $this->input->post('vCorrespondencia'),

                  'iProtocolo' => $this->input->post('iProtocolo'),
                  'tCorrespondencia' => $this->input->post('tCorrespondencia'),
                  'pCorrespondencia' => $this->input->post('pCorrespondencia'),
                  'despCorrespondencia' => $this->input->post('despCorrespondencia'),

                  'confRecepcao' => $this->input->post('confRecepcao'),
                  'detCorrespondencia' => $this->input->post('detCorrespondencia'),
                  'iCorrespondencia' => $this->input->post('iCorrespondencia'),
                  'Relatorios' => $this->input->post('Relatorios'),
                  
                  'estEstado' => $this->input->post('estEstado'),
                  'estDespacho' => $this->input->post('estDespacho'),
                  'estRecebido' => $this->input->post('estRecebido'),
                  'estPendente' => $this->input->post('estPendente'),
                  

                  'vTipoDoc' => $this->input->post('vTipoDoc'),
                  'eTipoDoc' => $this->input->post('eTipoDoc'),
                  'dTipoDoc' => $this->input->post('dTipoDoc'),
                  'vTipoDoc' => $this->input->post('vTipoDoc'),

                  'aDepartamento' => $this->input->post('aDepartamento'),
                  'eDepartamento' => $this->input->post('eDepartamento'),
                  'dDepartamento' => $this->input->post('dDepartamento'),
                  'vDepartamento' => $this->input->post('vDepartamento'),

                  'aReparticao' => $this->input->post('aReparticao'),
                  'eReparticao' => $this->input->post('eReparticao'),
                  'dReparticao' => $this->input->post('dReparticao'),
                  'vReparticao' => $this->input->post('vReparticao'),

                  'cUsuario' => $this->input->post('cUsuario'),
                  'cEmitente' => $this->input->post('cEmitente'),
                  'cPermissao' => $this->input->post('cPermissao'),
                  'cBackup' => $this->input->post('cBackup'),

                  'aClassificacao' => $this->input->post('aClassificacao'),
                  'eClassificacao' => $this->input->post('eClassificacao'),
                  'dClassificacao' => $this->input->post('dClassificacao'),
                  'vClassificacao' => $this->input->post('vClassificacao'),
                  

            );
            $permissoes = serialize($permissoes);

            $data = array(
                'nome' => $nomePermissao,
                'data' => $cadastro,
                'permissoes' => $permissoes,
                'situacao' => $situacao
            );

            if ($this->permissoes_model->add('permissoes', $data) == TRUE) {

                $this->session->set_flashdata('success', 'Permissão adicionada com sucesso!');
                redirect(base_url() . 'index.php/permissoes/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'permissoes/adicionarPermissao';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $nomePermissao = $this->input->post('nome');
            $situacao = $this->input->post('situacao');
            $permissoes = array(

                  'aCorrespondencia' => $this->input->post('aCorrespondencia'),
                  'eCorrespondencia' => $this->input->post('eCorrespondencia'),
                  'dCorrespondencia' => $this->input->post('dCorrespondencia'),
                  'vCorrespondencia' => $this->input->post('vCorrespondencia'),

                  'iProtocolo' => $this->input->post('iProtocolo'),
                  'tCorrespondencia' => $this->input->post('tCorrespondencia'),
                  'pCorrespondencia' => $this->input->post('pCorrespondencia'),
                  'despCorrespondencia' => $this->input->post('despCorrespondencia'),

                  'confRecepcao' => $this->input->post('confRecepcao'),
                  'detCorrespondencia' => $this->input->post('detCorrespondencia'),
                  'iCorrespondencia' => $this->input->post('iCorrespondencia'),
                  'Relatorios' => $this->input->post('Relatorios'),
                  
                  'estEstado' => $this->input->post('estEstado'),
                  'estDespacho' => $this->input->post('estDespacho'),
                  'estRecebido' => $this->input->post('estRecebido'),
                  'estPendente' => $this->input->post('estPendente'),
                  

                  'vTipoDoc' => $this->input->post('vTipoDoc'),
                  'eTipoDoc' => $this->input->post('eTipoDoc'),
                  'dTipoDoc' => $this->input->post('dTipoDoc'),
                  'vTipoDoc' => $this->input->post('vTipoDoc'),

                  'aDirecao' => $this->input->post('aDirecao'),
                  'eDirecao' => $this->input->post('eDirecao'),
                  'dDirecao' => $this->input->post('dDirecao'),
                  'vDirecao' => $this->input->post('vDirecao'),

                  'aDepartamento' => $this->input->post('aDepartamento'),
                  'eDepartamento' => $this->input->post('eDepartamento'),
                  'dDepartamento' => $this->input->post('dDepartamento'),
                  'vDepartamento' => $this->input->post('vDepartamento'),

                  'aReparticao' => $this->input->post('aReparticao'),
                  'eReparticao' => $this->input->post('eReparticao'),
                  'dReparticao' => $this->input->post('dReparticao'),
                  'vReparticao' => $this->input->post('vReparticao'),

                  'cUsuario' => $this->input->post('cUsuario'),
                  'cEmitente' => $this->input->post('cEmitente'),
                  'cPermissao' => $this->input->post('cPermissao'),
                  'cBackup' => $this->input->post('cBackup'),

                  'aClassificacao' => $this->input->post('aClassificacao'),
                  'eClassificacao' => $this->input->post('eClassificacao'),
                  'dClassificacao' => $this->input->post('dClassificacao'),
                  'vClassificacao' => $this->input->post('vClassificacao'),
                  

            );
            $permissoes = serialize($permissoes);

            $data = array(
                'nome' => $nomePermissao,
                'permissoes' => $permissoes,
                'situacao' => $situacao
            );

            if ($this->permissoes_model->edit('permissoes', $data, 'idPermissao', $this->input->post('idPermissao')) == TRUE) {
                $this->session->set_flashdata('success', 'Permissão editada com sucesso!');
                redirect(base_url() . 'index.php/permissoes/editar/'.$this->input->post('idPermissao'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->permissoes_model->getById($this->uri->segment(3));

        $this->data['view'] = 'permissoes/editarPermissao';
        $this->load->view('tema/topo', $this->data);

    }
	
    function excluir(){

        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir Permissão.');            
            redirect(base_url().'index.php/permissoes/gerenciar/');
        }
        $premissao=0;
        $data = array(
                'permissoes_id' => $premissao
                );

        if ($this->usuarios_model->edit('usuarios', $data, 'idUsuarios', $id) == TRUE) {
         $this->permissoes_model->delete('permissoes','idPermissao',$id);             
        
        $this->session->set_flashdata('success','Permissão excluida com sucesso!');
        }

                    
        redirect(base_url().'index.php/permissoes/gerenciar/');
    }
}


/* End of file permissoes.php */
/* Location: ./application/controllers/permissoes.php */