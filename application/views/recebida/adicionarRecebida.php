<!-- JS file -->
<script src=" <?php echo base_url(); ?>js/Autocomplete/dist/jquery.easy-autocomplete.min.js"></script> 

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
                <h5>Registrar Correspondencia</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formArquivo" enctype="multipart/form-data" method="post" class="form-horizontal" >
                    
                  <div class="control-group">
                        <label for="categoria" class="control-label">Categoria*</label>
                        <div class="controls">
                        <select  id="categoria" name="categoria" >
                        <option >Selecione a Categoria</option>
                        <option value="Entrada">Entrada</option>
                        <option value="Saida">Saida</option></select>
                           
                        </div>
                    </div>

                   <div class="control-group">
                        <label for="codDoc" class="control-label">Codigo Documento*</label>
                        <div class="controls">
                            <input id="codDoc" type="text" name="codDoc" value="<?php echo set_value('codDoc'); ?>" />
                        </div>
                    </div>
                  
                    <div class="control-group">
                        <label for="classificacao" class="control-label">Classificação Correspondencia*</label>
                        <div class="controls">
                            <input id="classificacao" type="text" name="classificacao" value="<?php echo set_value('classe'); ?>"  />
                        </div>
                    </div>

                    

                      <div class="control-group">
                        <label for="assunto" class="control-label">Assunto Documento*</label>
                        <div class="controls">
                            <input id="assunto" type="text" name="assunto" value="<?php echo set_value('assunto'); ?>" />
                        </div>
                    </div>


                    <div class="control-group">
                        <label  class="control-label">Tipo Documento<span class="required">*</span></label>
                        <div class="controls">
                            <select name="tipoDocId" id="tipoDocId">
                            <option value="">Selecione Tipo</option>
                                  <?php foreach ($tipoDoc as $t) {
                                     
                                      echo '<option value="'.$t->nomeDoc.'">'.$t->nomeDoc.'</option>';

                                  } ?>
                            </select>
                        </div>
                    </div>


                      <div class="control-group">
                        <label  class="control-label">Direcao<span class="required">*</span></label>
                        <div class="controls">
                            <select name="direcao" id="direcao">
                            <option value="">Selecione Direcao</option>
                                  <?php foreach ($direcao as $dir) {
                                   
                                                                    
                                      echo '<option value="'.$dir->abrevDirecao.'">'.$dir->nomeDirecao.'</option>';

                                    } ?>

                              
                            </select>
                        </div>
                    </div>

                       <div class="control-group">
                        <label  class="control-label">Departamento<span class="required">*</span></label>
                        <div class="controls">
                            <select name="departamento" id="departamento">
                            <option value="">Selecione Departamento </option>
                                  <?php foreach ($departamento as $dep) {
                                                                      
                                      echo '<option value="'.$dep->abrevDepartamento.'">'.$dep->nomeDepartamento.'</option>';
                                                                          
                                  } ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label  class="control-label">Reparticao<span class="required">*</span></label>
                        <div class="controls">
                            <select name="reparticao" id="reparticao">
                            <option value="">Selecione Reparticao</option>
                                  <?php foreach ($reparticao as $rep) {
                                                                        
                                      // usar no futuroecho '<option value="'.$rep->idReparticao.'">'.$rep->abrevReparticao.'</option>';
                                       echo '<option value="'.$rep->abrevReparticao.'">'.$rep->nomeReparticao.'</option>';
                                    
                                      
                                  } ?>
                            </select>
                        </div>
                    </div>                   
                    
                    <div class="control-group">
                        <label for="prioridade" class="control-label">Prioridade*</label>
                        <div class="controls">
                            <input id="prioridade" type="text" name="prioridade" value="<?php echo set_value('prioridade'); ?>" />
                        </div>
                    </div>

                  
                      <div class="control-group">
                        <label for="observacao" class="control-label">Observação</label>
                        <div class="controls">
                            <textarea rows="3" cols="30" name="observacao" id="observacao" value="<?php echo set_value('observacao'); ?>" ></textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="dataDoc" class="control-label">Data Documento*</label>
                        <div class="controls">
                            <input id="dataDoc" type="date" name="dataDoc"  class="datepicker" value="<?php echo set_value('dataDoc'); ?>" />
                        </div>
                    </div>

                                                      
                    <div class="control-group">
                        <label for="documento" class="control-label"><span class="required">Documento*</span></label>
                        <div class="controls">
                            <input id="arquivo" type="file" name="userfile" value="<?php echo set_value('userfile'); ?>"  /> (pdf|png|jpg|jpeg)
                        </div>
                    </div>

                      <input id="estado" type="hidden" name="estado" value="Registrado"  />
                      <input id="origem" type="hidden" name="origem" value="<?php  echo $this->session->userdata('local'); ?>"  />
                       <input id="usuario" type="hidden" name="usuario" value="<?php  echo $this->session->userdata('nome'); ?>"  />


                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/arquivos" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">

      $(document).ready(function(){
         
           $('#formArquivo').validate({
            rules :{
                  categoria:{ required: true},                  
                  codDoc:{ required: true},
                  classificacao:{ required: true},
                  assunto:{ required: true},
                  tipoDocId:{ required: true},
                  direcao:{ required: true},
                  departamento:{ required: true},
                  reparticao:{ required: true},
                  prioridade:{ required: true},
                  
                  dataDoc:{ required: true},
                  documento:{ required: true}
                  
            },
            messages:{
                  
                  categoria:{ required: 'Campo Requerido.'},                  
                  codDoc:{ required: 'Campo Requerido.'},
                  classificacao:{ required: 'Campo Requerido.'},
                  assunto:{ required: 'Campo Requerido.'},
                  tipoDocId:{ required: 'Campo Requerido.'},
                  direcao:{ required: 'Campo Requerido.'},
                  departamento:{ required: 'Campo Requerido.'},
                  reparticao:{ required: 'Campo Requerido.'},
                  prioridade:{ required: 'Campo Requerido.'},
                 
                  dataDoc:{ required: 'Campo Requerido.'},
                  documento:{ required: 'Campo Requerido.'}
                 
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
                $(element).parents('.control-group').removeClass('success');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           }); 


           $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
      });

      var options = {
  data: ["Entrada", "Saida"]
};

$("#basics").easyAutocomplete(options);

</script>




                                    
