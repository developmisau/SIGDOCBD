<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo current_url(); ?>">
        
        <div class="span5">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Digite  Numero da Correspondência para pesquisar" class="span12" value="<?php echo $this->input->get('pesquisa'); ?>" >        
        </div>
        <div class="span3">
            <input type="text" name="data"  id="data"  placeholder="Data de" class="span6 datepicker" value="<?php echo $this->input->get('data'); ?>">
            <input type="text" name="data2"  id="data2"  placeholder="Data até" class="span6 datepicker" value="<?php echo $this->input->get('data2'); ?>" >                
        </div>
        <div class="span1">
            <button class="span12 btn"> <i class="icon-search"></i> </button>
        </div>
    </form>
</div>

<?php
if(!$results){?>

<div class="span12" style="margin-left: 0">
        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
            </span>
            <h5>Correspondência</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                       <th>Correspondência</th>
                        <th>Prioridade</th>
                        <th>Tipo Proveniencia</th>
                        <th>Proviniencia</th>
                        <th>Data Emissão</th>
                        <th>Acção</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhuma Correspondência Encontrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php }else{ ?>

<div class="span12" style="margin-left: 0">
    <div class="widget-box">
         <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
             </span>
            <h5>Correspondência</h5>

         </div>

    <div class="widget-content nopadding">


    <table class="table table-bordered ">
        <thead>
            <tr>
              
                         <th>Correspondência</th>
                        <th>Prioridade</th>
                        <th>Tipo Proveniencia</th>
                        <th>Proviniencia</th>
                        <th>Data Emissão</th>
                        <th>Acção</th>
                        
            </tr>
        </thead>
        <tbody>

            <?php  
                $localUser=$this->session->userdata('local'); 

                foreach ($results as $r) {  
            
                
                if ($r->estadoTra=='SIM' and $r->estadoVer=='SIM' and $r->destino==$localUser and $r->estadoDes=='NAO') {
                   
                
                echo '<tr>';
                echo '<td>'.$r->numCorrespondencia.'</td>';
                echo '<td>'.$r->prioridade.'</td>';
                echo '<td>'.$r->tipoProviniencia.'</td>';
                echo '<td>'.$r->proviniencia.'</td>';
                echo '<td>'.$r->dataEmissao.'</td>';
               
               

                echo '<td>';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'vArquivo')){
                        echo '<a href="'.base_url().'index.php/arquivos/visualizar/'.$r->idCorrespondencia.'"  class="btn tip-top" style="margin-right: 1%" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'vArquivo')){
                        echo '<a class="btn btn-inverse tip-top" style="margin-right: 1%" target="_blank" href="'.$r->url.'" class="btn tip-top" title="Imprimir"><i class="icon-print"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'vArquivo')){
                        echo '<a href="#modal-despacho" style="margin-right: 1%" role="button" data-toggle="modal" idDespacho="'.$r->idCorrespondencia.'" correspondenciaDes="'.$r->numCorrespondencia.'" prioridadeDes="'.$r->prioridade.'" class="btn tip-top" title="Despacho"><i class="icon-download-alt icon-white"></i></a>'; 
                    }
                    
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'dArquivo')){
                         echo '<a href="#modal-tramitar" style="margin-right: 1%" role="button" data-toggle="modal" idTramite="'.$r->idCorrespondencia.'" correspondenciaTra="'.$r->numCorrespondencia.'" prioridadeTra="'.$r->prioridade.'" class="btn btn-danger tip-top" title="tramitir"><i class="icon-share-alt icon-white"></i></a>';
                    }
                echo  '</td>';
                echo '</tr>';
            }}
            ?>
            <tr>
                
            </tr>
        </tbody>
    </table>
    </div>
    </div>

</div>
<?php echo $this->pagination->create_links();}?>

 <!-- Modal Despacho-->
<div id="modal-despacho" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/arquivos/despacho" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Despacho da Correspondência</h5>
  </div>

  <label style="padding-top: 20px; margin-left: 10px;" for="observacao" class="control-label">Dados da Correspondência:</label>
  
    <input style="border: 0; margin-left: 10px;" type="text"  disabled id="correspondenciaDes">

     <input style="border: 0;margin-left: 10px;" type="text"  disabled id="prioridadeDes">

    <input type="hidden" id="estadoDes" name="estadoDes" value="SIM" />
    <input type="hidden" id="idDespacho" name="id" />

    <label style="margin-left: 10px;" for="observacao" class="control-label">Observação</label>
        <div class="controls">
       <textarea style="width: 500px; margin-left:10px;" rows="3" cols="30" name="observacao" id="observacao" required></textarea>
        </div> 
   
  
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Despacho</button>
  </div>
  </form>
</div>

 <!-- Modal Tramite-->
<div id="modal-tramitar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/arquivos/" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Tramitar Correspondencia</h5>
  </div>

  <label style="padding-top: 20px; margin-left: 10px;" for="observacao" class="control-label">Dados da Correspondência:</label>
  
    <input style="border: 0; margin-left: 10px;" type="text"  disabled id="correspondenciaTra">

     <input style="border: 0;margin-left: 10px;" type="text"  disabled id="prioridadeTra">

  <div  class="control-group" >
                
   <div class="controls" style="padding-top: 20px; margin-left: 10px;">
                    <select name="idDirecao" id="idDirecao" style="  width: 145px; margin-right: 10px;">
                    <option value="">Selecione Direcao</option>
                <?php foreach ($direcao as $dir) {
                                   
                   
            echo '<option value="'.$dir->idDirecao.'">'.$dir->abrevDirecao.'</option>'; } ?>
                
                            </select>

                 <select name="idDepartamento" id="idDepartamento" style="width: 190px; margin-right: 10px;">
                            <option value="">Selecione Departamento </option>
                    </select>

                <select name="idReparticao" id="idReparticao" style="width:170px ; margin-right: 10px;">
                            <option value="">Selecione Reparticao</option>
                    </select>
                
                </div>  
                
    <input type="hidden" id="estadoTra" name="estadoTra" value="SIM" />
    <input type="hidden" id="idTramite" name="id" />

    <label style="margin-left: 10px;" for="observacao" class="control-label">Observação</label>
        <div class="controls">
       <textarea style="width: 500px; margin-left:10px;" rows="3" cols="30" name="observacao" id="observacao" required></textarea>
        </div>  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Tramitar</button>
  </div>
  </form>
</div>



<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var idTramite = $(this).attr('idTramite');
        $('#idTramite').val(idTramite);

        var idDespacho = $(this).attr('idDespacho');
        $('#idDespacho').val(idDespacho);

         var correspondenciaTra = $(this).attr('correspondenciaTra');
        $('#correspondenciaTra').val(correspondenciaTra);

        var prioridadeTra = $(this).attr('prioridadeTra');
        $('#prioridadeTra').val(prioridadeTra);

         var correspondenciaDes = $(this).attr('correspondenciaDes');
        $('#correspondenciaDes').val(correspondenciaDes);

        var prioridadeDes = $(this).attr('prioridadeDes');
        $('#prioridadeDes').val(prioridadeDes);

   });



   $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});

</script>

<script type="text/javascript">

  $(document).ready(function() {                       
                $("#idDirecao").change(function() {
                    $("#idDirecao option:selected").each(function() {
                        idDirecao = $('#idDirecao').val();
                        $.post("<?php echo base_url(); ?>index.php/arquivos/fillCiudades", {
                            idDirecao : idDirecao
                        }, function(data) {
                            $("#idDepartamento").html(data);
                        });
                    });
                });
            });

    $(document).ready(function() {                       
                $("#idDepartamento").change(function() {
                    $("#idDepartamento option:selected").each(function() {
                        idDepartamento = $('#idDepartamento').val();
                        $.post("<?php echo base_url(); ?>index.php/arquivos/fillCiudades2", {
                            idDepartamento : idDepartamento
                        }, function(data) {
                            $("#idReparticao").html(data);
                        });
                    });
                });
            });
</script>

