<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Adicionar Usuários</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formUsuario" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" type="text" name="nome" value="<?php echo set_value('nome'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="apelido" class="control-label">Apelido<span class="required">*</span></label>
                        <div class="controls">
                            <input id="apelido" type="text" name="apelido" value="<?php echo set_value('apelido'); ?>"  />
                        </div>
                    </div>

                

                    <div class="control-group">
                        <label  class="control-label" >Local<span class="required">*</span></label>
                        <div class="controls">
                           <select name="direcoes" id="direcoes">
                            <option disabled selected >Selecione Direção</option>
                            <?php foreach ($direcoes as $dir) {                             
                              echo '<option value="'.$dir->id.'">'.$dir->abreviatura.'</option>';
                              } ?>
                
                            </select>

                            <select name="departamentos" id="departamentos" disabled>
                            <option value="">Selecione Departamentos </option>
                                  
                            </select>

                            <select name="reparticoes" id="reparticoes" disabled>
                            <option value="">Selecione Repartição</option>
                      
                            </select>
                        </div></div>


                    <div class="control-group">
                        <label for="email" class="control-label"><span class="required">E-mail*</span></label>
                        <div class="controls">
                            <input id="email" type="text" name="email" placeholder="@misau.gov.mz" value="<?php echo set_value('email'); ?>"  />   <label style="font-size: 12px; color: blue;">Ex: nome.apelido@misau.gov.mz</label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="senha" class="control-label">Senha<span class="required">*</span></label>
                        <div class="controls">
                            <input id="senha" type="password" name="senha"  minlength="8"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label  class="control-label">Situação*</label>
                        <div class="controls">
                            <select name="situacao" id="situacao">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label  class="control-label">Permissões<span class="required">*</span></label>
                        <div class="controls">
                            <select name="permissoes_id" id="permissoes_id">
                                  <?php foreach ($permissoes as $p) {
                                      echo '<option value="'.$p->idPermissao.'">'.$p->nome.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <button type="reset" class="btn btn-danger"><i class=" icon-white"></i> Limpar</button>

                                <a href="<?php echo base_url() ?>index.php/usuarios" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

//Combinacao de direcoes, departamentos e reparticoes.
 $(document).ready(function() {                       
                $("#direcoes").change(function() {
                    $("#direcoes option:selected").each(function() {  
                         direcoes = $('#direcoes').val();                    
                        $.post("<?php echo base_url(); ?>index.php/correspondencias/dirDep", {
                            direcoes : direcoes
                        }, function(data) {
                            $("#reparticoes").prop('disabled',true);
                            $("#reparticoes").prop('value','');
                            $("#departamentos").html(data);
                            $("#departamentos").removeAttr("disabled");

                        });
                    });
                });
            });

 $(document).ready(function() {                       
                $("#departamentos").change(function() {
                    $("#departamentos option:selected").each(function() {  
                         departamentos = $('#departamentos').val();                    
                        $.post("<?php echo base_url(); ?>index.php/correspondencias/depRep", {
                            departamentos : departamentos
                        }, function(data) {
                            $("#reparticoes").html(data);
                            $("#reparticoes").removeAttr("disabled");

                        });
                    });
                });
            });
</script>

<script type="text/javascript">
      $(document).ready(function(){

           $('#formUsuario').validate({
            rules : {
                  nome:{ required: true},
                  apelido:{ required: true},
                  direcoes:{ required: true},
                  email:{ required: true},
                  senha:{required:true}              
                  
                  
                  
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  apelido:{ required: 'Campo Requerido.'}, 
                  direcoes:{ required: 'Campo Requerido.'},
                  email:{ required: 'Campo Requerido.'},
                  senha:{required:'Campo Requerido'}
                  


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




