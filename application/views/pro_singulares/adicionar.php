
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-cog"></i>
                </span>
                <h5>Adicionar Proviniência Externa</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formprovinienciaExterna" method="post" class="form-horizontal" >

        <div class="control-group">
        <label style="margin-left: 10px;" for="nome" class="control-label">Nome <span class="required">*</span></label>
        <div class="controls">
       <input type="text"  name="nome" style="width: 500px; margin-left:10px;" value="<?php echo set_value('nome'); ?>" />
        </div> 

     <label style="margin-left: 10px;" for="abreviatura" class="control-label">Abreviatura <span class="required">*</span></label>
        <div class="controls">
       <input type="text"  name="abreviatura" style="width: 500px; margin-left:10px;" value="<?php echo set_value('abreviatura'); ?>" />
        </div> 

        <label style="margin-left: 10px;" for="email" class="control-label">E-mail</label>
        <div class="controls">
       <input type="email"  name="email" style="width: 500px; margin-left:10px;" value="<?php echo set_value('email'); ?>"/>
        </div>

       <label style="margin-left: 10px;" for="contacto" class="control-label">Contacto</label>
        <div class="controls">
       <input type="number"  name="contacto" style="width: 500px; margin-left:10px;" maxlength="9" minlength="9" value="<?php echo set_value('contacto'); ?>"  />
        </div>

        <label style="margin-left: 10px;" for="endereco" class="control-label">Endereço</label>
        <div class="controls">
       <input type="text"  name="endereco" style="width: 500px; margin-left:10px;" value="<?php echo set_value('endereco'); ?>"  />
        </div>                    

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-warning"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <button type="reset" class="btn btn-danger"><i class=" icon-white"></i> Limpar</button>
                                <a href="<?php echo base_url() ?>index.php/pro_externa" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

           $('#formprovinienciaExterna').validate({
            rules : {
                  nome:{ required: true},
                  abreviatura:{ required: true},
                  
                  
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  abreviatura:{ required: 'Campo Requerido.'},
                 
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




