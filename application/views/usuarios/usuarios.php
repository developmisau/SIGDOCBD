
<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo current_url(); ?>">
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){ ?>
             <div class="span2">
                <a href="<?php echo base_url();?>index.php/usuarios/adicionar" class="btn btn-warning span12"><i class="icon-plus-sign icon-white"></i> Adicionar</a>
            </div>  
        <?php } ?>
           
        <div class="span3">
            <input type="text" name="nome"  id="nome"  placeholder="Nome ou Apelido do Usuário" class="span12">        
        </div>

        <div class="span3">
            <input type="email" name="email"  id="email"  placeholder="E-mail do Usuário" class="span12"  >        
        </div>

        <div class="span3">
            <select name="direcoes" id="direcoes" class="span12">
                <option disabled selected >Selecione Direção</option>
                <?php foreach ($direcoes as $dir) {                             
                echo '<option value="'.$dir->id.'">'.$dir->abreviatura.'</option>';
                }?>
            </select>              
        </div>


        <div class="span1">
            <button class="span12 btn"> <i class="icon-search"></i> </button>
        </div>
    </form>
</div>
<?php
if(!$results){?>
        <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
        </span>
        <h5>Usuários</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome</th>
            <th>Direção</th>
            <th>Departamento</th>
            <th>Repartição</th>
            <th>E-mail</th>
            <th>Nível</th>
            <th></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhuma Usuário Registado</td>
        </tr>
    </tbody>
</table>
</div>
</div>


<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Usuarios</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome</th>
            <th>Direção</th>
            <th>Departamento</th>
            <th>Repartição</th>
            <th>E-mail</th>
            <th>Nível</th>
            <th>Acções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td>'.$r->id.'</td>';
            echo '<td>'.$r->nome.'</td>';
            echo '<td>'.$r->abreDir.'</td>';
            echo '<td>'.$r->abreDep.'</td>';
            echo '<td>'.$r->abreRep.'</td>';
            echo '<td>'.$r->email.'</td>';
            echo '<td>'.$r->permissao.'</td>';
            echo '<td>
                      <a href="'.base_url().'index.php/usuarios/editar/'.$r->id.'" class="btn btn-info tip-top" title="Editar Usuário"><i class="icon-pencil icon-white"></i></a>
                            
                    
            </td>';
            echo '</tr>';
          
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/usuarios/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Usurios</h5>
  </div>
  <div class="modal-body">
    <input type="text" id="id" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este Usuario?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>
<?php //echo $this->pagination->create_links();
}?>

