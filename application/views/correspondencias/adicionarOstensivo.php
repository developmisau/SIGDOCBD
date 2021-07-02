<?php 
$direcoes2=$this->session->userdata('local_direcoes'); 
$departamentos2=$this->session->userdata('local_departamentos'); 
$reparticoes2=$this->session->userdata('local_reparticoes'); 
 ?>
<!-- JS file -->
<script src=" <?php echo base_url(); ?>js/Autocomplete/dist/jquery.easy-autocomplete.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>

<!-- CSS file -->
<link rel="stylesheet" href="js/Autocomplete/dist/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="js/Autocomplete/dist/easy-autocomplete.themes.min.css"> 

<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-hdd"></i>
                </span>
                <h5>Adicionar Correspondência</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <?php 
                      if (isset($_REQUEST["r"])) {
                        //echo "erro encontrado";
                                              }
                 ?>
                <form action="<?php echo current_url(); ?>" id="formCorrespondencia" enctype="multipart/form-data" method="post" class="form-horizontal" >

                  <div class="control-group">
          <!--               <label  style=" font-weight: bold; font-size: 12px; color: white; width: 35%; text-align: center; color: red; background-color: transparent; border: 0;" class="control-label" > <?php echo  $ultimoId .'/'.'MISAU'.'/'.date('Y');  ?> </label> -->

                        <label style=" font-weight: bold; font-size: 14px; color: white; width: 35%; text-align: center; color: blue; background-color: transparent; border: 0;" class="control-label"> Nº de Correspondências: <?php 
                        if ($direcoes2<>0 and $departamentos2==0 and $reparticoes2==0) {
                                   echo $nrCorreSector.'/'.$this->session->userdata('abrev_direcoes').'/'.date('Y') ;
                                  } 
                                  else if ($direcoes2<>0 and $departamentos2<>0 and $reparticoes2==0) {
                                    echo $nrCorreSector.'/'.$this->session->userdata('abrev_direcoes').'/'.$this->session->userdata('abrev_departamentos').'/'.date('Y') ;
                                  }
                                  else if ($direcoes2<>0 and $departamentos2<>0 and $reparticoes2<>0) {
                                 echo $nrCorreSector.'/'.$this->session->userdata('abrev_direcoes').'/'.$this->session->userdata('abrev_departamentos').'/'.$this->session->userdata('abrev_reparticoes').'/'.date('Y') ;
                                  }


                         ?></label>



                        </div>
                        



          
    <div class="control-group" >
      <label  class="control-label" >Tipo Proviniência<span class="required">*</span></label>

    <label for="Interna" class="radio-inline control-label"> 
    <input type="radio" id="provinienciaInterna" name="tipo_pro" title="Interna" value="Interna"  <?php echo  set_radio('tipo_pro', 'Interna'); ?>> Interna </label>

    <label for="Externa" class="radio-inline control-label">
    <input type="radio"  id="provinienciaExterna" name="tipo_pro"  title="Externa" value="Externa" <?php echo  set_radio('tipo_pro', 'Externa'); ?> > Externa </label>

  </div>                       

                 <div class="control-group" id="sector_pro">
                        <label  class="control-label" >Proviniência Interna<span class="required">*</span></label>
                        <div class="controls">
                            <select name="direcoes" id="direcoes" disabled>
                            <option disabled selected >Selecione Direção</option>
                            <?php foreach ($direcoes as $dir) {                             
                              echo '<option value="'.$dir->id.'">'.$dir->abreviatura.'</option>';
                              } ?>
                
                            </select>

                            <select name="departamentos" id="departamentos" disabled>
                            <option value="">Selecione Departamentos </option>
                                  
                            </select>

                            <select name="reparticoes" id="reparticoes" disabled>
                            <option value="">Selecione Repartição</option>
                      
                            </select>
                        </div>
                        </div>
        
                    
          <div class="control-group" id="org_envio">
            <label for="codigo" class="control-label">Proviniência Externa</label>
          <div class="controls">
            <input style="width: 40.5%" id="externa" type="text" name="externa" value="<?php echo set_value('externa'); ?>" disabled />

              <input type="hidden" id="pro_externa_id"  name="pro_externa_id" value="<?php echo set_value('pro_externa_id'); ?>" readonly="true"  />

              <a href="#modal-provinienciaExterna" style="margin-right: 1%" role="button" data-toggle="modal" class="btn btn-warning tip-top" title="Adicionar Proviniência Externa"><i class=icon-plus icon-white></i></a>

              
              
                    </div>
        
                    </div>  

                    
                  <div class="control-group">
                        <label for="categorias" class="control-label"> Categoria* </label>
                        <div class="controls">
                      <select id="categorias" name="categorias" style="width: 42%;" >
                    <option disabled selected> Selecione Categoria</option>
                  <?php foreach ($categorias as $cat) { ?>                                   
                    <option value="<?php echo $cat->id ?>"
                              <?php echo  set_select('categorias', $cat->id); ?>>
                              <?php echo $cat->nome ?></option>

                                 <?php  } ?>
                        </select>
                   
                     
                        </div>
                    </div>                   


                     <div class="control-group">
                        <label  class="control-label">Tipo Documento<span class="required">*</span></label>
                        <div class="controls">
                        <select  name="tipo_doc" id="tipo_doc" style="width: 42%;" >
                            <option  disabled selected >Selecione Tipo de Documento</option>
                                  <?php foreach ($tipoDoc as $t) {?>                                   
                    <option value="<?php echo $t->id ?>"
                              <?php echo  set_select('tipo_doc', $t->id); ?>>
                              <?php echo $t->nome ?></option>

                                 <?php  } ?>
                            </select>


                        </div>
                    </div> 

                    <div class="control-group" >
                        <label  class="control-label" >Referência Documento<span class="required">*</span></label>



                        <div class="controls">                     

                    <label for="Interna" class="radio-inline control-label"> 
                    <input type="radio" id="com_ref" name="referencia"  title="Com Referência"> Com Referência </label>

                    <label for="Externa" class="radio-inline control-label">
                    <input type="radio"  id="sem_ref" name="referencia" title="Sem Referência" > Sem Referência </label></div>


                      </div>   



                 <div class="control-group" id="cf">
                        <label  class="control-label" >Com Referência<span class="required">*</span></label>
                          <div class="controls">
                            <input style="width: 40.5%;" name="cRef"  id="cRef" type="text" value="<?php echo set_value('cRef'); ?>" />
                        </div>
                        </div>        
                    
                <div class="control-group" id="sf">
                  <label for="codigo" class="control-label">Sem Referência</label>
                <div class="controls">
                  <input style="width: 40.5%" id="sRef" type="text" name="sRef" value="SN-<?php echo $ultimoId +1 ?>" readonly />
                    
                    </div>
        
                    </div>  

    

                  

                    <div class="control-group"> 
                       <!--  <label for="assunto" class="control-label">Ref. de Recepção*</label>  -->
                        <!-- <div class="controls">  -->
                            <input style="width: 40.5%; font-weight: bold; font-size: 18px; " id="refRec" type="hidden" name="refRec" readonly value="<?php 
                                  if ($direcoes2<>0 and $departamentos2==0 and $reparticoes2==0) {
                                   echo $nrCorreSector +1 .'/'.$this->session->userdata('abrev_direcoes').'/'.date('Y') ;
                                  } else if ($direcoes2<>0 and $departamentos2<>0 and $reparticoes2==0) {
                                    echo $nrCorreSector +1 .'/'.$this->session->userdata('abrev_direcoes').'/'.$this->session->userdata('abrev_departamentos').'/'.date('Y') ;
                                  }
                                  else if ($direcoes2<>0 and $departamentos2<>0 and $reparticoes2<>0) {
                                 echo $nrCorreSector +1 .'/'.$this->session->userdata('abrev_direcoes').'/'.$this->session->userdata('abrev_departamentos').'/'.$this->session->userdata('abrev_reparticoes').'/'.date('Y') ;
                                  }
                                  
                             ?>"  />
                       <!--  </div> -->
                    </div>  

                    <div class="control-group">
                      <label  class="control-label" > Nº Entrada/Saida(Livro)<span class="required">*</span></label>
                        <div class="controls">
                        <input type="number" name="num_entrada_saida_livro"  value="<?php echo set_value('num_entrada_saida_livro'); ?>" style="width: 20%;">

                        <input type="date" name="data_entrada_saida_livro" style="width: 19%;"  value="<?php echo set_value('data_entrada_saida_livro'); ?>" style="width: 20%;">                      
                        </div>
                        </div> 


               <div class="control-group">
                <label for="codigo" class="control-label">Classificador*</label>
                 <div class="controls">
                 <input style="width: 40.5%;" id="codigoAssunto" type="text" name="codigoAssunto" value="<?php echo set_value('codigoAssunto'); ?>"  />
               <input type="hidden" id="classificacao_id" type="text" name="classificacao_id" value="<?php echo set_value('classificacao_id'); ?>" readonly="true"  />
                    </div>
                    
                  </div >                 


                    <div class="control-group">
                        <label for="assunto" class="control-label">Assunto*</label>
                        <div class="controls">
                            <textarea style="width: 40.5%;" rows="3" cols="30" name="assunto" id="assunto"><?php echo set_value('assunto'); ?></textarea>
                        </div>
                    </div> 

                    <div class="control-group">
                        <label for="prioridade" class="control-label">Prioridade*</label>
                        <div class="controls">
                          <select name="prioridades" id="prioridades" value="<?php echo set_value('prioridades'); ?>" style="width: 42%;"  >
                            <option selected disabled>Selecione Urgencia</option>
                                   <?php foreach ($prioridades as $p) {?>                                   
                    <option value="<?php echo $p->id ?>"
                              <?php echo  set_select('prioridades', $p->id); ?>>
                              <?php echo $p->nome ?></option>

                                 <?php  } ?>
                            
                          </select>
                        </div>
                    </div>

                 <div class="control-group">
                        <label for="destinatario" class="control-label">Destinatário</label>
                        <div class="controls">
                            <input placeholder="Campo de anexo" style="width: 40.5%;" id="destinatarios" type="text" name="destinatarios" value="<?php echo set_value('destinatarios'); ?>"  />
                        </div>
                    </div>

                      <div class="control-group">
                        <label for="observacao" class="control-label">Observação</label>
                        <div class="controls">
                            <textarea style="width: 40.5%;" rows="3" cols="30" name="observacao" id="observacao" ><?php echo set_value('observacao'); ?></textarea>
                        </div>
                    </div>
                                                       
                    <div class="control-group">
                        <label for="documento" class="control-label"><span class="required">Anexo</span></label>
                        <div class="controls">
                            <input id="arquivo" type="file" name="userfile" value="<?php echo set_value('userfile'); ?>"  /> (pdf|png|jpg|jpeg)
                        </div>
                    </div>

<input id="usuarios" type="hidden" name="usuarios" value="<?php  echo $this->session->userdata('id'); ?>" />

<input  type="hidden" name="local_direcoes_id" value="<?php  echo $this->session->userdata('local_direcoes'); ?>" />

<input type="hidden" name="local_departamentos_id" value="<?php  echo $this->session->userdata('local_departamentos'); ?>" />

<input type="hidden" name="local_reparticoes_id" value="<?php  echo $this->session->userdata('local_reparticoes'); ?>" />
                      
<div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                          <p style="color: red; font-weight: bold;">Certifique que os dados estão correctamente registados  antes de adicionar.</p>
                                <button type="submit" class="btn btn-warning"><i class="icon-plus icon-white"></i> Adicionar</button>
                                 <button type="reset" class="btn btn-danger"><i class=" icon-white"></i> Limpar</button>
                                <a href="<?php echo base_url() ?>index.php/correspondencias" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

 <!-- Modal Proviniencia Externa-->
<div id="modal-provinienciaExterna" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/correspondencias/pro_externa" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Cadastro de Proviniencia Externa</h5>
  </div>

      
    <label style="margin-left: 10px;" for="observacao" class="control-label">Nome <span class="required">*</span></label>
        <div class="controls">
       <input type="text"  name="nome" style="width: 500px; margin-left:10px;" rows="3" cols="30" required />
        </div> 

     <label style="margin-left: 10px;" for="observacao" class="control-label">Abreviatura (Caso não exista digite o nome do Sector)</label>
        <div class="controls">
       <input type="text"  name="abreviatura" style="width: 500px; margin-left:10px;" rows="3" cols="30" required />
        </div> 

        <label style="margin-left: 10px;" for="observacao" class="control-label">E-mail</label>
        <div class="controls">
       <input type="email"  name="email" style="width: 500px; margin-left:10px;" rows="3" cols="30"  />
        </div>

       <label style="margin-left: 10px;" for="observacao" class="control-label">Contacto</label>
        <div class="controls">
       <input type="text"  name="contacto" style="width: 500px; margin-left:10px;" rows="3" cols="30"  />
        </div>

        <label style="margin-left: 10px;" for="observacao" class="control-label">Endereço</label>
        <div class="controls">
       <input type="text"  name="endereco" style="width: 500px; margin-left:10px;" rows="3" cols="30"  />
        </div>
   
  
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Adicionar</button>
  </div>
  </form>
</div>

 <!-- JS file for form -->  
  <?php include 'interacao.js'; ?>  