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
                <h5>Adicionar Correspondência</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formArquivo" enctype="multipart/form-data" method="post" class="form-horizontal" >
                    
                  <div class="control-group">
                        <label for="categoria" class="control-label">Categoria*</label>
                        <div class="controls">
                        <select id="categoria" name="categoria" >
                        <option value=""> Selecione a Categoria</option>
                        <option id="entrada" value="Entrada">Entrada</option>
                        <option id="saida" value="Saida">Saida</option>
                       </select>
                           
                        </div>
                    </div>

                    
                  </div >   
                  <!-- Radio para escolher o tipo de proviniencia -->
                  <div class="control-group">
                    <label for="tipoProviniencia" class="control-label">Proviniencia Interna*</label>
                    <div class="controls">
                      <input type="radio" id="provinienciaInterna" name="tipoProviniencia" value="Interna" >
                    </div>

                    <label for="tipoProviniencia" class="control-label">Proviniencia Externa*</label>
                    <div class="controls">
                      <input type="radio" id="provinienciaExterna" name="tipoProviniencia" value="Externa"  >
                    </div>
                  </div>      

                 <div class="control-group">
                        <label  class="control-label" >Organismo Proviniencia<span class="required">*</span></label>
                        <div class="controls">
                            <select name="idDirecao" id="idDirecao" disabled>
                            <option value="<?php set_value('idDirecao'); ?>">Selecione Direcao</option>
                                  <?php foreach ($direcao as $dir) {
                                   
                    
              echo '<option value="'.$dir->idDirecao.'">'.$dir->abrevDirecao.'</option>';

                                    } ?>
                
                            </select>

                            <select name="idDepartamento" id="idDepartamento" disabled>
                            <option value="">Selecione Departamento </option>
                                  
                            </select>

                            <select name="idReparticao" id="idReparticao" disabled>
                            <option value="">Selecione Reparticao</option>
                      
                            </select>
                        </div>

                        <label for="codigo" class="control-label">Entidade de Envio*</label>
                 <div class="controls">
                 <input style="width: 30%;" id="externa" type="text" name="externa" value="" disabled />
              <!-- Para futuro <input id="externaId" type="hidden" name="externaId" value=""  /> -->
                    </div>
        
                    </div>  

                    <div class="control-group">
                        <label for="assunto" class="control-label">Assunto</label>
                        <div class="controls">
                            <textarea style="width: 30%;" rows="3" cols="30" name="assunto" id="assunto" value="<?php echo set_value('assunto'); ?>" ></textarea>
                        </div>
                    </div>  
                   
                    <div class="control-group">
                        <label  class="control-label">Tipo Documento<span class="required">*</span></label>
                        <div class="controls">
                            <select  name="tipoDoc" id="tipoDoc">
                            <option value="">Selecione Tipo</option>
                                  <?php foreach ($tipoDoc as $t) {
                                     
                                      // echo '<option value="'.$t->idDoc.'">'.$t->nomeDoc.'</option>';
                                    echo '<option value="'.$t->nomeDoc.'">'.$t->nomeDoc.'</option>';

                                  } ?>
                            </select>
                        </div>
                    </div>     
                    
                    <div class="control-group">
                        <label for="prioridade" class="control-label">Classificação - Urgencia*</label>
                        <div class="controls">
                          <select name="prioridade" id="prioridade" value="<?php echo set_value('prioridade'); ?>" >
                            <option value="">Selecione Urgencia</option>
                            <option value="Normal" style="color: green;" >Normal</option>
                            <option value="Urgente" style="color: orange;"> Urgente</option>
                            <option value="Muito Urgente" style="color: red;"> Muito Urgente</option>
                            <option value="Outro" style="color: blue;">Outro</option>
                            
                          </select>
                        </div>
                    </div>

                  
                      <div class="control-group">
                        <label for="observacao" class="control-label">Observação</label>
                        <div class="controls">
                            <textarea style="width: 30%;" rows="3" cols="30" name="observacao" id="observacao" value="<?php echo set_value('observacao'); ?>" ></textarea>
                        </div>
                    </div>
                    
                                     
                    <div class="control-group">
                        <label for="documento" class="control-label"><span class="required">Documento*</span></label>
                        <div class="controls">
                            <input id="arquivo" type="file" name="userfile" value="<?php echo set_value(''); ?>"  /> (pdf|png|jpg|jpeg)
                        </div>
                    </div>

                    <input id="estadoArq" type="hidden" name="estadoDes" value="NAO"  />
                    <input id="estadoPar" type="hidden" name="estadoPar" value="NAO"/>
                    <input id="estadoTra" type="hidden" name="estadoTra" value="NAO"  />
                    <input id="estadoVer" type="hidden" name="estadoVer" value="NAO"  />
                      <input id="origem" type="hidden" name="origem" value="<?php  echo $this->session->userdata('local'); ?>"  />
                      
                       <input id="usuario" type="hidden" name="usuario" value="<?php  echo $this->session->userdata('nome'); ?>"  />


                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                 <button type="reset" class="btn btn-danger"><i class=" icon-white"></i> Limpar</button>
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
//Classificacao Sigilosas.

$("#sigiloso").click(function (){
                // desabilita o campo 
 // $('#externa').prop("disabled", false);
  $('#refRec, #refProv,#codigoAssunto,#assunto,#tipoDoc,#observacao,#arquivo').prop("disabled", true);
    
  }); 



  $("#entrada").click(function (){
                // habilita o campo 
       $('#refRec, #refProv,#codigoAssunto,#assunto,#tipoDoc,#observacao,#arquivo').prop("disabled", false);
    
  });

  $("#saida").click(function (){
                // habilita o campo 
       $('#refRec, #refProv,#codigoAssunto,#assunto,#tipoDoc,#observacao,#arquivo').prop("disabled", false);
    
  });
    });
  

</script>

<script type="text/javascript">
$(document).ready(function(){
//tipo de proviniencia funcoes para habilitar e desabilitar campos.
  $("#provinienciaInterna").click(function (){
                // habilita o campo 
    $('#externa').prop("disabled", true);
    $('#idDirecao, #idDepartamento,#idReparticao').prop("disabled", false);
    
  });
    
  $("#provinienciaExterna").click(function (){
                // desabilita o campo 
  $('#externa').prop("disabled", false);
  $('#idDirecao, #idDepartamento,#idReparticao').prop("disabled", true);
    
  }); 
});

</script>

<script type="text/javascript">

  $(document).ready(function() {                       
                $("#idDirecao").change(function() {
                    $("#idDirecao option:selected").each(function() {
                        idDirecao = $('#idDirecao').val();
                        $.post("<?php echo base_url(); ?>index.php/arquivos/fillCiudadesAdicionar", {
                            idDirecao : idDirecao
                        }, function(data) {
                            $("#idDepartamento").html(data);
                        });
                    });
                });
            });

    $(document).ready(function() {                       
                $("#idDepartamento").change(function() {
                    $("#idDepartamento option:selected").each(function() {
                        idDepartamento = $('#idDepartamento').val();
                        $.post("<?php echo base_url(); ?>index.php/arquivos/fillCiudadesAdicionar2", {
                            idDepartamento : idDepartamento
                        }, function(data) {
                            $("#idReparticao").html(data);
                        });
                    });
                });
            });
</script>

<script type="text/javascript">
  //autocomplete
   $(document).ready(function(){

      $("#codigoAssunto").autocomplete({
            source: "<?php echo base_url(); ?>index.php/arquivos/autoCompleteCliente/",
            minLength: 1,
            select: function( event, ui ) {

                 $("#codigo").val(ui.item.id);
            }
      });
      
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
         
          $('#formArquivo').validate({
            rules :{
                   categoria:{ required: true},
                   refProv:{required:true},
                   refRec:{required:true},
                   codigoAssunto:{required:true},
                  // codigo:required:true},
                  // //proviniencia
                  tipoProviniencia:{required:true},
                  idDirecao:{required:true},
                  externa:{required:true},
                  assunto:{required:true},
                  tipoDoc:{required:true},
                  prioridade:{required:true},
                  userfile:{ required: true}
            },
            messages:{
                categoria :{ required: 'Campo Requerido.'},
                refProv:{required:'Campo Requerido.'},
                refRec:{required:'Campo Requerido.'},
                codigoAssunto:{required:'Campo Requerido.'},
                // codigo:required:'Campo Requerido.'},
                //   //proviniencia
                tipoProviniencia:{required:'Campo Requerido.'},
                idDirecao:{required:'Campo Requerido.'},
                externa:{required:'Campo Requerido.'},  
                assunto:{required:'Campo Requerido.'},
                tipoDoc:{required:'Campo Requerido.'},
                prioridade:{required:'Campo Requerido.'},
                userfile :{ required: 'Campo Requerido.'}
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
</script>





                                    
