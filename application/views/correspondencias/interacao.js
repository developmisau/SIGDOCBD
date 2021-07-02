<script type="text/javascript">
//Adicionar correspondencias ostensivas

//Funcao que esconde campos de sector de proviencia e org#ao de envio
window.onload = function (){

//Oculta div de proviniencia
document.getElementById('sector_pro').style.display = "none";
document.getElementById('org_envio').style.display = "none";

//Oculta div de refereencia
document.getElementById('cf').style.display = "none";
document.getElementById('sf').style.display = "none";

//Desmarcar as checked, logo ao carregar
$("#provinienciaInterna").prop('checked',false);
$("#provinienciaExterna").prop('checked',false);

//Desmarcar as checked de referencia, logo ao carregar
$("#com_ref").prop('checked',false);
$("#sem_ref").prop('checked',false);

 }


/*Tipo de proviniencia 
funcoes para exibir e escoder os tipos de proviniencia*/
$(document).ready(function(){
$("#provinienciaInterna").click(function (){
document.getElementById('org_envio').style.display = "none";
document.getElementById('sector_pro').style.display = "";
//limpar campo de sector publico
document.getElementById('externa').value="";

//Habilitar
$('#reparticoes').prop("disabled", true);
$('#direcoes').prop("disabled", false);
 
});

$("#provinienciaExterna").click(function (){
document.getElementById('org_envio').style.display = "";
document.getElementById('sector_pro').style.display = "none";
//limpar campo de orgao central
$("#direcoes").prop('selectedIndex',0);
//Habilitar
 $('#externa').prop("disabled", false);
  });
});



/*Tipo de Referencia 
funcoes para exibir e escoder os tipos de referencia*/
$(document).ready(function(){
$("#com_ref").click(function (){
document.getElementById('sf').style.display = "none";
document.getElementById('cf').style.display = "";
//limpar campo de orgao central 
$('#sRef').prop("disabled", true);
$('#cRef').prop("disabled", false);
});

$("#sem_ref").click(function (){
document.getElementById('sf').style.display = "";
document.getElementById('cf').style.display = "none";
//Habilitar campo sem numero
$('#sRef').prop("disabled", false);
//limpar campo de orgao central
document.getElementById('cRef').value="";
$('#cRef').prop("disabled", true);

//$('#cRef').prop("disabled", true);
  });
});

//Combinacao de direcoes, departamentos e reparticoes.
 $(document).ready(function() {                       
                $("#direcoes").change(function() {
                    $("#direcoes option:selected").each(function() {  
                         direcoes = $('#direcoes').val();                    
                        $.post("<?php echo base_url(); ?>index.php/correspondencias/dirDep", {
                            direcoes : direcoes
                        }, function(data) {
                            //$("#externa").prop('disabled',true);
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

  //autocomplete
   $(document).ready(function(){

      $("#codigoAssunto").autocomplete({
            source: "<?php echo base_url(); ?>index.php/correspondencias/autoClassificador/",
            minLength: 1,
            select: function( event, ui ) {

                 $("#classificacao_id").val(ui.item.id);
            }
      });
      
  });

     $(document).ready(function(){

      $("#externa").autocomplete({
            source: "<?php echo base_url(); ?>index.php/correspondencias/autoCompleteProvinienciaExterna/",
            minLength: 1,
            select: function( event, ui ) {

                 $("#pro_externa_id").val(ui.item.id);
                // $("#direcoes").prop('disabled',true);

            }
      });
      
  });

  $(document).ready(function(){

      $("#destinatario").autocomplete({
            source: "<?php echo base_url(); ?>index.php/correspondencias/autoCompleteDestinatario/",
            minLength: 1,
            select: function( event, ui ) {

                 $("#idDestinatario").val(ui.item.id);
            }
      });
      
  });

   $(document).ready(function(){

      $("#usuarios").autocomplete({
            source: "<?php echo base_url(); ?>index.php/correspondencias/autoCompleteUsuarios/",
            minLength: 1,
            select: function( event, ui ) {

                 $("#usuarios_id").val(ui.item.id);
            }
      });
      
  });


  $(document).ready(function(){
         
          $('#formCorrespondencia').validate({
            rules :{
                  tipo_pro:{ required: true},
                  categorias:{ required: true},
                  refProv:{required:true},
                  refRec:{required:true},
                  codigoAssunto:{required:true},
                  classificacao_id:{required:true},
                  tipoProviniencia:{required:true},
                  direcoes:{required:true},
                  cRef:{required:true},
                  referencia:{required:true},
                  externa:{required:true},
                  assunto:{required:true},
                  tipo_doc:{required:true},
                  prioridades:{required:true},
                  destinatario:{required:true},
                  //userfile:{ required: true}
            },
            messages:{
                tipo_pro :{ required: 'Campo Requerido.'},
                categorias :{ required: 'Campo Requerido.'},
                refProv:{required:'Campo Requerido.'},
                refRec:{required:'Campo Requerido.'},
                codigoAssunto:{required:'Campo Requerido.'},
                classificacao_id:{required:'Campo Requerido.'},
                tipoProviniencia:{required:'Campo Requerido.'},
                direcoes:{required:'Campo Requerido.'},
                referencia:{required:'Campo Requerido.'},
                cRef:{required:'Campo Requerido.'},
                externa:{required:'Campo Requerido.'},  
                assunto:{required:'Campo Requerido.'},
                tipo_doc:{required:'Campo Requerido.'},
                prioridades:{required:'Campo Requerido.'},
                destinatario:{required:'Campo Requerido.'},
                //userfile :{ required: 'Campo Requerido.'}
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



