<?php 
$direcoes=$this->session->userdata('local_direcoes'); 
$departamentos=$this->session->userdata('local_departamentos'); 
$reparticoes=$this->session->userdata('local_reparticoes');

 ?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
<title>SIGDOC</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="imagem/png" href="<?php echo base_url();?>/assets/img/icon.png" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" /> 

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>

<script>
$(document).ready(function(){
  $("#pesquisa").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="">Sigdoc</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav" >
   
    <li class=""><a title="" href="<?php echo site_url();?>/sigdoc/minhaConta"><i class="icon icon-user"></i> <span class="text">Minha Conta</span></a></li>
    <li class="pull-right"><a href="#"><i class="icon icon-asterisk"></i> <span class="text">Versão: <?php echo $this->config->item('app_version'); ?></span></a></li>
  </ul>

</div>


<div id="usuario" class="text">
  <li class="icon-user">
    BEM VINDO: <?php echo $this->session->userdata('nome');
    if ($direcoes<>" " and $departamentos==0 and $reparticoes==0) {    
     echo' (';
    echo $this->session->userdata('nome_direcoes'); 
    echo')';}
    
    else if ($direcoes<>" " and $departamentos<>" " and $reparticoes==0) {    
     echo' (';
    echo $this->session->userdata('nome_departamentos'); 
    echo')';}
    
    else if ($direcoes<>" " and $departamentos<>" " and $reparticoes<>" ") {    
    echo' (';
    echo $this->session->userdata('nome_reparticoes'); 
    echo')';}
    ?> </li>
  </li>
</div>

<div id="sair">
  <form action="<?php echo base_url()?>index.php/sigdoc/sair">
    <button type="submit"  class="btn btn-danger" title="Sair"><i class="icon-off"></i></button>
  </form>
</div

<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i> Menu</a>
  <ul>
<li style="font-size: 20px; color: black;" class="<?php if(isset($menuPainel)){echo 'active';};?>"><a href="<?php echo base_url()?>"><i class="icon icon-home"></i> <span> <b>Dashboard</b> </span></a></li>

<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vCorrespondencia')){ ?>
        <li class="<?php if(isset($menuCorrespondencias));?>"><a href="<?php echo base_url()?>index.php/correspondencias/gerenciar"><i class="icon icon-plus-sign"></i> <span>Adicionar Ostensiva</span></a></li>
    <?php } ?>

    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estEstado')){ ?>
        <li class="<?php if(isset($menuCorrespondencias));?>"><a href="<?php echo base_url()?>index.php/correspondencias/listaSigiloso"><i class="icon icon-plus-sign"></i> <span>Adicionar Sigilosa</span></a></li>
    <?php } ?>

   <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estPendente')){ //corrigir premissao estado recebida?>
        <li class="<?php if(isset($menuRecebida));?>"><a href="<?php echo base_url()?>index.php/correspondencias/recebida"><i class="icon icon-envelope"></i> <span> Entradas</span> <span class="label label-primary pull-right" style="background-color: red; border-radius: 10px; border:1px solid white;">
          <?php 
              $this->db->select('*');
              $this->db->from('tramitar');
              $this->db->where('direcoes_id',$direcoes);                
              $this->db->where('estadoPar',0);
              $this->db->where('estadoDes',0);                

              $query = $this->db->get();
                echo $query->num_rows();
                   ?>
        </span></a></li>
    <?php } ?>


<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estEstado')){ ?>
        <li class="<?php if(isset($menuCorrespondencias));?>"><a href="<?php echo base_url()?>index.php/correspondencias/estadosOstensivo"><i class="icon icon-eye-open"></i> <span>Saidas</span></a></li>
    <?php } ?>


  <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estDespacho')){ ?>
        <li class="<?php if(isset($menuCorrespondencias));?>"><a href="<?php echo base_url()?>index.php/correspondencias/pareceres_feitos"><i class="icon icon-retweet"></i> <span>Meus Pareceres</span>
        <!-- <span class="label label-primary pull-right" style="background-color: yellow; border-radius: 10px; border:1px solid white;">
          <?php 
              $this->db->select('*');
              $this->db->from('parecer');
              $this->db->where('direcoes_id',$direcoes);                            
              $query = $this->db->get();
                echo $query->num_rows();
                   ?>
        </span> -->
        </a></li>
    <?php } ?>

  <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estDespacho')){ ?>
        <li class="<?php if(isset($menuCorrespondencias));?>"><a href="<?php echo base_url()?>index.php/correspondencias/despachos_feitos"><i class="icon icon-book"></i> <span>Meus Despachos</span>
        </a></li>
    <?php } ?>


    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cUsuario')  || $this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente') || $this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao') || $this->permission->checkPermission($this->session->userdata('permissao'),'cBackup')){ ?>
        <li class="submenu <?php if(isset($menuConfiguracoes)){/*echo 'active';*/};?>">
          <a href="#"><i class="icon icon-cog"></i> <span>Conf. Correspondencia.</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
          <ul>
             <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vDirecao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/direcao">Direcções</a></li>
            <?php } ?>

             <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vDepartamento')){ ?>
                <li><a href="<?php echo base_url()?>index.php/departamento">Departamentos</a></li>
            <?php } ?>
            
             <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vReparticao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/reparticao">Repartições</a></li>
            <?php } ?>

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/pro_externa">Proviniencia Externa</a></li>
            <?php } ?>

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/pro_singulares">Proviniencia Singular</a></li>
            <?php } ?>

              <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vTipoDoc')){ ?>
                <li><a href="<?php echo base_url()?>index.php/tipo_doc">Tipo Documentos</a></li>
            <?php } ?>

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/classificador">Classificador</a></li>
            <?php } ?>

 
          </ul>
        </li>
    <?php } ?>


    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cUsuario')  || $this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente') || $this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao') || $this->permission->checkPermission($this->session->userdata('permissao'),'cBackup')){ ?>
        <li class="submenu <?php if(isset($menuConfiguracoes)){/*echo 'active';*/};?>">
          <a href="#"><i class="icon icon-cog"></i> <span>Conf. Usuário</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
          <ul>        


           <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/permissoes">Permissões</a> </li>
            <?php } ?> 

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cUsuario')){ ?>
                <li><a href="<?php echo base_url()?>index.php/usuarios/">Usuários</a></li>
            <?php } ?> 

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vTipoDoc')){ ?>
                <li><a href="<?php echo base_url()?>index.php/cargo">Cargo</a></li>
            <?php } ?>

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vTipoDoc')){ ?>
                <li><a href="<?php echo base_url()?>index.php/destinatario">Destinatario</a></li>
            <?php } ?>                     


          </ul>
        </li>
    <?php } ?>
    

    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cUsuario')  || $this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente') || $this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao') || $this->permission->checkPermission($this->session->userdata('permissao'),'cBackup')){ ?>
        <li class="submenu <?php if(isset($menuConfiguracoes)){/*echo 'active';*/};?>">
          <a href="#"><i class="icon icon-cog"></i> <span>Conf. Sistema</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
          <ul>
          <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){ ?>
              <li><a href="<?php echo base_url()?>index.php/sigdoc/emitente">Logotipo</a></li>
                  <?php } ?>

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vClassificacao')){ ?>
            <li><a href="<?php echo base_url()?>index.php/relatorios/correspondencias">Relatorio</a></li>
            <?php } ?>
        

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cBackup')){ ?>
                <li><a href="<?php echo base_url()?>index.php/sigdoc/backup">Backup</a></li>
            <?php } ?>                
 
          </ul>
        </li>
    <?php } ?>
    
  </ul>
</div>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url()?>" title="Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <?php if($this->uri->segment(1) != null){?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1)?>" class="tip-bottom" title="<?php echo ucfirst($this->uri->segment(1));?>"><?php echo ucfirst($this->uri->segment(1));?></a> <?php if($this->uri->segment(2) != null){?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>"><?php echo ucfirst($this->uri->segment(2));} ?></a> <?php }?></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
          <?php if($this->session->flashdata('error') != null){?>
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo $this->session->flashdata('error');?>
                           </div>
                      <?php }?>

                      <?php if($this->session->flashdata('success') != null){?>
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo $this->session->flashdata('success');?>
                           </div>
                      <?php }?>
                          
                      <?php if(isset($view)){echo $this->load->view($view, null, true);}?>


      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<div style="font-size: 12px; color:white; text-align: center" class="row-fluid">
  <div id="footer" class="span12"><?php echo date('Y'); ?> &copy; Sigdoc - Sistema de Gestão de Documentos</div>
</div>
<!--end-Footer-part-->


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script> 

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/59b8f1c14854b82732fefbda/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

  
<!-- Modal -->
<div id="modal-verificar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/verificar/" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Sair</h5>
  </div>

    <div class="modal-body">
     <input type="hidden" id="estadoVer" name="estadoVer" value="SIM" />
     <input type="hidden" id="idCorrespondencia" name="id" value="<?php echo('id') ?>"  />
    <h5 style="text-align: center">Tem a certeza que pretende sair do sistema?</h5>
     </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Não</button>
    <button class="btn btn-danger">Sim</button>
  </div>
  </form>
</div>

</body>
</html>







