<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo current_url(); ?>">
           
        <div class="span6">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Pesquisar ..." class="span12" value="<?php echo $this->input->get('pesquisa'); ?>" >        
        </div>
        <div class="span4">
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
                        <th>Referência Recepção</th>
                        <th>Assunto</th>
                        <th>Tipo Proveniencia</th>                        
                        <th>Tramitado</th>
                        <th>Parecer</th>
                        <th>Despacho</th>
                        <th>Acções</th>
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
                        <th>Referência Recepção</th>
                        <th>Assunto</th>
                        <th>Tipo Proveniencia</th>                        
                        <th>Tramitado</th>
                        <th>Parecer</th>
                        <th>Despacho</th>
                        <th >Acções</th>
                      
                        
            </tr>
        </thead>
        <tbody id="myTable">

  <?php  
 $direcoes=$this->session->userdata('local_direcoes'); 
 $departamentos=$this->session->userdata('local_departamentos'); 
 $reparticoes=$this->session->userdata('local_reparticoes');  

  foreach ($results as $r) {  
            
 if  ($direcoes<>" " and $departamentos<>" " and $reparticoes<>" ") {
   if ($r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes) {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->refRec.'</td>';
                echo '<td>'.$r->assunto.'</td>';
                echo '<td>'.$r->tipo_pro.'</td>';
                 
                if ($r->estadoTra=="0") {
                   echo '<td style="text-align: center; color:red; fonte-style:bold; font-size:16px;"><i class="icon-thumbs-down tip-top"></i></td>';
                }
                else{
                   echo '<td style=" text-align: center; color:blue; font-size:16px;" > <i class="icon-thumbs-up tip-top"></i></td>'; 
                }


                if (empty($r->estadoPar) or $r->estadoPar=="0" ) {
                    echo '<td style=" text-align: center; color:red; font-size:16px;" > <i class="icon-thumbs-down tip-top"></i></td>';
                  
                }
                else{
                     echo '<td style="text-align: center; color:blue; fonte-style:bold; font-size:16px;"><i class="icon-thumbs-up tip-top"></i></td>';
                }

               
                    if ($r->estadoDes==0) {
                       echo '<td style="text-align: center; color:red; fonte-style:bold; font-size:16px;"><i class="icon-thumbs-down tip-top"></i></td>';
                    }
                    else{
                       echo '<td style=" text-align: center; color:blue; font-size:16px;" > <i class="icon-thumbs-up tip-top"></i></td>'; 
                    }     

                                                  
               
                              

                echo '<td >';

                    if($this->permission->checkPermission($this->session->userdata('permissao'),'detCorrespondencia')){
                        echo '<a href="'.base_url().'index.php/correspondencias/visualizarDespacho/'.$r->id.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    
                    }
            echo  '</td>';


                echo '</tr>';
         }
        }//fecho da Terceira condicao
    }
    }
   ?>
            <tr>
                
            </tr>
        </tbody>
    </table>
    </div>
    </div>

</div>
