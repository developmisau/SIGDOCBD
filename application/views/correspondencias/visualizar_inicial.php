<?php 
$idTramitar=0;
$ultima_data_parecer=0;
$i=1; ?>
<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Historico da Correspondência</a></li>
               <div class="buttons">
                    
                        <a title="Icon Title" class="btn btn-mini btn-info" href="<?php echo base_url() ?>index.php/correspondencias/gerenciar "><i class="icon-arrow-left"></i> Voltar</a> 
                 
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
                                                <td rowspan="6" style="text-align: center;">
                                                <?php if (!empty($result->url)) {?>
                                                        <iframe src="<?php echo $result->url ?>" width="800" height="400" style="border: none;"></iframe>
                                                    <?php } ?> 

                                                <?php if (empty($result->url)) {?>
                                                    <iframe  width="0" height="20" style="border: none;">
                                                        </iframe>
                                                        <span class="icon" style="font-size: 80px"><i class="icon-file"></i></span><h5>SEM ANEXO</h5>
                                                    <?php } ?> 
                                                    

                                                    <tr>
                                                    <td style="text-align: right;"><strong>Correspondência</strong></td>
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
                                            
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- Fechar menu 1 -->

                            
                         
                        </div>



          
        </div>


        
    </div>
</div>