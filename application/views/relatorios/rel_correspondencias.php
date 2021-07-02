<!-- JS file -->
<script src=" <?php echo base_url(); ?>js/Autocomplete/dist/jquery.easy-autocomplete.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>

<!-- CSS file -->
<link rel="stylesheet" href="js/Autocomplete/dist/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="js/Autocomplete/dist/easy-autocomplete.themes.min.css"> 

<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>

<div class="row-fluid" style="margin-top: 0">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-list-alt"></i>
                </span>
                <h5>Relatórios Rápidos</h5>
            </div>
            <div class="widget-content">
                <ul class="site-stats">
                    <li><a target="_blank" href="<?php echo base_url()?>index.php/relatorios/correspondenciasRapid"><i class="icon-barcode"></i> <small>Todas Correspondências</small></a></li>
                    
                </ul>
            </div>
        </div>
    </div>

    <div class="span8">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-list-alt"></i>
                </span>
                <h5>Relatórios Customizáveis</h5>
            </div>
            <div class="widget-content">
                <div class="span12 well">
                    <div class="span12 alert alert-info">Deixe em branco caso não deseje utilizar o parâmetro.</div>
                    <form target="_blank" action="<?php echo base_url() ?>index.php/relatorios/correspondenciasCustom" method="get">
                        <div class="span12 well">
                            <div class="span6">
                                <label for="">Tipo de Proviniência:</label>
                                <select name="tipo_pro" class="span12">
                                    <option >Selecione  Proviniência</option>
                                    <option value="Interna">Interna</option>
                                    <option value="Externa">Externa</option>
                                </select>
                                
                            </div>
                            <div class="span6">
                                <label for="">Tipo de Documento:</label>
                               <select name="tipo_doc" class="span12">
                                   <option>Selecione Tipo de Documento</option>
                                    <?php foreach ($tipoDoc as $t) {?>                                   
                                <option value="<?php echo $t->id ?>">
                              <?php echo $t->nome ?></option>

                                 <?php  } ?>
                               </select>
                            </div>
                        </div>
                        <div class="span12 well" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Classificador:</label>            
                <input  id="codigoAssunto" type="text" name="codigoAssunto" class="span12"  />
                <input type="hidden" id="classificacao_id" type="text" name="classificacao_id" readonly="true"  />
      
                
                            </div>
                            <div class="span6">
                                <label for="">Prioridade:</label>
                                <select name="prioridades" class="span12">
                                   <option>Selecione Prioridade</option>
                                    <?php foreach ($prioridades as $p) {?>                                   
                                <option value="<?php echo $p->id ?>">
                              <?php echo $p->nome ?></option>

                                 <?php  } ?>
                               </select>
                            </div>
                        </div>
                        <div class="span12 well" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Direção:</label>
                                <select name="direcoes" id="direcoes" class="span12">
                            <option>Selecione Direção</option>
                            <?php foreach ($direcoes as $dir) {                             
                              echo '<option value="'.$dir->id.'">'.$dir->abreviatura.'</option>';
                              } ?>
                
                            </select>
                            </div>
                            <div class="span6">
                                <label for="">Departamento:</label>
                                <select name="departamentos" id="departamentos" disabled class="span12">
                                <option value="">Selecione Departamento </option>    
                                </select>
                            </div>
                        </div>
                        <div class="span12 well" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Reparticao:</label>
                                <select name="reparticoes" id="reparticoes" class="span12">
                                    <option>Selecione Repartição</option>
                                </select>
                            </div>
                            <div class="span6">
                                <label for="">Provincia Externa:</label>
                       <input  id="externa" type="text" name="externa" class="span12"  />
    <input type="hidden" id="pro_externa_id" type="text" name="pro_externa_id" readonly="true"  />
                            </div>
                        </div>
                        <div class="span12 well" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Usuário:</label>
                        <input  id="usuarios" type="text" name="usuarios" class="span12"  />
                        <input type="hidden" id="usuarios_id" type="text" name="usuarios_id" readonly="true"  />
                            </div>
                            <div class="span6">
                                <label for="">Estado Tramite:</label>
                               <select name="tramite" class="span12">
                               <option>Selecione Estado Tramite </option>
                               <option value="1">SIM</option>
                               <option value="0">NÃO</option>
                                   
                               </select>
                            </div>
                        </div>
                    <div class="span12 well" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Estado Parecer:</label>
                               <select name="tramite" class="span12">
                               <option>Selecione Estado Parecer</option>
                               <option value="1">SIM</option>
                               <option value="0">NÃO</option>
                                   
                               </select>
                            </div>
                            <div class="span6">
                                <label for="">Estado Despacho:</label>
                               <select name="tramite" class="span12">
                               <option>Selecione Estado Despacho</option>
                               <option value="1">SIM</option>
                               <option value="0">NÃO</option>
                                   
                               </select>
                            </div>
                        </div>
                        <div class="span12 well" style="margin-left: 0">
                            <div class="span6">
                                <label for="">Data de::</label>
                                <input  type="date" name="dataInicial" class="span12" />
                            </div>
                            <div class="span6">
                                <label for="">Até:</label>
                                <input type="date" name="dataFinal" class="span12" />
                            </div>
                        </div>
                        <div class="span12" style="margin-left: 0; text-align: center">
                            <input type="reset" class="btn" value="Limpar" />
                            <button class="btn btn-inverse"><i class="icon-print icon-white"></i> Imprimir</button>
                        </div>
                    </form>
                </div>
                .
            </div>
        </div>
    </div>
</div>


<!-- JS file for form -->  
  <?php include '/../correspondencias/interacao.js'; ?>   