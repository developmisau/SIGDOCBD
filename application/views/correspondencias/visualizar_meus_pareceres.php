<?php 
$direcoes=$this->session->userdata('local_direcoes'); 
$departamentos=$this->session->userdata('local_departamentos'); 
$reparticoes=$this->session->userdata('local_reparticoes'); 
$i=0;
$idCorre=$this->uri->segment(3);
$idParecer=$this->uri->segment(4);
 ?>
<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Historico da Correspondência</a></li>
               <div class="buttons">
                    
                        <a title="Icon Title" class="btn btn-mini btn-info" href="<?php echo base_url() ?>index.php/correspondencias/pareceres_feitos "><i class="icon-arrow-left"></i> Voltar</a> 
                 
            </div>
        </ul>
    </div>
    <div class="widget-content tab-content">
        <div id="tab1" class="tab-pane active" style="min-height: 300px">

            <div class="accordion" id="collapse-group">
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Dados da Correspondência</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse in accordion-body" id="collapseGOne">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Correspondência</strong></td>
                                                    <td><?php echo $result->numCorrespondencia ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Proviniência</strong></td>
                                                    <td><?php echo $result->tipo_pro ?></td>
                                                </tr>
                                                   <tr>
                                                    <td style="text-align: right"><strong>Ref. Recepção</strong></td>
                                                    <td><?php echo $result->refRec ?></td>
                                                </tr>
                                                  <tr>
                                                    <td style="text-align: right"><strong>Assunto</strong></td>
                                                    <td><?php echo $result->assunto ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Data Entrada</strong></td>
                                                    <td><?php echo $result->date ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- Fechar menu 1 -->                           

                           
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Parecer </h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" id="collapseGThree">
                                    <div class="widget-content">


                                        <table class="table table-bordered">
                                            <tbody>
                                    
    <?php 
    foreach ($resultPar as $r)  {  
                                            
       if ($r->local_direcoes_id==$direcoes and $r->local_departamentos_id==$departamentos and $r->local_reparticoes_id==$reparticoes and $r->id==$idParecer):   ?>                                                        
            <tr style="background-color: blue; font-weight: bold; color: white" ><td >Conteudo do Parecer</td></tr>  <?php $i--; ?>              
                                             
                                            <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Local Parecer (Direção)</strong></td>
                                                    <td><?php echo $r->local_direcoes?></td>
                                            </tr>

                                              <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Local Parecer (Departamento)</strong></td>
                                                    <td><?php echo $r->local_departamentos?></td>
                                            </tr>

                                            <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Local Parecer (Repartição)</strong></td>
                                                    <td><?php echo $r->local_reparticoes?></td>
                                            </tr>

                                            <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Responsavel</strong></td>
                                                    <td><?php echo $r->usuarios ?></td>
                                            </tr>

                                            <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Parecer</strong></td>
                                                    <td><?php echo $r->parecer ?></td>
                                            </tr>

                                            <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Data Parecer</strong></td>
                                                    <td><?php echo $r->data_parecer ?></td>
                                            </tr>

                                                

                                              <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Tempo de Permanência (Tramite - Parecer)</strong></td>
                                                    <td><?php 
                                                    $data1= new DateTime($r->data_tramitar);
                                                    $data2 = new DateTime($r->data_parecer );
                                                    $intervalo = $data1->diff( $data2);

                                                  echo $intervalo->format( '%y Anos, %m Meses, %d Dias, %H Horas, %i Minutos e %s Segundos' ); 

                                                    ?></td></tr>

                                            <?php endif ?>
                                            <?php } ?>

                                                

                                             
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- Fechar menu parecer -->

                            
                         
                        </div>



          
        </div>


        
    </div>
</div>