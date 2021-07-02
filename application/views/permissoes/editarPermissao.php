<?php $permissoes = unserialize($result->permissoes);?>
<div class="span12" style="margin-left: 0">
    <form action="<?php echo base_url();?>index.php/permissoes/editar" id="formPermissao" method="post">

    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-lock"></i>
                </span>
                <h5>Editar Permissão</h5>
            </div>
            <div class="widget-content">
                
                <div class="span4">
                    <label>Nome da Permissão</label>
                    <input name="nome" type="text" id="nome" class="span12" value="<?php echo $result->nome; ?>" />
                    <input type="hidden" name="idPermissao" value="<?php echo $result->idPermissao; ?>">

                </div>

                <div class="span3">
                    <label>Situação</label>
                    
                    <select name="situacao" id="situacao" class="span12">
                        <?php if($result->situacao == 1){$sim = 'selected'; $nao ='';}else{$sim = ''; $nao ='selected';}?>
                        <option value="1" <?php echo $sim;?>>Ativo</option>
                        <option value="0" <?php echo $nao;?>>Inativo</option>
                    </select>

                </div>
                <div class="span4">
                    <br/>
                    <label>
                        <input name="" type="checkbox" value="1" id="marcarTodos" />
                        <span class="lbl"> Marcar Todos</span>

                    </label>
                    <br/>
                </div>

                <div class="control-group">
                    <label for="documento" class="control-label"></label>
                    <div class="controls">

                        <table class="table table-bordered">
                            <tbody>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vCorrespondencia'])){ if($permissoes['vCorrespondencia'] == '1'){echo 'checked';}}?> name="vCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aCorrespondencia'])){ if($permissoes['aCorrespondencia'] == '1'){echo 'checked';}}?> name="aCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eCorrespondencia'])){ if($permissoes['eCorrespondencia'] == '1'){echo 'checked';}}?> name="eCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Correspondência</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dCorrespondencia'])){ if($permissoes['dCorrespondencia'] == '1'){echo 'checked';}}?> name="dCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Correspondência</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['iProtocolo'])){ if($permissoes['iProtocolo'] == '1'){echo 'checked';}}?> name="iProtocolo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Imprimir Protocolo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['tCorrespondencia'])){ if($permissoes['tCorrespondencia'] == '1'){echo 'checked';}}?> name="tCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">Tramitar Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['pCorrespondencia'])){ if($permissoes['pCorrespondencia'] == '1'){echo 'checked';}}?> name="pCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Parecer Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['despCorrespondencia'])){ if($permissoes['despCorrespondencia'] == '1'){echo 'checked';}}?> name="despCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Despacho Correspondência</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['confRecepcao'])){ if($permissoes['confRecepcao'] == '1'){echo 'checked';}}?> name="confRecepcao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Confirmação da Recepção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['detCorrespondencia'])){ if($permissoes['detCorrespondencia'] == '1'){echo 'checked';}}?> name="detCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Detalhes Correspondencias</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['iCorrespondencia'])){ if($permissoes['iCorrespondencia'] == '1'){echo 'checked';}}?> name="iCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Imprimir Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['Relatorios'])){ if($permissoes['Relatorios'] == '1'){echo 'checked';}}?> name="Relatorios" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatorios</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                      <td>
                                        <label>
                                            <input <?php if(isset($permissoes['estEstado'])){ if($permissoes['estEstado'] == '1'){echo 'checked';}}?> name="estEstado" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">Estado Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['estDespacho'])){ if($permissoes['estDespacho'] == '1'){echo 'checked';}}?> name="estDespacho" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Estado Despacho</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['estRecebido'])){ if($permissoes['estRecebido'] == '1'){echo 'checked';}}?> name="aOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Estado Recebido</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['estPendente'])){ if($permissoes['estPendente'] == '1'){echo 'checked';}}?> name="estPendente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Estado Pendente</span>
                                        </label>
                                    </td>

                                    
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vTipoDoc'])){ if($permissoes['vTipoDoc'] == '1'){echo 'checked';}}?> name="vTipoDoc" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">  Visualizar Tipo de Doc.</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aTipoDoc'])){ if($permissoes['aTipoDoc'] == '1'){echo 'checked';}}?> name="aTipoDoc" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Tipo de Doc.</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eTipoDoc'])){ if($permissoes['eTipoDoc'] == '1'){echo 'checked';}}?> name="eTipoDoc" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">Editar Tipo de Doc.</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dTipoDoc'])){ if($permissoes['dTipoDoc'] == '1'){echo 'checked';}}?> name="dTipoDoc" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Tipo de Doc.</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                 <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vDirecao'])){ if($permissoes['vDirecao'] == '1'){echo 'checked';}}?> name="vDirecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">  Visualizar Direção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aDirecao'])){ if($permissoes['aDirecao'] == '1'){echo 'checked';}}?> name="aDirecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Direção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eDirecao'])){ if($permissoes['eDirecao'] == '1'){echo 'checked';}}?> name="eDirecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">Editar Direção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dDirecao'])){ if($permissoes['dDirecao'] == '1'){echo 'checked';}}?> name="dDirecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Direção</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vDepartamento'])){ if($permissoes['vDepartamento'] == '1'){echo 'checked';}}?> name="vDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aDepartamento'])){ if($permissoes['aDepartamento'] == '1'){echo 'checked';}}?> name="aDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eDepartamento'])){ if($permissoes['eDepartamento'] == '1'){echo 'checked';}}?> name="eDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dDepartamento'])){ if($permissoes['dDepartamento'] == '1'){echo 'checked';}}?> name="dDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Departamento</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vReparticao'])){ if($permissoes['vReparticao'] == '1'){echo 'checked';}}?> name="vReparticao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Repartição</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aReparticao'])){ if($permissoes['aReparticao'] == '1'){echo 'checked';}}?> name="aReparticao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Repartição</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eReparticao'])){ if($permissoes['eReparticao'] == '1'){echo 'checked';}}?> name="eReparticao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Repartição</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dReparticao'])){ if($permissoes['dReparticao'] == '1'){echo 'checked';}}?> name="dReparticao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Repartição</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vClassificacao'])){ if($permissoes['vClassificacao'] == '1'){echo 'checked';}}?> name="vClassificacao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Classificação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aClassificacao'])){ if($permissoes['aClassificacao'] == '1'){echo 'checked';}}?> name="aClassificacao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Classificação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eClassificacao'])){ if($permissoes['eClassificacao'] == '1'){echo 'checked';}}?> name="eClassificacao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Classificação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dClassificacao'])){ if($permissoes['dClassificacao'] == '1'){echo 'checked';}}?> name="dClassificacao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Classificação</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr>

                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cUsuario'])){ if($permissoes['cUsuario'] == '1'){echo 'checked';}}?> name="cUsuario" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Usuário</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cEmitente'])){ if($permissoes['cEmitente'] == '1'){echo 'checked';}}?> name="cEmitente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Emitente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cPermissao'])){ if($permissoes['cPermissao'] == '1'){echo 'checked';}}?> name="cPermissao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Permissão</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cBackup'])){ if($permissoes['cBackup'] == '1'){echo 'checked';}}?> name="cBackup" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Backup</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

              
    
            <div class="form-actions">
                <div class="span12">
                    <div class="span6 offset3">
                        <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                        <a href="<?php echo base_url() ?>index.php/permissoes" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                    </div>
                </div>
            </div>
           
            </div>
        </div>

                   
    </div>

</form>

</div>


<script type="text/javascript" src="<?php echo base_url()?>assets/js/validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

    $("#marcarTodos").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });   

 
    $("#formPermissao").validate({
        rules :{
            nome: {required: true}
        },
        messages:{
            nome: {required: 'Campo obrigatório'}
        }
    });     

        

    });
</script>
