<?php 
$direcoes=$this->session->userdata('local_direcoes'); 
$departamentos=$this->session->userdata('local_departamentos'); 
$reparticoes=$this->session->userdata('local_reparticoes'); 
 ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo current_url(); ?>">
           
       <div class="span6">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Pesquisar ..." class="span12" value="<?php echo $this->input->get('pesquisa'); ?>" >        
        </div>
        <div class="span4">
            <input type="date" name="data"  id="data"  placeholder="Data de" class="span12 datepicker" value="<?php echo $this->input->get('data'); ?>">
            <input type="date" name="data2"  id="data2"  placeholder="Data até" class="span12 datepicker" value="<?php echo $this->input->get('data2'); ?>" >                
        </div>


        <div class="span2">
            <button class="span12 btn"> <i class="icon-search"></i> </button>
        </div>
    </form>
</div>

<?php
if(empty($resultsPar) ){?>

<div class="span12" style="margin-left: 0">
        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
            </span>
            <h5>Meus Pareceres</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Correspondência</th>
                        <th>Ref. Recepção</th>
                        <th>Data Entrada</th>
                        <th>Data Pareceres</th>
                        <th>Acção</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Parecer Efectuado!</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php }else{ ?>

<div class="span12" style="margin-left: 0">
    <div class="widget-box">
         <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
             </span>
            <h5>Meus Parceres</h5>

         </div>

    <div class="widget-content nopadding">


    <table class="table table-bordered ">
        <thead>
            <tr>
              
                        <th>Correspondência</th>
                        <th>Ref. Recepção</th>
                        <th>Data Entrada</th>
                        <th>Data Parecer</th>
                        <th>Acção</th>
                        
            </tr>
        </thead>
        <tbody id="myTable">

<?php 
//Correspondencias com Parecer
foreach ($resultsPar as $r) {              
                
 if ($direcoes<>" " and $departamentos==0 and $reparticoes==0) {
  if ($r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->numCorrespondencia.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_parecer.'</td>'; 
               
                echo '<td>';
                  

                  if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar_meus_pareceres/'.$r->idCorres.'/'.$r->parecer_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    } 
                if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                        if (empty($r->url)) {
                           echo '<i>Sem anexo</i>'; 
                        }
                        if (!empty($r->url)) {
                           echo '<a class="btn btn-info tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'"  class="btn btn-info tip-top"   title="Baixar"><i class="icon-download icon-white"></i></a>'; 
                        } 
                    }            
  
                echo  '</td>';
                echo '</tr>';
            }
        }//fechar a primeira condicao
else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes==0) {
if ($r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->numCorrespondencia.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
               
                echo '<td>';
                    
                   if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                       if (empty($r->url)) {
                           echo '<i>Sem anexo</i>'; 
                        }
                        if (!empty($r->url)) {
                           echo '<a class="btn btn-info tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'"  class="btn btn-info tip-top"   title="Baixar"><i class="icon-download icon-white"></i></a>'; 
                        }
                    }  
                  if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar_meus_pareceres/'.$r->id.'/'.$r->parecer_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    }           
                echo  '</td>';
                echo '</tr>';
            }
        }//fechar a segunda condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes<>" ") {
  if ($r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->numCorrespondencia.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_parecer.'</td>'; 
               
                echo '<td>';
               
                   
                if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                   if (empty($r->url)) {
                           echo '<i>Sem anexo</i>'; 
                        }
                    if (!empty($r->url)) {
                           echo '<a class="btn btn-info tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'"  class="btn btn-info tip-top"   title="Baixar"><i class="icon-download icon-white"></i></a>'; 
                        }
                    }  
                  if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar_meus_pareceres/'.$r->id.'/'.$r->parecer_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    }           
                echo  '</td>';
                echo '</tr>';
            }
        }//fechar a terceira condicao
    }

}
?>


            <tr>
                
            </tr>
        </tbody>
    </table>
    </div>
    </div>
</div>
</div>
 

