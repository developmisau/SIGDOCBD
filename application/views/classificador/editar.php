<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-cog"></i>
                </span>
                <h5>Editar Classificador</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formClassificador" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <?php echo form_hidden('id',$result->id) ?>
                        
                    
                        <label for="nome" class="control-label">nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" type="text" name="nome" style="width: 500px; margin-left:10px;"  value="<?php echo $result->nome; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="abreviatura" class="control-label">Codigo <span class="required">*</span></label>
                        <div class="controls">
                            <input id="codigo" type="text" name="codigo" style="width: 500px; margin-left:10px;"  value="<?php echo $result->codigo; ?>"  />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-danger"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>index.php/classificador" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

           $('#formClassificador').validate({
            rules : {
                  nome:{ required: true},
                  codigo:{ required: true}
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  codigo:{ required: 'Campo Requerido.'}

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


