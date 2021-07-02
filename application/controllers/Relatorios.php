<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios extends CI_Controller{

    /**
     * author: Armando Mavie
     * email: armandomaviee@gmail.com
     * 
     */
    
    public function __construct() {
        parent::__construct();
        if( (!session_id()) || (!$this->session->userdata('logado'))){
            redirect('sigdoc/login');
        }
        
        $this->load->model('Relatorios_model','',TRUE);
        $this->load->model('Geral_model','',TRUE);
        $this->load->model('Classificador_model','',TRUE);
        $this->load->model('Correspondencias_model','',TRUE);
        $this->data['menuRelatorios'] = 'Relatórios';

    }

    public function correspondencias(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de correspondencias.');
           redirect(base_url());
        }
        $this->data['direcoes'] = $this->Geral_model->getActive('direcoes','*');
        $this->data['tipoDoc'] = $this->Geral_model->getActive('tipo_doc','*');
        $this->data['prioridades'] = $this->Geral_model->getActive('prioridades','*');
        $this->data['codigo'] = $this->Classificador_model->getActive('classificacao','*');


        $this->data['view'] = 'relatorios/rel_correspondencias';
       	$this->load->view('tema/topo',$this->data);

    }


    // public function correspondenciaRapid(){
    //     if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){
    //        $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios das Correspondencias.');
    //        redirect(base_url());
    //     }

    //     $data['correspondencia'] = $this->Relatorios_model->clientesRapid();

    //     $this->load->helper('mpdf');
    //     //$this->load->view('relatorios/imprimir/imprimirClientes', $data);
    //     $html = $this->load->view('relatorios/imprimir/imprimirClientes', $data, true);
    //     pdf_create($html, 'relatorio_clientes' . date('d/m/y'), TRUE);
    // }

    public function correspondenciasRapid(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de correspondencias.');
           redirect(base_url());
        }

        $data['correspondencias'] = $this->Relatorios_model->correspondenciasRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimircorrespondencias', $data);
        $html = $this->load->view('relatorios/imprimir/imprimircorrespondencias', $data, true);
        pdf_create($html, 'relatorio_correspondencias' . date('d/m/y'), TRUE);
    }

    public function correspondenciasRapidMin(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de correspondencias.');
           redirect(base_url());
        }

        $data['correspondencias'] = $this->Relatorios_model->correspondenciasRapidMin();

        $this->load->helper('mpdf');
        $html = $this->load->view('relatorios/imprimir/imprimircorrespondencias', $data, true);
        pdf_create($html, 'relatorio_correspondencias' . date('d/m/y'), TRUE);
        
    }

    public function correspondenciasCustom(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de correspondencias.');
           redirect(base_url());
        }

        $tipo_pro = $this->input->get('tipo_pro');
        

        $data['correspondencias'] = $this->Relatorios_model->correspondenciasCustom($tipo_pro);

        $this->load->helper('mpdf');
        $html = $this->load->view('relatorios/imprimir/imprimircorrespondencias', $data, true);
        pdf_create($html, 'relatorio_correspondencias' . date('d/m/y'), TRUE);
    }

   
}
