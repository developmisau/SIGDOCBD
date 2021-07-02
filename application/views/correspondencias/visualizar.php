<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Correspondências</h5>
                <div class="buttons">
                    <a id="imprimir" title="Imprimir" class="btn btn-mini btn-inverse" href=""><i class="icon-print icon-white"></i> Imprimir</a>
                </div>
            </div>
            <div class="widget-content" id="printCorrespondencia">
                <div class="invoice-content">
                    <div class="invoice-head">
                    
                        <table class="table" >
                            <tbody>

                                <?php if($emitente == null) {?>
                                            
                                <tr >
                                    <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/sigdoc/emitente">Configurar</a><<<</td>
                                </tr>
                                <?php } else {?>

                     <tr>
               
                        <td >
                        <img style="width: 100%;" src=" <?php echo $emitente[0]->url_logo; ?> "><br>

                                
                    
                                <td style="width: 45%; font-size: 16px; color: black;text-align: center; padding-top: 100px;">
                                <span style="font-weight:bold;">Referência de Recepção: </span><span ><?php echo $result->refRec?></span></br></br>

                                <span style="font-weight:bold;">Proviniência: </span><span ><?php echo $result->tipo_pro?></span></br></br>

                                <span style="font-weight:bold;">Data Recepção:: </span><span ><?php echo $result->data_normal?></span></br></br>

                                </td>


                                 <td style="width: 30%; text-align: center; font-style: bold; color: black; font-size: 16px; center; padding-top: 100px;">
                                <span style="font-weight:bold;">Número Correspondência: </span><br><span ><?php echo $result->numCorrespondencia?></span></br></br></br>

                                <span style="font-weight:bold;">Emissão: </span><span ><?php echo date('d/m/Y');?></span></br>

                                </td>

                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
   
                        
                    </div><hr/>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#imprimir").click(function(){         
            PrintElem('#printCorrespondencia');
        })

        function PrintElem(elem)
        {
            Popup($(elem).html());
        }

        function Popup(data)
        {
            var mywindow = window.open('', 'mydiv', 'height=600,width=800');
            mywindow.document.open();
            mywindow.document.onreadystatechange=function(){
             if(this.readyState==='complete'){
              this.onreadystatechange=function(){};
              mywindow.focus();
              mywindow.print();
              mywindow.close();
             }
            }


            mywindow.document.write('<html><head><title>Sistema de Gestão de Documentos</title>');
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/bootstrap.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/bootstrap-responsive.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/matrix-style.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/matrix-media.css' />");


            mywindow.document.write("</head><body >");
            mywindow.document.write(data);          
            mywindow.document.write("</body></html>");

            mywindow.document.close(); // necessary for IE >= 10


            return true;
        }


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

             



 $("#novo").click(function(){
     direcoes = $('#direcoes').val(); departamentos = $('#departamentos').val(); reparticoes =  $('#reparticoes').val(); 
  var col="<tr><td><?php echo $result->refRec?></td><td>"+direcoes+"</td><td>"+departamentos+"</td><td>"+reparticoes+"</td><td><input type='submit' id='remove' class='btn btn-danger' value='-'/> </td></tr>"
  +"<input type='hidden' name='direcoes[]' value="+direcoes+" />"
+"<input type='hidden' name='departamentos[]' value="+departamentos+" />"
+"<input type='hidden' name='reparticoes[]' value="+reparticoes+" />";
    $(".lista").append($(col));
    exit();
});
                            
                 

</script>


        
      
       