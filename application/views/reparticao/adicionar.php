<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-cog"></i>
                </span>
                <h5>Adicionar Repartição</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formReparticoes" method="post" class="form-horizontal" >

                    <div class="control-group">
                        <label for="direccoes" class="control-label">Direção<span class="required">*</span></label>
                        <div class="controls">
                          <select name="direcoes" id="direcoes" style="width: 515px; margin-left:10px;">
                            <option disabled selected >Selecione Direção</option>
                            <?php foreach ($direcoes as $dir) { 

                              if($dir->id == $result->direcoes_id){ 
                                $selected = 'selected';
                                $ultimo_id_dir=$dir->id;
                            }
                              else{$selected = '';}
                            echo '<option value="'.$dir->id.'"'.$selected.'>'.$dir->nome.'</option>';
                                   
                              } ?>

                            </select>

                        </div>
                    </div>

                    <div class="control-group">
                        <label for="departamentos" class="control-label">Departamentos<span class="required">*</span></label>
                        <div class="controls">
                          <select name="departamentos" id="departamentos"style="width: 515px; margin-left:10px;" >
                            <option disabled selected >Selecione Departamento</option>
                            
                            </select>

                        </div>
                    </div>

                    <div class="control-group">
                        <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" type="text" name="nome" style="width: 500px; margin-left:10px;" value="<?php echo set_value('nome'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="abreviatura" class="control-label">Abreviatura<span class="required">*</span></label>
                        <div class="controls">
                            <input id="abreviatura" type="text" name="abreviatura" style="width: 500px; margin-left:10px;" value="<?php echo set_value('abreviatura'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="responsavel" class="control-label">Responsável <span class="required">*</span></label>
                        <div class="controls">
                            <input id="responsavel" type="text" name="responsavel" style="width: 500px; margin-left:10px;" value="<?php echo set_value('responsavel'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="email" class="control-label">E-mail<span class="required">*</span></label>
                        <div class="controls">
                            <input id="email" type="text" name="email" style="width: 500px; margin-left:10px;" value="<?php echo set_value('email'); ?>"  />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-warning"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <button type="reset" class="btn btn-danger"><i class=" icon-white"></i> Limpar</button>
                                <a href="<?php echo base_url() ?>index.php/reparticao" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<script  src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>

<script type="text/javascript">
      $(document).ready(function(){

           $('#formReparticoes').validate({
            rules : {
                  nome:{ required: true},
                  abreviatura:{ required: true},
                  responsavel:{ required: true},
                  email:{ required: true},
                  direcoes:{ required: true},
                  departamentos:{ required: true},
                  
                  
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  abreviatura:{ required: 'Campo Requerido.'},
                  responsavel:{ required: 'Campo Requerido.'},
                  email:{ required: 'Campo Requerido.'},
                  direcoes:{ required: 'Campo Requerido.'},
                  departamentos:{ required: 'Campo Requerido.'},
                  
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });

      });
</script>


<script type="text/javascript">
  //Combinacao de direcoes, departamentos e reparticoes.
 $(document).ready(function() {                       
                $("#direcoes").change(function() {
                    $("#direcoes option:selected").each(function() {  
                         direcoes = $('#direcoes').val();                    
                        $.post("<?php echo base_url(); ?>index.php/correspondencias/dirDep", {
                            direcoes : direcoes
                        }, function(data) {
                            //$("#externa").prop('disabled',true);
                            $("#reparticoes").prop('disabled',true);
                            $("#reparticoes").prop('value','');
                            $("#departamentos").html(data);
                            $("#departamentos").removeAttr("disabled");

                        });
                    });
                });
            });

</script>                        



