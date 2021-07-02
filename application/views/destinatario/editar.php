
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Destinatário</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formDestinatario" method="post" class="form-horizontal" >

                    <div class="control-group">
                        <?php echo form_hidden('id',$result->idDestinatario) ?>
                        <label for="nome" class="control-label">Destinatário<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nome" type="text" name="nome" style="width: 500px; margin-left:10px;" value="<?php echo $result->nomeDestinatario; ?>"  />
                        </div>
                    </div>

                     <div class="control-group">
                        <label for="direccoes" class="control-label">Cargos<span class="required">*</span></label>
                        <div class="controls">
                          <select name="cargo" id="cargo" style="width: 515px; margin-left:10px;" >
                            <option disabled selected >Selecione Cargo</option>
                            <?php foreach ($cargo as $car) {
                                     if($car->idCargo == $result->cargoId){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$car->idCargo.'"'.$selected.'>'.$car->nomeCargo.'</option>';
                                  } ?>
                            </select>

                        </div>
                    </div>   

                    

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-danger"><i class="icon-ok icon-white"></i> Alterar</button>
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
                  abreviatura:{ required: true},
                  responsavel:{ required: true},
                  email:{ required: true},
                  direcoes:{ required: true},
                  
                  
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  abreviatura:{ required: 'Campo Requerido.'},
                  responsavel:{ required: 'Campo Requerido.'},
                  email:{ required: 'Campo Requerido.'},
                  direcoes:{ required: 'Campo Requerido.'},
                  
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




