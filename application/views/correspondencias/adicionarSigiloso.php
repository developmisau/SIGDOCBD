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
                <form action="<?php echo current_url(); ?>" id="formCorrespondencia" enctype="multipart/form-data" method="post" class="form-horizontal" >


           
          
           <div class="control-group" >
                        <label  class="control-label" >Tipo Proviniencia<span class="required">*</span></label>
                        <div class="controls">

                       <input class="btn tip-top" style="border: 1px; width: 2%; height: 1.2em;" type="radio" id="provinienciaInterna" name="tipo_pro" value="Interna" title="Orgão Central"  <?php echo  set_radio('tipo_pro', 'Interna'); ?> >

                        <input class="btn tip-top" style="border: 1px; width: 2%; height: 1.2em;" type="radio" id="provinienciaExterna" name="tipo_pro" value="Externa" title="Sector Público/Privado" <?php echo  set_radio('tipo_pro', 'Externa'); ?> >
  
                        </div>
                      </div>   



                 <div class="control-group" id="sector_pro">
                        <label  class="control-label" >Orgão Central<span class="required">*</span></label>
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
            <label for="codigo" class="control-label">Sector Público / Privado/</label>
          <div class="controls">
            <input style="width: 40.5%" id="externa" type="text" name="externa" value="<?php echo set_value('externa'); ?>" disabled />

              <input type="hidden" id="pro_externa_id"  name="pro_externa_id" value="<?php echo set_value('pro_externa_id'); ?>" readonly="true"  />

              <a href="#modal-provinienciaExterna" style="margin-right: 1%" role="button" data-toggle="modal" class="btn btn-warning tip-top" title="Adicionar Sector Público / Privado"><i class=icon-plus icon-white></i></a>

              
              
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
                        <label for="prioridade" class="control-label">Classificação - Urgencia*</label>
                        <div class="controls">
                          <select name="nivel_conf" id="nivel_conf" value="<?php echo set_value('nivel_conf'); ?>" style="width: 42%;"  >
                            <option selected disabled>Selecione Nivel de Confidencialidade</option>
                                   <?php foreach ($nivel_conf as $nv) {?>                                   
                    <option value="<?php echo $nv->id ?>"
                              <?php echo  set_select('nivel_conf', $nv->id); ?>>
                              <?php echo $nv->nome ?></option>

                                 <?php  } ?>
                            
                          </select>
                        </div>
                    </div>

                 <div class="control-group">
                        <label for="destinatario" class="control-label">Destinatário*</label>
                        <div class="controls">
                            <input style="width: 40.5%;" id="destinatario" type="text" name="destinatario" value="<?php echo set_value('destinatario'); ?>" />
                            <input type="hidden" id="idDestinatario"  name="idDestinatario" value="<?php echo set_value('idDestinatario'); ?>" readonly="true"  />
                        </div>
                    </div>

                      <div class="control-group">
                        <label for="observacao" class="control-label">Observação</label>
                        <div class="controls">
                            <textarea style="width: 40.5%;" rows="3" cols="30" name="observacao" id="observacao" ><?php echo set_value('observacao'); ?></textarea>
                        </div>
                    </div>
                  

<input id="usuarios" type="hidden" name="usuarios" value="<?php  echo $this->session->userdata('id'); ?>" />

<input  type="hidden" name="local_direcoes_id" value="<?php  echo $this->session->userdata('local_direcoes'); ?>" />

<input type="hidden" name="local_departamentos_id" value="<?php  echo $this->session->userdata('local_departamentos'); ?>" />

<input type="hidden" name="local_reparticoes_id" value="<?php  echo $this->session->userdata('local_reparticoes'); ?>" />
                      
<div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                 <button type="reset" class="btn btn-danger"><i class=" icon-white"></i> Limpar</button>
                                <a href="<?php echo base_url() ?>index.php/correspondencias/listaSigiloso" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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
