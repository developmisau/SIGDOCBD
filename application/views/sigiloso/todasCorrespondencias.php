<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo current_url(); ?>">
        
        <div class="span5">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Digite o codigo da correspondência para pesquisar" class="span12" value="<?php echo $this->input->get('pesquisa'); ?>" >        
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
            <h5>Arquivos</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Correspondência</th>
                        <th>Proveniencia</th>
                        <th>Categoria</th>
                        <th>Prioridade</th>
                        <th>Data</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhuma Correspondência Encontrado</td>
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
            <h5>Correspondência Registradas</h5>

         </div>

    <div class="widget-content nopadding">


    <table class="table table-bordered ">
        <thead>
            <tr>
              
                        <th>Correspondencia</th>
                        <th>Proveniencia</th>
                        <th>Local Actual</th>
                        <th>Tramitado</th>
                        <th>Verificado</th>
                        <th>Despachado</th>
                        <th>Parecer</th>
                        <th>Acção</th>
                        <th></th>
                        
            </tr>
        </thead>
        <tbody>

            <?php  
                $localUser=$this->session->userdata('local'); 

                foreach ($results as $r) {  
            
                
                if ($r->origem==$localUser) {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->proviniencia.'</td>';
                echo '<td>'.$r->destino.'</td>';

                if ($r->estadoTra=="NAO") {
                   echo '<td style="text-align: center; color:red; fonte-style:bold; font-size:16px;"><i class="icon-thumbs-down tip-top"></i></td>';
                }
                else{
                   echo '<td style=" text-align: center; color:blue; font-size:16px;" > <i class="icon-thumbs-up tip-top"></i></td>'; 
                }


                if ($r->estadoVer=="NAO") {
                   echo '<td style="text-align: center; color:red; fonte-style:bold; font-size:16px;"><i class="icon-thumbs-down tip-top"></i></td>';
                }
                else{
                   echo '<td style=" text-align: center; color:blue; font-size:16px;" > <i class="icon-thumbs-up tip-top"></i></td>'; 
                }


                if ($r->estadoDes=="NAO") {
                   echo '<td style="text-align: center; color:red; fonte-style:bold; font-size:16px;"><i class="icon-thumbs-down tip-top"></i></td>';
                }
                else{
                   echo '<td style=" text-align: center; color:blue; font-size:16px;" > <i class="icon-thumbs-up tip-top"></i></td>';
                }

                  if ($r->estadoPar=="NAO") {
                   echo '<td style="text-align: center; color:red; fonte-style:bold; font-size:16px;"><i class="icon-thumbs-down tip-top"></i></td>';
                }
                else{
                   echo '<td style=" text-align: center; color:blue; font-size:16px;" > <i class="icon-thumbs-up tip-top"></i></td>'; 
                }
               
                              

                echo '<td>';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'iProtocolo')){
                        echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Imprimir"><i class="icon-print"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/arquivos/visualizar/'.$r->idCorrespondencia.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
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

<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var arquivo = $(this).attr('arquivo');
        $('#idCorrespondencia').val(arquivo);

   });

   $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});

</script>
