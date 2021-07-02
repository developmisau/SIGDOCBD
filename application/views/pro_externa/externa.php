<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo current_url(); ?>">
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aCorrespondencia')){ ?>
             <div class="span2">
                <a href="<?php echo base_url();?>index.php/pro_externa/adicionar" class="btn btn-warning span12"><i class="icon-plus-sign icon-white"></i> Adicionar</a>
            </div>  
        <?php } ?>
           
        <div class="span4">
            <input type="text" name="pesquisa"  id="pesquisa"  placeholder="Proviniência, Abreviatura, Contacto ou E-mail" class="span12" value="<?php echo $this->input->get('pesquisa'); ?>" >      
        </div>
        <div class="span3">
            <input type="date" name="data"  id="data"  placeholder="Data de" class="span12 datepicker" value="<?php echo $this->input->get('data'); ?>">
            <input type="date" name="data2"  id="data2"  placeholder="Data até" class="span12 datepicker" value="<?php echo $this->input->get('data2'); ?>" >                
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
            <i class="icon-cog"></i>
        </span>
        <h5>Proviniencia Externa</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome</th>
            <th>Abreviatura</th>
            <th>E-mail</th>
            <th>Contacto</th>

        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhuma Proviniencia Externa Registrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>


<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-cog"></i>
         </span>
        <h5>Proviniencia Externa</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome</th>
            <th>Abreviatura</th>
            <th>E-mail</th>
            <th>Contacto</th>
            <th>Acção</th>            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td>'.$r->id.'</td>';
            echo '<td>'.$r->nome.'</td>';
            echo '<td>'.$r->abreviatura.'</td>';
            echo '<td>'.$r->email.'</td>';
            echo '<td>'.$r->contacto.'</td>';
            echo '<td>
                      <a href="'.base_url().'index.php/pro_externa/editar/'.$r->id.'" class="btn btn-info tip-top" ><i class="icon-pencil icon-white"></i></a>




                  </td>';
            echo '</tr>';

        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>

    

<?php //echo $this->pagination->create_links();
}?>
