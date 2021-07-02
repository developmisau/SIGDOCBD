<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/dist/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/dist/jquery.jqplot.min.css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/js/dist/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dist/plugins/jqplot.donutRenderer.min.js"></script>

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">

          <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estEstado')){ ?>
            <li class="bg_db"> <a href="<?php echo base_url()?>index.php/correspondencias/"> <i class="icon-plus-sign"></i> Ostensivas </a> </li>
        <?php } ?>

        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estEstado')){ ?>
            <li class="bg_blue"> <a href="<?php echo base_url()?>index.php/correspondencias/listaSigiloso"> <i class="icon-plus-sign"></i>  Sigilosas </a> </li>
        <?php } ?>

          <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estEstado')){ ?>
            <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/correspondencias/recebida"> <i class="icon-envelope"></i> Entradas</a> </li>
        <?php } ?>
        
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estEstado')){ ?>
            <li class="bg_db"> <a href="<?php echo base_url()?>index.php/correspondencias/estadosOstensivo"> <i class="icon-eye-open"></i> Saidas</a> </li>
        <?php } ?> 

        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estEstado')){ ?>
            <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/correspondencias/pareceres_feitos"> <i class="icon-retweet"></i> Meus Pareceres</a> </li>
        <?php } ?>  

         <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'estEstado')){ ?>
            <li class="bg_blue"> <a href="<?php echo base_url()?>index.php/correspondencias/despachos_feitos"> <i class="icon-book"></i>Meus Despachos</a> </li>
        <?php } ?>         
               
        
        
        
        

      </ul>
    </div>
  </div>  
<!--End-Action boxes-->  


<div class="row-fluid" style="margin-top: 0"> 
    
 <div class="span12">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Correspondência Não Tramitada</h5></div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Correspondência</th>
                        <th>Prioridade</th>
                        <th>Tipo Proveniencia</th>
                        <th>Referência Recepção</th>
                        <th>Destinatário</th>
                        <th>Data Emissão</th>
                        <th>Acções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

 $direcoes=$this->session->userdata('local_direcoes'); 
 $departamentos=$this->session->userdata('local_departamentos'); 
 $reparticoes=$this->session->userdata('local_reparticoes'); 
                

foreach ($results as $r) {
  if ($direcoes<>" " and $departamentos==0 and $reparticoes==0) {
  if ($r->estadoTra=='0'and $r->local_direcoes_id==$direcoes ) {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->prioridades.'</td>';
                echo '<td>'.$r->tipo_pro.'</td>';
                echo '<td>'.$r->refRec.'</td>';
                echo '<td>'.$r->destinatario.'</td>';
                echo '<td>'.$r->date.'</td>';
               
               

                echo '<td>';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar/'.$r->id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    }
                    
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iProtocolo')){
                        echo '<a class="btn btn-info tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'"  class="btn btn-info tip-top"   title="Baixar"><i class="icon-download icon-white"></i></a>'; 
                    }
                    
                                        
                echo  '</td>';
                echo '</tr>';
            } 
  }//fecha a primeira condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes==0) {
if ($r->estadoTra=='0'and $r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos) {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->prioridades.'</td>';
                echo '<td>'.$r->tipo_pro.'</td>';
                echo '<td>'.$r->refRec.'</td>';
                echo '<td>'.$r->destinatario.'</td>';
                echo '<td>'.$r->date.'</td>';
               
               

                echo '<td>';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar/'.$r->id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    }
                    
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iProtocolo')){
                        echo '<a class="btn btn-info tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'"  class="btn btn-info tip-top"   title="Baixar"><i class="icon-download icon-white"></i></a>'; 
                    }
                    
                    
                   

                   
                echo  '</td>';
                echo '</tr>';
            } 
  }//fecha a segunda condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes<>" ") {
  if ($r->estadoTra=='0'and $r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->prioridades.'</td>';
                echo '<td>'.$r->tipo_pro.'</td>';
                echo '<td>'.$r->refRec.'</td>';
                echo '<td>'.$r->destinatario.'</td>';
                echo '<td>'.$r->date.'</td>';
               
               

                echo '<td>';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar/'.$r->id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    }
                    
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iProtocolo')){
                        echo '<a class="btn btn-info tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'"  class="btn btn-info tip-top"   title="Baixar"><i class="icon-download icon-white"></i></a>'; 
                    }
                    
                    
                   

                   
                echo  '</td>';
                echo '</tr>';
            } 
  }//fecha a terceira condicao

 }//fecha o ciclo
 

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Entrada de Correspondências</h5></div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Correspondência</th>
                        <th>Referência Recepção</th>
                        <th>Data Entrada</th>
                        <th>Data Envio</th>
                        <th>Acção</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                     
                        <?php 
                          foreach ($resultsTra as $r) {              
                
 if ($direcoes<>" " and $departamentos==0 and $reparticoes==0) {
  if ($r->estadoTra==1 and $r->estadoPar==0 and  $r->estadoDes==0 and $r->direcoes_id==$direcoes ) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
               
                echo '<td>';
                  
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                        echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Baixar"><i class="icon-print"></i></a>'; 
                    }              
      
                echo  '</td>';
                echo '</tr>';
            }
        }//fechar a primeira condicao
else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes==0) {
if ($r->estadoTra==1 and $r->estadoPar==0 and $r->estadoDes==0 and $r->direcoes_id==$direcoes and $r->departamentos_id==$departamentos) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
               
                echo '<td>';
                    
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                        echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Baixar"><i class="icon-print"></i></a>'; 
                    }              

                echo  '</td>';
                echo '</tr>';
            }
        }//fechar a segunda condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes<>" ") {
  if ($r->estadoTra==1 and $r->estadoPar==0 and $r->estadoDes==0 and $r->direcoes_id==$direcoes and $r->departamentos_id==$departamentos and $r->reparticoes_id==$reparticoes) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
               
                echo '<td>';
               
                   
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                        echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Baixar"><i class="icon-print"></i></a>'; 
                    }              
                      
                echo  '</td>';
                echo '</tr>';
            }
        }//fechar a terceira condicao
    }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>


