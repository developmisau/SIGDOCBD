<?php 
$ultimo_id_dir;
$ultimo_id_dep;
 ?>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Usuário</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formUsuario" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <?php echo form_hidden('id',$result->id) ?>
                        <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" type="text" name="nome" value="<?php echo $result->nome; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="apelido" class="control-label">Apelido<span class="required">*</span></label>
                        <div class="controls">
                            <input id="apelido" type="text" name="apelido" value="<?php echo $result->apelido; ?>"  />
                        </div>
                    </div>                

                    <div class="control-group">
                        <label  class="control-label" >Local<span class="required">*</span></label>
                        <div class="controls">
                       
                            <select name="direcoes" id="direcoes">
                            <option disabled selected >Selecione Direção</option>
                            <?php foreach ($direcoes as $dir) { 

                              if($dir->id == $result->direcoes_id){ 
                                $selected = 'selected';
                                $ultimo_id_dir=$dir->id;
                            }
                              else{$selected = '';}
                            echo '<option value="'.$dir->id.'"'.$selected.'>'.$dir->abreviatura.'</option>';
                                   
                              } ?>

                
                            </select>

                            <select name="departamentos" id="departamentos">

                            <?php   if ($result->departamentos_id==0) {
                            echo '<option value="">'.'Selecione o departamentos acima'.'</option>';
                              }
                            else{
                             foreach ($departamentos as $dep) {
                                if($dep->id == $result->departamentos_id ){
                                 $selected = 'selected';
                                $ultimo_id_dep=$dep->id;
                             }else{$selected = '';}                                    
                                  if ($dep->direcoes_id==$ultimo_id_dir ) {
                                echo '<option value="'.$dep->id.'"'.$selected.'>'.$dep->nome.'</option>';
                                  }
                                     
                                    } } ?>
                           
                                  
                            </select>

                            <select name="reparticoes" id="reparticoes">
                             <?php  if ($result->reparticoes_id==0) {
                            echo '<option value="">'.'Selecione a repartição acima'.'</option>';
                              }
                            else{
                             foreach ($reparticoes as $rep) {
                                     if($rep->id == $result->reparticoes_id){ $selected = 'selected';}else{$selected = '';}                                    
                                  
                                if ($rep->departamentos_id==$ultimo_id_dep ) {
                                      echo '<option value="'.$rep->id.'"'.$selected.'>'.$rep->nome.'</option>';
                                  }
                                    } } ?>
                      
                            </select>
                        </div>

                    <div class="control-group">
                        <label  class="control-label">Situação*</label>
                        <div class="controls">
                            <select name="situacao" id="situacao">
                                <?php if($result->situacao == 1){$ativo = 'selected'; $inativo = '';} else{$ativo = ''; $inativo = 'selected';} ?>
                                <option value="1" <?php echo $ativo; ?>>Ativo</option>
                                <option value="0" <?php echo $inativo; ?>>Inativo</option>
                            </select>
                        </div>
                    </div>


                    <div class="control-group">
                        <label  class="control-label">Permissões<span class="required">*</span></label>
                        <div class="controls">
                            <select name="permissoes_id" id="permissoes_id">
                                  <?php foreach ($permissoes as $p) {
                                     if($p->idPermissao == $result->permissoes_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$p->idPermissao.'"'.$selected.'>'.$p->nome.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>

                       <div class="control-group">
                         <label for="email" class="control-label">E-mail<span class="required">*</span></label>
                        <div class="controls">
                            <input id="email" type="text" name="email" value="<?php echo $result->email; ?>"  />
                            <label style="font-size: 12px; color: blue;">Ex: nome.apelido@misau.gov.mz</label>
                        </div>
                    </div>

                                       
                    <div class="control-group">
                        <label for="senha" class="control-label">Senha</label>
                        <div class="controls">
                            <input id="senha" type="password" name="senha" placeholder="Reset da senha do usuário"  minlength="8" />
                            <i class="icon-exclamation-sign tip-top" title="Se não quiser alterar a senha, não preencha esse campo."></i>
                        </div>
                    </div>

                    
                    

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
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
<script  src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">

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
                  email:{ required: true}
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  apelido:{ required: 'Campo Requerido.'}, 
                  direcoes:{ required: 'Campo Requerido.'},
                  email:{ required: 'Campo Requerido.'}
                  
                  
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


