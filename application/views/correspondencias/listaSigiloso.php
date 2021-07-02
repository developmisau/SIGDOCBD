<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo current_url(); ?>">
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){ ?>
             <div class="span2">
                <a href="<?php echo base_url();?>index.php/correspondencias/adicionarSigiloso" class="btn btn-warning span12"><i class="icon-plus-sign icon-white"></i> Adicionar</a>
            </div>  
        <?php } ?>
           
        <div class="span5">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Pesquisar ..." class="span12" value="<?php echo $this->input->get('pesquisa'); ?>" >        
        </div>
        <div class="span3">
            <input type="date" name="data"  id="data"  placeholder="Data de" class="span12 datepicker" value="<?php echo $this->input->get('data'); ?>">
            <input type="date" name="data2"  id="data2"  placeholder="Data até" class="span12 datepicker" value="<?php echo $this->input->get('data2'); ?>" >                
        </div>


        <div class="span2">
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
            <h5>Correspondências</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Correspondência</th>
                        <th>Nivel de Confindencialidade</th>
                        <th>Tipo Proveniência</th>
                        <th>Destinatário</th>
                        <th>Data Emissão</th>
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
            <h5>Correspondências</h5>

         </div>

    <div class="widget-content nopadding">


    <table class="table table-bordered ">
        <thead>
            <tr>
              
                        <th>Correspondência</th>
                        <th>Nivel de Confindencialidade</th>
                        <th>Tipo Proveniência</th>
                        <th>Destinatário</th>
                        <th>Data Emissão</th>
                        
            </tr>
        </thead>
        <tbody id="myTable">
<?php  

 $direcoes=$this->session->userdata('local_direcoes'); 
 $departamentos=$this->session->userdata('local_departamentos'); 
 $reparticoes=$this->session->userdata('local_reparticoes'); 
                

foreach ($results as $r) {
  if ($direcoes<>" " and $departamentos==0 and $reparticoes==0) {
  if ($r->local_direcoes_id==$direcoes ) {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->nivel.'</td>';
                echo '<td>'.$r->tipo_pro.'</td>';
                echo '<td>'.$r->destinatario.'</td>';
                echo '<td>'.$r->data_normal.'</td>';
                    
                echo  '</td>';
                echo '</tr>';
            } 
  }//fecha a primeira condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes==0) {
if ($r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos) {
                   
                
                 echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->nivel.'</td>';
                echo '<td>'.$r->tipo_pro.'</td>';
                echo '<td>'.$r->destinatario.'</td>';
                echo '<td>'.$r->date.'</td>';
               
               

              
                echo  '</td>';
                echo '</tr>';
            } 
  }//fecha a segunda condicao

else if  ($direcoes<>" " and $departamentos<>" " and $reparticoes<>" ") {
  if ($r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->nivel.'</td>';
                echo '<td>'.$r->tipo_pro.'</td>';
                echo '<td>'.$r->destinatario.'</td>';
                echo '<td>'.$r->date.'</td>';
                   
                echo  '</td>';
                echo '</tr>';
            } 
  }//fecha a terceira condicao

 }//fecha o ciclo
 }
            ?>
            <tr>
                
            </tr>
        </tbody>
    </table>
    </div>
    </div>

</div>
 
</div>

 
