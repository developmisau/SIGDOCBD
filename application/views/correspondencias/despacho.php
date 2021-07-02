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
            <h5>Correspondência</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Correspondência</th>
                        <th>Ref. Recpção</th>
                        <th>Data Entrada</th>
                        <th>Data Despacho</th>
                        <th>Acção</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhuma Correspondência Despachada</td>
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
            <h5>Correspondência Despachada</h5>

         </div>

    <div class="widget-content nopadding">


    <table class="table table-bordered ">
        <thead>
            <tr>
              
                        <th>Correspondência</th>
                        <th>Ref. Recpção</th>
                        <th>Data Entrada</th>
                        <th>Data Despacho</th>
                        <th>Acção</th>
                       
                        
            </tr>
        </thead>
        <tbody>

            <?php  
                $localUser=$this->session->userdata('local'); 
                $i=0; 

                foreach ($results as $r) {                    
                     
            
                
                if ($r->local_entrada==$localUser and $r->estadoDes=="1") {
                   
                
                echo '<tr>';
                echo '<td>'.$r->correspondencias.'</td>';
                echo '<td>'.$r->refRec.'</td>';
                echo '<td>'.$r->data_criacao.'</td>'; 
                echo '<td>'.$r->data_despacho.'</td>'; 
                      
               

                echo '<td>';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Imprimir"><i class="icon-print"></i></a>'; 
                    }
                      if($this->permission->checkPermission($this->session->userdata('permissao'),'iCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizarDespacho/'.$r->id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    }} 
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
