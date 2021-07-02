<div class="span12" style="margin-left: 0">
    <form action="<?php echo base_url();?>index.php/permissoes/adicionar" id="formPermissao" method="post">

    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-lock"></i>
                </span>
                <h5>Cadastro de Permissão</h5>
            </div>
            <div class="widget-content">
                
                <div class="span6">
                    <label>Nome da Permissão</label>
                    <input name="nome" type="text" id="nome" class="span12" />

                </div>
                <div class="span6">
                    <br/>
                    <label>
                        <input name="marcarTodos" type="checkbox" value="1" id="marcarTodos" />
                        <span class="lbl"> Marcar Todos</span>

                    </label>
                    <br/>
                </div>

                <div class="control-group">
                    <label for="documento" class="control-label"></label>
                    <div class="controls">

                        <table class="table table-bordered">
                            <tbody>
                                 
                                    <td>
                                        <label>
                                        <input name="vCorrespondencia" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Correspondência</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input name="dCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Correspondência</span>
                                        </label>
                                    </td>
                                 
                               

                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input name="iProtocolo" class="marcar" type="checkbox"  value="1" />
                                            <span class="lbl"> Imprimir Protocolo </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="tCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Tramitar Correspondência </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="pCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Parecer Correspondência </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="despCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Despacho Correspondência </span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="confRecepcao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Confirmação da Recepção </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="detCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Detalhes Correspondencias </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="iCorrespondencia" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">  Imprimir Correspondência </span>
                                        </label>
                                    </td>
                                 <td>
                                        <label>
                                            <input name="Relatorios" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl">  Relatorios  </span>
                                        </label>
                                    </td>
                                </tr>

                                
                                <td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="estEstado" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Estado Correspondência</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="estDespacho" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Estado Despacho</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="estRecebido" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Estado Recebido</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="estPendente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Estado Pendente</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                              
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vTipoDoc" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Tipo de Doc.</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aTipoDoc" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Tipo de Doc.</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eTipoDoc" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Tipo de Doc.</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dTipoDoc" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Tipo de Doc.</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vDirecao" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Direção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aDirecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Direção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eDirecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Direção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dDirecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Direção</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vDepartamento" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Departamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dDepartamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Departamento</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <!-- <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="vArquivo" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Arquivo</span>
                                        </label>
                                    </td>
                                 
                                </tr> -->
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="vReparticao" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Reparticação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aReparticao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Reparticação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eReparticao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Reparticação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dReparticao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Reparticação</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="vClassificacao" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Classificação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aClassificacao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Classificação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eClassificacao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Classificação</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dClassificacao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Classificação</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                               
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="cUsuario" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Usuário</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cEmitente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Emitente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cPermissao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Permissão</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cBackup" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Backup</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                            </tbody>
                               
                        </table>

                        <table>
                            <tbody>
                                <td>
                                        <label>
                                            <input name="sigilosa" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl" style="color: red; "> Correspondência Sigilosa </span>
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
                        <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
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
