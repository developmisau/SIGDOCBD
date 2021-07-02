<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Correspondência</a></li>
               <div class="buttons">
                    
                        <a title="Icon Title" class="btn btn-mini btn-info" href="<?php echo base_url() ?>index.php/arquivos/correspondenciasDespachada"><i class="icon-arrow-left"></i> Voltar</a>; 
                 
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
                                                    <td style="text-align: right"><strong>Prioridade</strong></td>
                                                    <td><?php echo $result->prioridade ?></td>
                                                </tr>
                                                   <tr>
                                                    <td style="text-align: right"><strong>Proviniencia</strong></td>
                                                    <td><?php echo $result->proviniencia ?></td>
                                                </tr>
                                                  <tr>
                                                    <td style="text-align: right"><strong>Assunto</strong></td>
                                                    <td><?php echo $result->assunto ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Observação</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" id="collapseGTwo">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Observação Registro</strong></td>
                                                    <td><?php echo $result->observacao?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Observação Tramite</strong></td>
                                                    <td><?php echo $result->observacaoTra ?></td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Observação Despacho</strong></td>
                                                    <td><?php echo $result->observacaoDes ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Data</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" id="collapseGThree">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Data Cadastro</strong></td>
                                                    <td><?php echo $result->dataEmissao;?></td>
                                                </tr>

                                                 <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Data Final</strong></td>
                                                    <td><?php echo $result->dataFinal;?></td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



          
        </div>


        <!--Tab 2-->
        <div id="tab2" class="tab-pane" style="min-height: 300px">
            <?php if (!$results) { ?>
                
                        <table class="table table-bordered ">
                            <thead>
                                <tr style="backgroud-color: #2D335B">
                                    <th>#</th>
                                    <th>Data Inicial</th>
                                    <th>Data Final</th>
                                    <th>Descricao</th>
                                    <th>Defeito</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan="6">Nenhuma OS Cadastrada</td>
                                </tr>
                            </tbody>
                        </table>
                
                <?php } else { ?>


              

                        <table class="table table-bordered ">
                            <thead>
                                <tr style="backgroud-color: #2D335B">
                                    <th>#</th>
                                    <th>Data Inicial</th>
                                    <th>Data Final</th>
                                    <th>Descricao</th>
                                    <th>Defeito</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                foreach ($results as $r) {
                    $dataInicial = date(('d/m/Y'), strtotime($r->dataInicial));
                    $dataFinal = date(('d/m/Y'), strtotime($r->dataFinal));
                    echo '<tr>';
                    echo '<td>' . $r->idOs . '</td>';
                    echo '<td>' . $dataInicial . '</td>';
                    echo '<td>' . $dataFinal . '</td>';
                    echo '<td>' . $r->descricaoProduto . '</td>';
                    echo '<td>' . $r->defeito . '</td>';

                    echo '<td>';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'vOs')){
                        echo '<a href="' . base_url() . 'index.php/os/visualizar/' . $r->idOs . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'eOs')){
                        echo '<a href="' . base_url() . 'index.php/os/editar/' . $r->idOs . '" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>'; 
                    }
                    
                    echo  '</td>';
                    echo '</tr>';
                } ?>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
            

            <?php  } ?>

        </div>
    </div>
</div>