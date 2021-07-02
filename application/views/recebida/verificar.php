<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo current_url(); ?>">
        
        <div class="span5">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Digite o nome do documento para pesquisar" class="span12" value="<?php echo $this->input->get('pesquisa'); ?>" >        
        </div>
        <div class="span3">
            <input type="text" name="data"  id="data"  placeholder="Data de" class="span6 datepicker" value="<?php echo $this->input->get('data'); ?>">
            <input type="text" name="data2"  id="data2"  placeholder="Data até" class="span6 datepicker" value="<?php echo $this->input->get('data2'); ?>" >                
        </div>
        <div class="span1">
            <button class="span12 btn"> <i class="icon-search"></i> </button>
        </div>
    </form>
</div>

<?php
if(!$results){?>

<div class="span12" style="margin-left: 0">
        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
            </span>
            <h5>Correspondencia Por Verificar</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Correspondência</th>
                        <th>Prioridade</th>
                        <th>Tipo Proveniencia</th>
                        <th>Proviniencia</th>
                        <th>Data Emissão</th>
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
            <h5>Correspondência Recebida</h5>

         </div>

    <div class="widget-content nopadding">


    <table class="table table-bordered ">
        <thead>
            <tr>
              
                        <th>Correspondência</th>
                        <th>Prioridade</th>
                        <th>Tipo Proveniencia</th>
                        <th>Proviniencia</th>
                        <th>Data Emissão</th>
                        <th>Acção</th>
                        
            </tr>
        </thead>
        <tbody>

            <?php  
                $localUser=$this->session->userdata('local'); 

                foreach ($results as $r) {  
            
                
                if ($r->estadoTra=='SIM' and $r->estadoVer=='NAO' and $r->estadoDes=='NAO' and $r->destino==$localUser) {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->prioridade.'</td>';
                echo '<td>'.$r->tipoProviniencia.'</td>';
                echo '<td>'.$r->proviniencia.'</td>';
                echo '<td>'.$r->dataEmissao.'</td>';
               
                echo '<td>';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'vArquivo')){
                        echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Imprimir"><i class="icon-print"></i></a>'; 
                    }
                  
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'dArquivo')){
                         echo '<a href="#modal-verificar" style="margin-right: 1%" role="button" data-toggle="modal" verificar="'.$r->idCorrespondencia.'" class="btn btn-danger tip-top" title="Verificar"><i class="icon-check icon-white"></i></a>';
                    }
                echo  '</td>';
                echo '</tr>';
            }}
            ?>
            <tr>
                
            </tr>
        </tbody>
    </table>
    </div>
    </div>

</div>
<?php echo $this->pagination->create_links();}?>



 
<!-- Modal -->
<div id="modal-verificar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/verificar/" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Verificar Correspondencia</h5>
  </div>

    <div class="modal-body">
     <input type="hidden" id="estadoVer" name="estadoVer" value="SIM" />
     <input type="hidden" id="idCorrespondencia" name="id" value="<?php echo('id') ?>"  />
    <h5 style="text-align: center">Tem a certeza que a correspondencia foi verificada?</h5>
     </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">OK</button>
  </div>
  </form>
</div>



<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var verificar = $(this).attr('verificar');
        $('#idCorrespondencia').val(verificar);

   });

   $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});

</script>
