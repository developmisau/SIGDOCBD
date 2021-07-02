<?php 
$direcoes=$this->session->userdata('local_direcoes'); 
$departamentos=$this->session->userdata('local_departamentos'); 
$reparticoes=$this->session->userdata('local_reparticoes'); 
$i=0;
 ?>
<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Historico da Correspondência</a></li>
               <div class="buttons">
                    
                        <a title="Icon Title" class="btn btn-mini btn-info" href="<?php echo base_url() ?>index.php/correspondencias/despachos_feitos "><i class="icon-arrow-left"></i> Voltar</a> 
                 
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
                                            <span class="icon"><i class="icon-list"></i></span><h5>Despacho</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" id="collapseGThree">
                                    <div class="widget-content">

 <table class="table table-bordered">
                                            <tbody>    
                                        <?php if (!empty($resultDes2)) { 
                                        foreach ($resultDes1 as $r) {
                                        if ($r->idCorres==$this->uri->segment(3)) { ?>
                                            <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Local Despacho (Direção)</strong></td>
                                                    <td><?php echo $r->local_direcoes?></td>
                                            </tr>

                                              <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Local Despacho (Departamento)</strong></td>
                                                    <td><?php echo $r->local_departamentos?></td>
                                            </tr>

                                            <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Local Despacho (Repartição)</strong></td>
                                                    <td><?php echo $r->local_reparticoes?></td>
                                            </tr>

                                            <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Responsavel</strong></td>
                                                    <td><?php echo $r->usuarios ?></td>
                                            </tr>                                       
                                            
                                           
                                        <?php } } if ($resultDes2->passarAoSr <>"") {?>
                     
                                            <tr>                                         
                                                <td style="text-align: right; width: 30%"><strong>Passar ao Senhor</strong></td>
                                                <td><?php echo $resultDes2->passarAoSr;?></td>
                                            </tr>                                          
                                        <?php } ?>

                                        <?php foreach ($resultDes2 as $r ): 
                                         if ($r<>"" and $r<>$resultDes2->id and $r<>$resultDes2->correspondencias_id and $r<>$resultDes2->usuarios_id and $r<>$resultDes2->observacao and $r<>$resultDes2->data_despacho and $r<>$resultDes2->passarAoSr and $r<>$resultDes2->parecer_id and $r<>$resultDes2->direcoes_id and $r<>$resultDes2->departamentos_id and $r<>$resultDes2->reparticoes_id) { ?>

                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Conteúdo do Despacho</strong></td>
                                                    <td style="font-size: 14px;"><?php echo $r ?></td>
                                                    </tr>
                                            <?php } endforeach ?>

                                        <tr>
                                        <td style="text-align: right; width: 30%"><strong>Observação</strong></td>
                                        <td style="font-size: 14px;"><?php echo $resultDes2->observacao ?></td> 
                                        </tr>   

                                        <tr>
                                        <td style="text-align: right; width: 30%"><strong>Tempo de Permanência no Sistema</strong></td>
                                        <td><?php 
                                        $data1= new DateTime($result->date);
                                        $data2 = new DateTime($resultDes2->data_despacho );
                                        $intervalo = $data1->diff( $data2);
                                        echo $intervalo->format( '%y Anos, %m Meses, %d Dias, %H Horas, %i Minutos e %s Segundos' ); ?></td>

                                                    
                                    </tr> 
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