<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-cog"></i>
                </span>
                <h5>Editar Direção</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formDirecao" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <?php echo form_hidden('id',$result->id) ?>
                        <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" type="text" name="nome" style="width: 500px; margin-left:10px;" value="<?php echo $result->nome; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="abreviatura" class="control-label">Abreviatura<span class="required">*</span></label>
                        <div class="controls">
                            <input id="abreviatura" type="text" name="abreviatura" style="width: 500px; margin-left:10px;" value="<?php echo $result->abreviatura; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="email" class="control-label">E-mail<span class="required">*</span></label>
                        <div class="controls">
                            <input id="email" type="email" name="email" style="width: 500px; margin-left:10px;" value="<?php echo $result->email; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="responsavel" class="control-label">Responsável <span class="required">*</span></label>
                        <div class="controls">
                            <input id="responsavel" type="text" name="responsavel" style="width: 500px; margin-left:10px;" value="<?php echo $result->responsavel; ?>"  />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-danger"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>index.php/direcao" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

           $('#formDirecao').validate({
            rules : {
                  nome:{ required: true},
                  abreviatura:{ required: true},
                  responsavel:{ required: true},
                  email:{ required: true}
                  
                  
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  abreviatura:{ required: 'Campo Requerido.'},
                  responsavel:{ required: 'Campo Requerido.'},
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




