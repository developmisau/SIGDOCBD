<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Correspondencia</h5>
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

                                
                    
                                <td style="width: 45%; font-size: 15px; padding: 50px;">Prioridade: <span style=" color: red;" ><?php echo $result->prioridade?></span></br></br> </br> </td>

                                        
                                    <td style="width: 30%; text-align: center">#Correspondencia: <span ><br><?php echo $result->numCorrespondencia?></span></br></br> </br> <span>Emissão: <?php echo date('d/m/Y');?></span></td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
   
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 50%; padding-left: 0">
                                        <ul>
                                            <li>
                                           <span><h5>Dados do Rementente</h5>
                                           <span>Tipo de Proviniencia:   
                                            <?php echo $result->tipoProviniencia?>
                                            </span><br/>
                                           <span>Proviniencia do Documento: <?php echo $result->proviniencia?>
                                           </span><br/>
                                            <span>Tipo Documento:   
                                            <?php echo $result->tipoDoc?><br/>
                                            <span>Data Recepção:   
                                            <?php echo $result->dataEmissao?>
                                            </span><br/>
                                            

                                                 
                                            </li>
                                        </ul>
                                    </td>

                                    <td style="width: 50%; padding-left: 0">
                                        <ul>
                                            <li>
                                           <span><h5>Dados da Recepção</h5>
                                           <span>Local:   
                                            <?php echo $result->origem; ?>
                                            </span><br/>
                                            
                                           <span>Contacto: <?php echo $emitente[0]->telefone; ?>
                                           </span><br/>
                                            <span>Extensão:   
                                            <?php echo $emitente[0]->extensao; ?>
                                            </span><br/>
                                            <span>E-mail:   
                                            <?php echo $emitente[0]->email; ?>
                                            </span><br/>
                                           <!--  <span>Localização Correspondencia:   
                                            <?php echo $result->destino; ?>
                                            </span><br/> -->
                                                                                             
                                            </li>
                                        </ul>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table> 
      
                    </div><hr />
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


            mywindow.document.write('<html><head><title>Sistema de Gestão e Tramite de Documentos</title>');
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