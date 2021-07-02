<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-cog"></i>
                </span>
                <h5>Adicionar Destinatário</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formDestinatario" method="post" class="form-horizontal" >

                    <div class="control-group">
                         <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" type="text" name="nome" style="width: 500px; margin-left:10px;" value="<?php echo set_value('nome'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="cargo" class="control-label">Cargos<span class="required">*</span></label>
                        <div class="controls">
                        <select name="cargo" id="cargo" style="width: 515px; margin-left:10px;">
                        <option disabled selected >Selecione Cargo</option>
                            <?php foreach ($cargo as $car) {                             
                              echo '<option value="'.$car->idCargo.'">'.$car->nomeCargo.'</option>';
                              } ?>

                            </select>
                        </div>
                    </div>
                    

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-warning"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <button type="reset" class="btn btn-danger"><i class=" icon-white"></i> Limpar</button>
                                <a href="<?php echo base_url() ?>index.php/destinatario" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

           $('#formDestinatario').validate({
            rules : {
                  nome:{ required: true},
                  cargo:{ required: true},
                  
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                 cargo:{ required: 'Campo Requerido.'},
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




