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
if(empty($resultsTra) and !$resultsPar){?>

<div class="span12" style="margin-left: 0">
        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
            </span>
            <h5>Entrada de Correspondência</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Correspondência</th>
<!--                         <th>Ref. Recepção</th> -->
                        <th>Assunto</th>
                        <th>Data Entrada</th>
                        <th>Data Envio</th>
                        <th>Acção</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhuma Correspondência Recebida</td>
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
            <h5>Entrada - Correspondência</h5>

         </div>

    <div class="widget-content nopadding">


    <table class="table table-bordered ">
        <thead>
            <tr>
              
                        <th>Correspondência</th>
<!--                     <th>Ref. Recepção</th> -->
                        <th>Assunto</th>
                        <th>Data Entrada</th>
                        <th>Data Envio</th>
                        <th colspan="3">Acção</th>
                        
            </tr>
        </thead>
        <tbody id="myTable">

    <?php  
   foreach ($resultsTra as $r) {              
                
 if ($direcoes<>" " and $departamentos==0 and $reparticoes==0) {
  if ($r->estadoTra==1 and $r->estadoPar==0 and  $r->estadoDes==0 and $r->direcoes_id==$direcoes ) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    echo '<td>'.$r->assunto.'</td>'; 
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
                    
                    echo '<td>';
                      if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                            echo '<a href="'.base_url().'index.php/correspondencias/visualizar_dados/'.$r->correspondencias_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>';                     
                        } 
                    echo  '</td>';

                    echo "<td>";
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
                         echo '<a href="#modal-parecer" style="margin-right: 1%" role="button" data-toggle="modal" idTramite="'.$r->id.'" correspondenciaPar="'.$r->correspondencias.'" idCorrespondenciasPar="'.$r->correspondencias_id.'" tipo_pro="'.$r->tipo_pro.'" class="btn btn-warning tip-top" title="Parecer"><i class=icon-arrow-right icon-white"></i></a>';
                    }
                echo  '</td>';

                echo "<td>";
                if($this->permission->checkPermission($this->session->userdata('permissao'),'despCorrespondencia')){
                        echo '<a href="#modal-despacho" style="margin-right: 1%" role="button" data-toggle="modal" idTramiteDes="'.$r->id.'" correspondenciaDes="'.$r->correspondencias.'" idCorrespondenciasDes="'.$r->correspondencias_id.'" tipo_proDes="'.$r->tipo_pro.'" class="btn btn-danger tip-top" title="Despacho"><i class="icon-pencil icon-white"></i></a>'; 
                    }

                echo  '</td>';


            echo '</tr>';
            }
        }//fechar a primeira condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes==0) {
if ($r->estadoTra==1 and $r->estadoPar==0 and $r->estadoDes==0 and $r->direcoes_id==$direcoes and $r->departamentos_id==$departamentos) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    // echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
               
                echo '<td>';
                    
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar_dados/'.$r->correspondencias_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    }             
                 if($this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
                         echo '<a href="#modal-parecer" style="margin-right: 1%" role="button" data-toggle="modal" idTramite="'.$r->id.'" correspondenciaPar="'.$r->correspondencias.'" idCorrespondenciasPar="'.$r->correspondencias_id.'" tipo_pro="'.$r->tipo_pro.'" class="btn btn-warning tip-top" title="Parecer"><i class=icon-arrow-right icon-white"></i></a>';
                    }
                   if($this->permission->checkPermission($this->session->userdata('permissao'),'despCorrespondencia')){
                        echo '<a href="#modal-despacho" style="margin-right: 1%" role="button" data-toggle="modal" idTramiteDes="'.$r->id.'" correspondenciaDes="'.$r->correspondencias.'" idCorrespondenciasDes="'.$r->correspondencias_id.'" tipo_proDes="'.$r->tipo_pro.'" class="btn btn-danger tip-top" title="Despacho"><i class="icon-pencil icon-white"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iProtocolo')){
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
        }//fechar a segunda condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes<>" ") {
  if ($r->estadoTra==1 and $r->estadoPar==0 and $r->estadoDes==0 and $r->direcoes_id==$direcoes and $r->departamentos_id==$departamentos and $r->reparticoes_id==$reparticoes) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    // echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
               
                echo '<td>';
               
                   
                    // if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                    //     echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Baixar"><i class="icon-print"></i></a>'; 
                    // }      
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar_dados/'.$r->correspondencias_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    }             
                 if($this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
                         echo '<a href="#modal-parecer" style="margin-right: 1%" role="button" data-toggle="modal" idTramite="'.$r->id.'" correspondenciaPar="'.$r->correspondencias.'" idCorrespondenciasPar="'.$r->correspondencias_id.'" tipo_pro="'.$r->tipo_pro.'" class="btn btn-warning tip-top" title="Parecer"><i class=icon-arrow-right icon-white"></i></a>';
                    }
                   if($this->permission->checkPermission($this->session->userdata('permissao'),'despCorrespondencia')){
                        echo '<a href="#modal-despacho" style="margin-right: 1%" role="button" data-toggle="modal" idTramiteDes="'.$r->id.'" correspondenciaDes="'.$r->correspondencias.'" idCorrespondenciasDes="'.$r->correspondencias_id.'" tipo_proDes="'.$r->tipo_pro.'" class="btn btn-danger tip-top" title="Despacho"><i class="icon-pencilt icon-white"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iProtocolo')){
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
        }//fechar a terceira condicao
    }
//Correspondencias com Parecer
foreach ($resultsPar as $r) {              
                
 if ($direcoes<>" " and $departamentos==0 and $reparticoes==0) {
  if ($r->estadoPar==1 and $r->estadoPar2==0 and $r->estadoDes2==0 and $r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    echo '<td>'.$r->assunto.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
               
                echo '<td>';
                  
                    // if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                    //     echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Baixar"><i class="icon-print"></i></a>'; 
                    // } 
                 if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar_dados/'.$r->correspondencias_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    }             
                 if($this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
                         echo '<a href="#modal-parecer" style="margin-right: 1%" role="button" data-toggle="modal" idTramite="'.$r->id.'" correspondenciaPar="'.$r->correspondencias.'" idCorrespondenciasPar="'.$r->correspondencias_id.'" tipo_pro="'.$r->tipo_pro.'" class="btn btn-warning tip-top" title="Parecer"><i class=icon-arrow-right icon-white"></i></a>';
                    }
                   if($this->permission->checkPermission($this->session->userdata('permissao'),'despCorrespondencia')){
                        echo '<a href="#modal-despacho" style="margin-right: 1%" role="button" data-toggle="modal" idTramiteDes="'.$r->id.'" correspondenciaDes="'.$r->correspondencias.'" idCorrespondenciasDes="'.$r->correspondencias_id.'" tipo_proDes="'.$r->tipo_pro.'" class="btn btn-danger tip-top" title="Despacho"><i class="icon-pencilt icon-white"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iProtocolo')){
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
else if  ($direcoes<>" "  and $departamentos<>" " and $reparticoes==0) {
if ($r->estadoPar==1 and $r->estadoPar2==0 and $r->estadoDes2==0 and $r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    echo '<td>'.$r->assunto.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_tramitar.'</td>'; 
               
                echo '<td>';
                    
                    // if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                    //     echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Baixar"><i class="icon-print"></i></a>'; 
                    // } 
                     if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar_dados/'.$r->correspondencias_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    }             
                 if($this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
                         echo '<a href="#modal-parecer" style="margin-right: 1%" role="button" data-toggle="modal" idTramite="'.$r->id.'" correspondenciaPar="'.$r->correspondencias.'" idCorrespondenciasPar="'.$r->correspondencias_id.'" tipo_pro="'.$r->tipo_pro.'" class="btn btn-warning tip-top" title="Parecer"><i class=icon-arrow-right icon-white"></i></a>';
                    }
                   if($this->permission->checkPermission($this->session->userdata('permissao'),'despCorrespondencia')){
                        echo '<a href="#modal-despacho" style="margin-right: 1%" role="button" data-toggle="modal" idTramiteDes="'.$r->id.'" correspondenciaDes="'.$r->correspondencias.'" idCorrespondenciasDes="'.$r->correspondencias_id.'" tipo_proDes="'.$r->tipo_pro.'" class="btn btn-danger tip-top" title="Despacho"><i class="icon-pencilt icon-white"></i></a>'; 
                    }
                echo  '</td>';
                echo '</tr>';
            }
        }//fechar a segunda condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes<>" ") {
  if ($r->estadoPar==1 and $r->estadoPar2==0 and $r->estadoDes2==0  and $r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                    echo '<tr>';
                    echo '<td>'.$r->correspondencias.'</td>';
                    echo '<td>'.$r->assunto.'</td>';
                    echo '<td>'.$r->refRec.'</td>';
                    echo '<td>'.$r->date.'</td>'; 
                    echo '<td>'.$r->data_parecer.'</td>'; 
               
                echo '<td>';
               
                   
                    // if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                    //     echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Baixar"><i class="icon-print"></i></a>'; 
                    // } 
                     if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizar_dados/'.$r->correspondencias_id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    }             
                 if($this->permission->checkPermission($this->session->userdata('permissao'),'pCorrespondencia')){
                         echo '<a href="#modal-parecer" style="margin-right: 1%" role="button" data-toggle="modal" idTramite="'.$r->id.'" correspondenciaPar="'.$r->correspondencias.'" idCorrespondenciasPar="'.$r->correspondencias_id.'" tipo_pro="'.$r->tipo_pro.'" class="btn btn-warning tip-top" title="Parecer"><i class=icon-arrow-right icon-white"></i></a>';
                    }
                   if($this->permission->checkPermission($this->session->userdata('permissao'),'despCorrespondencia')){
                        echo '<a href="#modal-despacho" style="margin-right: 1%" role="button" data-toggle="modal" idTramiteDes="'.$r->id.'" correspondenciaDes="'.$r->correspondencias.'" idCorrespondenciasDes="'.$r->correspondencias_id.'" tipo_proDes="'.$r->tipo_pro.'" class="btn btn-danger tip-top" title="Despacho"><i class="icon-pencilt icon-white"></i></a>'; 
                    }
                  if($this->permission->checkPermission($this->session->userdata('permissao'),'iProtocolo')){
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
 
<!-- Modal Parecer-->
<div id="modal-parecer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/correspondencias/parecer" id="parecer" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Parecer Correspondência</h5>
  </div>

  <label style="padding-top: 20px; margin-left: 10px;" for="observacao" class="control-label">Dados da Correspondência:</label>
                     
  
    <input style="border: 0; margin-left: 10px;" type="text"  disabled id="correspondenciaPar">

     <input style="border: 0;margin-left: 10px;" type="text"  disabled id="tipo_pro">

  <div  class="control-group" >
                
   <div class="controls" style="padding-top: 20px; margin-left: 10px;">
                    <select name="direcoes" id="direcoes" style="  width: 145px; margin-right: 10px;">
                     <option disabled selected >Selecione Direção</option>
                <?php foreach ($resultDir as $dir) {
                                   
                   
            echo '<option value="'.$dir->id.'">'.$dir->abreviatura.'</option>'; } ?>
                
                            </select>

                 <select name="departamentos" id="departamentos" style="width: 190px; margin-right: 10px;"  disabled="">
                            <option value="">Selecione Departamento </option>
                    </select>

                <select name="reparticoes" id="reparticoes" style="width:170px ; margin-right: 10px;"  disabled="">
                            <option value="">Selecione Reparticao</option>
                    </select>
                
                </div>  

    <input type="hidden" id="idTramite" name="tramitar_id" /><!-- id da tramitacao-->
    <input type="hidden" id="idCorrespondenciasPar" name="correspondencias_id" /><!-- id da correspondencia-->
    <input type="hidden" id="usuarios"  name="usuarios" value="<?php  echo $this->session->userdata('id'); ?>"  /> 

    <input  type="hidden" name="local_direcoes_id" value="<?php  echo $this->session->userdata('local_direcoes'); ?>" />
   <input type="hidden" name="local_departamentos_id" value="<?php  echo $this->session->userdata('local_departamentos'); ?>" />
  <input type="hidden" name="local_reparticoes_id" value="<?php  echo $this->session->userdata('local_reparticoes'); ?>" />     
 
    <label style="margin-left: 10px;" for="parecer" class="control-label">Parecer</label>
        <div class="controls">
       <textarea style="width: 500px; margin-left:10px;" rows="3" cols="30" name="parecer" id="parecer" ></textarea>
        </div>  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Parecer</button>
  </div>
  </form>
</div>

<!-- Modal Parecer 2-->
<div id="modal-parecer2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/correspondencias/parecer2" id="parecer2" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Parecer Correspondência</h5>
  </div>

  <label style="padding-top: 20px; margin-left: 10px;" for="observacao" class="control-label">Dados da Correspondência:</label>
                     
  
    <input style="border: 0; margin-left: 10px;" type="text"  disabled id="correspondenciaPar2">

     <input style="border: 0;margin-left: 10px;" type="text"  disabled id="tipo_pro2">

  <div  class="control-group" >
                
   <div class="controls" style="padding-top: 20px; margin-left: 10px;">
                    <select name="direcoes" id="direcoes2" style="  width: 145px; margin-right: 10px;">
                     <option disabled selected >Selecione Direção</option>
                <?php foreach ($resultDir as $dir) {
                                   
                   
            echo '<option value="'.$dir->id.'">'.$dir->abreviatura.'</option>'; } ?>
                
                            </select>

                 <select name="departamentos" id="departamentos2" style="width: 190px; margin-right: 10px;">
                            <option value="">Selecione Departamento </option>
                    </select>

                <select name="reparticoes" id="reparticoes2" style="width:170px ; margin-right: 10px;">
                            <option value="">Selecione Reparticao</option>
                    </select>
                
                </div>  

    <input type="hidden" id="idTramite2" name="tramitar_id" /><!-- id da tramitacao-->
    <input type="hidden" id="idParecer" name="parecer_id" /><!-- id do parecer-->
    <input type="hidden" id="idCorrespondenciasPar2" name="correspondencias_id" /><!-- id da correspondencia-->

    <input type="hidden" id="usuarios"  name="usuarios" value="<?php  echo $this->session->userdata('id'); ?>"  />  

    <input  type="hidden" name="local_direcoes_id" value="<?php  echo $this->session->userdata('local_direcoes'); ?>" />
   <input type="hidden" name="local_departamentos_id" value="<?php  echo $this->session->userdata('local_departamentos'); ?>" />
  <input type="hidden" name="local_reparticoes_id" value="<?php  echo $this->session->userdata('local_reparticoes'); ?>" />          
 
    <label style="margin-left: 10px;" for="parecer" class="control-label">Parecer</label>
        <div class="controls">
       <textarea style="width: 500px; margin-left:10px;" rows="3" cols="30" name="parecer" id="parecer" ></textarea>
        </div>  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Parecer</button>
  </div>
  </form>
</div>

<!-- Modal Despacho-->
<div id="modal-despacho" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/correspondencias/despacho" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Despacho da Correspondência</h5>
  </div>

  <label style="padding-top: 20px; margin-left: 10px;" for="observacao" class="control-label">Dados da Correspondência:</label>
  
    <input style="border: 0; margin-left: 10px; width: 55%; text-align: center;" type="text"  disabled id="correspondenciaDes">

     <input style="border: 0;margin-left: 10px; width: 20%; text-align: center;" type="text"  disabled id="tipo_proDes">

    <input type="hidden" id="idTramiteDes" name="tramitar_id" />
    <input type="hidden" id="idParecerDes" name="parecer_id" />
    <input type="hidden" id="idCorrespondenciasDes" name="correspondencias_id" />
    <input type="hidden" name="direcoes_id" value="<?php  echo $this->session->userdata('local_direcoes'); ?>"  />
    <input type="hidden" name="departamentos_id" value="<?php  echo $this->session->userdata('local_departamentos'); ?>"  />
    <input type="hidden" name="reparticoes_id" value="<?php  echo $this->session->userdata('local_reparticoes'); ?>"  />
    <input type="hidden" id="usuarios"  name="usuarios" value="<?php  echo $this->session->userdata('id'); ?>"  />


   <div  style="margin-left: 10px; font-size: 15px;  ">
        <input type="checkbox" id="aguardarInstrucoes" name="aguardarInstrucoes" value="Aguardar Instruções"> Aguardar Instruções </input> &nbsp; &nbsp;&nbsp;
        <input type="checkbox" id="darSeguimento" name="darSeguimento" value="Dar Seguimento"> Dar Seguimento</input>  &nbsp; &nbsp; &nbsp;
        <input type="checkbox" id="prepararCarta" name="prepararCarta" value="Preparar Carta" style="margin-left: 16px; "> Preparar Carta</input>
   </div>

   <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="apreciar" name="apreciar" value="Apreciar"> Apreciar </input> 
        <input type="checkbox" id="devolver" name="devolver" value="Devolver" style="margin-left: 103px;"> Devolver</input>  
        <input type="checkbox" id="prepararResposta" name="prepararResposta" value="Preparar Resposta" style="margin-left: 91px;"> Preparar Resposta</input>
   </div>

   <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="aprovar" name="aprovar" value="Aprovar"> Aprovar </input> 
        <input type="checkbox" id="esclarecer" name="esclarecer" value="Esclarecer" style="margin-left: 106px;"> Esclarecer</input>  
        <input type="checkbox" id="providenciar" name="providenciar" value="Providenciar" style="margin-left: 81px;"> Providenciar</input>
   </div>

    <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="arquivar" name="arquivar" value="Arquivar"> Arquivar </input> 
        <input type="checkbox" id="enviarProcesso" name="enviarProcesso" value="Enviar Processo" style="margin-left: 103px;"> Enviar Processo</input>  

        <input type="checkbox" id="reter" name="reter" value="Reter Em S./Poder" style="margin-left: 41px; "> Reter Em S./Poder</input>
   </div>

     <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="assinar" name="assinar" value="Assinar"> Assinar </input> 
        <input type="checkbox" id="estudar" name="estudar" value="Estudar" style="margin-left: 112px;"> Estudar</input>  &nbsp; &nbsp; &nbsp;

        <input type="number" id="tirarCopias" name="tirarCopias"  style="margin-left: 75px; width: 28.5%; height: 6px; border-radius: 0.3em;" placeholder="Numero de Copias"> </input> 
   </div>

     <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px; ">
        <input type="checkbox" id="autorizar" name="autorizar" value="Autorizar"> Autorizar </input> 
        <input type="checkbox" id="falarComigo" name="falarComigo" value="Falar Comigo" style="margin-left: 99px;"> Falar Comigo</input>  



        <input type="number" id="tirarFotocopias" name="tirarFotocopias" value="Tirar Fotocopias" style="margin-left: 61px; width: 28.5%; height: 6px; border-radius: 0.3em;" placeholder="Numero de Fotocopias"> </input> 
   </div>

     <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="conferir" name="conferir" value="Conferir"> Conferir </input> 
        <input type="checkbox" id="habilitar" name="habilitar" value="Habilitar A Responder" style="margin-left: 107px;"> Habilitar A Responder</input>  

        <input type="checkbox" id="tomarConhecimento" name="tomarConhecimento" value="Tomar Conhecimento"> Tomar Conhecimento</input>
   </div>

     <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="confirmar" name="confirmar" value="Confirmar"> Confirmar </input> 
        <input type="checkbox" id="informar" name="informar" value="Informar" style="margin-left: 94px;"> Informar</input>  &nbsp; &nbsp; &nbsp;
        <input type="checkbox" id="traduzir" name="traduzir" value="Traduzir" style="margin-left: 68px;" > Traduzir</input>
   </div>

   <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="corrigir" name="corrigir" value="Corrigir"> Corrigir </input>
        <input type="checkbox" id="reuniao" name="reuniao" value="Marcar Reunião" style="margin-left: 113px;"> Marcar Reunião</input>  &nbsp; &nbsp; &nbsp;
        <input type="checkbox" id="visar" name="visar" value="Visar" style="margin-left: 19px;"> Visar</input>
   </div>

     <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="dactilografar" name="dactilografar" value="Dactilografar"> Dactilografar </input> &nbsp; &nbsp;&nbsp;
        <input type="checkbox" id="juntarProcesso" name="juntarProcesso" value="Juntar ao Processo" style="margin-left: 55px;"> Juntar Ao Processo </input>  &nbsp; &nbsp; &nbsp;
        <input type="checkbox" id="voltarProcesso" name="voltarProcesso" value="Voltar C/Processo"> Voltar C/Processo</input>
   </div>

     <div  style="margin-left: 10px; font-size: 15px; padding-top: 7px;">
        <input type="checkbox" id="darParecer" name="darParecer" value="Dar Parecer" > Dar Parecer </input> &nbsp; &nbsp;&nbsp;
        <input type="text" id="passarAoSr" name="passarAoSr" placeholder="Passar Ao Sr." style="border: 1; margin-left: 64px;  border-radius: 0.5em; width: 60%; height: 6%;" ></input>  &nbsp; &nbsp;
        
   </div>
                    
    
<!--     <div class="controls" style="margin-left: 10px">
    <input id="arquivo" type="file" name="userfile" >
    </div>  -->   
     &nbsp;            


    <label style="margin-left: 10px;" for="observacao" class="control-label">Observação</label>
        <div class="controls">
       <textarea style="width: 500px; margin-left:10px;" rows="3" cols="30" name="observacao" id="observacao" required></textarea>
        </div> 
   
  
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Despacho</button>
  </div>
  </form>
</div>

<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var idParecer = $(this).attr('idParecer');
        $('#idParecer').val(idParecer);

        var idTramite = $(this).attr('idTramite');
        $('#idTramite').val(idTramite);

        var idCorrespondenciasPar = $(this).attr('idCorrespondenciasPar');
        $('#idCorrespondenciasPar').val(idCorrespondenciasPar);

        var idCorrespondenciasPar2 = $(this).attr('idCorrespondenciasPar2');
        $('#idCorrespondenciasPar2').val(idCorrespondenciasPar2);

        var idTramite2 = $(this).attr('idTramite2');
        $('#idTramite2').val(idTramite2);
  
        var correspondenciaPar = $(this).attr('correspondenciaPar');
        $('#correspondenciaPar').val(correspondenciaPar);

        var tipo_pro = $(this).attr('tipo_pro');
        $('#tipo_pro').val(tipo_pro);

         var idParecer2 = $(this).attr('idParecer2');
        $('#idParecer2').val(idParecer2);
  
        var correspondenciaPar2 = $(this).attr('correspondenciaPar2');
        $('#correspondenciaPar2').val(correspondenciaPar2);

        var correspondenciaDes = $(this).attr('correspondenciaDes');
        $('#correspondenciaDes').val(correspondenciaDes);

        var tipo_pro2 = $(this).attr('tipo_pro2');
        $('#tipo_pro2').val(tipo_pro2);

        var tipo_proDes = $(this).attr('tipo_proDes');
        $('#tipo_proDes').val(tipo_proDes);

        var idCorrespondenciasDes = $(this).attr('idCorrespondenciasDes');
        $('#idCorrespondenciasDes').val(idCorrespondenciasDes);

        var idTramiteDes = $(this).attr('idTramiteDes');
        $('#idTramiteDes').val(idTramiteDes);

        var idParecerDes = $(this).attr('idParecerDes');
        $('#idParecerDes').val(idParecerDes);

   });



   $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});

</script>


<script type="text/javascript">

 //Combinacao de direcoes, departamentos e reparticoes.
 $(document).ready(function() {                       
                $("#direcoes").change(function() {
                    $("#direcoes option:selected").each(function() {  
                         direcoes = $('#direcoes').val();                    
                        $.post("<?php echo base_url(); ?>index.php/correspondencias/dirDep", {
                            direcoes : direcoes
                        }, function(data) {
                            $("#reparticoes").prop('disabled',true);
                            $("#reparticoes").prop('value','');
                            $("#departamentos").html(data);
                            $("#departamentos").removeAttr("disabled");
                        });
                    });
                });
            });

 $(document).ready(function() {                       
                $("#departamentos").change(function() {
                    $("#departamentos option:selected").each(function() {  
                         departamentos = $('#departamentos').val();                    
                        $.post("<?php echo base_url(); ?>index.php/correspondencias/depRep", {
                            departamentos : departamentos
                        }, function(data) {
                            $("#reparticoes").html(data);
                            $("#reparticoes").removeAttr("disabled");

                        });
                    });
                });
            });
</script>


<script type="text/javascript">

 //Combinacao de direcoes, departamentos e reparticoes.
 $(document).ready(function() {                       
                $("#direcoes2").change(function() {
                    $("#direcoes2 option:selected").each(function() {  
                         direcoes2 = $('#direcoes2').val();                    
                        $.post("<?php echo base_url(); ?>index.php/correspondencias/dirDep", {
                            direcoes : direcoes2
                        }, function(data) {
                            $("#reparticoes2").prop('disabled',true);
                            $("#reparticoes2").prop('value','');
                            $("#departamentos2").html(data);
                            $("#departamentos2").removeAttr("disabled");

                        });
                    });
                });
            });

 $(document).ready(function() {                       
                $("#departamentos2").change(function() {
                    $("#departamentos2 option:selected").each(function() {  
                         departamentos2 = $('#departamentos2').val();                    
                        $.post("<?php echo base_url(); ?>index.php/correspondencias/depRep", {
                            departamentos : departamentos2
                        }, function(data) {
                            $("#reparticoes2").html(data);
                            $("#reparticoes2").removeAttr("disabled");

                        });
                    });
                });
            });
</script>

<script  src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>

<script type="text/javascript">
      $(document).ready(function(){

           $('#parecer').validate({
            rules : {
                  direcoes:{ required: true},
                 
                  
            },
            messages: {
                  direcoes :{ required: 'Campo Requerido.'},
                  
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });

      });
</script>

<script type="text/javascript">
      $(document).ready(function(){

           $('#parecer2').validate({
            rules : {
                  direcoes:{ required: true},
                 
                  
            },
            messages: {
                  direcoes :{ required: 'Campo Requerido.'},
                  
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });

      });
</script>


