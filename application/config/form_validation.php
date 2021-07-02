<?php
$config = array(  'correspondencia' => array(array(
                                    'field'=>'numCorrespondencia',
                                    'label'=>'numCorrespondencia',
                                    'rules'=>'required|trim|is_unique[correspondencias.numCorrespondencia]'
                                ),
                                array(
                                    'field'=>'classificacao_id',
                                    'label'=>'classificador',
                                    'rules'=>'required|'
                                )),

    
                'direcoes' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim|is_unique[direcoes.nome]'
                                ),
                                array(
                                    'field'=>'abreviatura',
                                    'label'=>'Abreviatura',
                                    'rules'=>'required|trim|is_unique[direcoes.abreviatura]'
                                ),
                                array(
                                    'field'=>'email',
                                    'label'=>'E-mail',
                                    'rules'=>'trim|valid_email|is_unique[direcoes.email]'
                                ),
                                   array(
                                    'field'=>'responsavel',
                                    'label'=>'Responsavel',
                                    'rules'=>'trim|is_unique[direcoes.responsavel]'
                                ))
                ,
                'departamentos' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim|is_unique[departamentos.nome]'
                                ),
                                array(
                                    'field'=>'abreviatura',
                                    'label'=>'Abreviatura',
                                    'rules'=>'required|trim|is_unique[departamentos.abreviatura]'
                                ),
                                array(
                                    'field'=>'email',
                                    'label'=>'E-mail',
                                    'rules'=>'trim|valid_email|is_unique[departamentos.email]'
                                ),
                                   array(
                                    'field'=>'responsavel',
                                    'label'=>'Responsavel',
                                    'rules'=>'trim|is_unique[departamentos.responsavel]'
                                ))
                ,
                 'reparticoes' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'trim|is_unique[reparticoes.nome]'
                                ),
                                array(
                                    'field'=>'abreviatura',
                                    'label'=>'Abreviatura',
                                    'rules'=>'trim|is_unique[reparticoes.abreviatura]'
                                ),
                                array(
                                    'field'=>'email',
                                    'label'=>'E-mail',
                                    'rules'=>'trim|valid_email|is_unique[reparticoes.email]'
                                ),
                                   array(
                                    'field'=>'responsavel',
                                    'label'=>'Responsavel',
                                    'rules'=>'trim|is_unique[reparticoes.responsavel]'
                                ))
                ,

                 'classificador' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim|is_unique[classificacao.nome]'
                                ),
                                array(
                                    'field'=>'codigo',
                                    'label'=>'Codigo',
                                    'rules'=>'required|trim|is_unique[classificacao.codigo]'
                                ))
                ,
                'pro_externa' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim|is_unique[pro_externa.nome]'
                                ),
                                array(
                                    'field'=>'abreviatura',
                                    'label'=>'Abreviatura',
                                    'rules'=>'required|trim|is_unique[pro_externa.abreviatura]'
                                ),
                                array(
                                    'field'=>'email',
                                    'label'=>'E-mail',
                                    'rules'=>'trim|valid_email|is_unique[pro_externa.email]'
                                ),
                                array(
                                    'field'=>'contacto',
                                    'label'=>'Contacto',
                                    'rules'=>'trim|is_unique[pro_externa.contacto]'
                                ),
                                array(
                                    'field'=>'endereco',
                                    'label'=>'Endereço',
                                    'rules'=>'trim|is_unique[pro_externa.endereco]'
                                ))
                ,
                'tipo_doc' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim|is_unique[tipo_doc.nome]'
                                ))
                ,
                'cargo' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Cargo',
                                    'rules'=>'required|trim|is_unique[cargo.nomeCargo]'
                                ))
                ,


                'destinatario' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome destinatário',
                                    'rules'=>'required|trim|is_unique[destinatario.nomeDestinatario]'
                                ))
                ,
                
                'usuarios' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'apelido',
                                    'label'=>'Apelido',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'direcoes',
                                    'label'=>'Direção',
                                    'rules'=>'required|trim'
                                ),                                
                                array(
                                    'field'=>'email',
                                    'label'=>'Email',
                                    'rules'=>'required|trim|valid_email|is_unique[usuarios.email]'
                                ),
                                array(
                                    'field'=>'senha',
                                    'label'=>'Senha',
                                    'rules'=>'required|trim'
                                ),                                
                                
                                array(
                                    'field'=>'situacao',
                                    'label'=>'Situacao',
                                    'rules'=>'required|trim'
                                ))
                ,      
                'os' => array(array(
                                    'field'=>'dataInicial',
                                    'label'=>'DataInicial',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'dataFinal',
                                    'label'=>'DataFinal',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'garantia',
                                    'label'=>'Garantia',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'descricaoProduto',
                                    'label'=>'DescricaoProduto',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'defeito',
                                    'label'=>'Defeito',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'status',
                                    'label'=>'Status',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'observacoes',
                                    'label'=>'Observacoes',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'clientes_id',
                                    'label'=>'clientes',
                                    'rules'=>'trim|required'
                                ),
                                array(
                                    'field'=>'usuarios_id',
                                    'label'=>'usuarios_id',
                                    'rules'=>'trim|required'
                                ),
                                array(
                                    'field'=>'laudoTecnico',
                                    'label'=>'Laudo Tecnico',
                                    'rules'=>'trim'
                                ))

                  ,
				'tiposUsuario' => array(array(
                                	'field'=>'nomeTipo',
                                	'label'=>'NomeTipo',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'situacao',
                                	'label'=>'Situacao',
                                	'rules'=>'required|trim'
                                ))

                ,
                'receita' => array(array(
                                    'field'=>'descricao',
                                    'label'=>'Descrição',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'valor',
                                    'label'=>'Valor',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'vencimento',
                                    'label'=>'Data Vencimento',
                                    'rules'=>'required|trim'
                                ),
                        
                                array(
                                    'field'=>'cliente',
                                    'label'=>'Cliente',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'tipo',
                                    'label'=>'Tipo',
                                    'rules'=>'required|trim'
                                ))
                ,
                'despesa' => array(array(
                                    'field'=>'descricao',
                                    'label'=>'Descrição',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'valor',
                                    'label'=>'Valor',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'vencimento',
                                    'label'=>'Data Vencimento',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'fornecedor',
                                    'label'=>'Fornecedor',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'tipo',
                                    'label'=>'Tipo',
                                    'rules'=>'required|trim'
                                ))
                ,
                'vendas' => array(array(

                                    'field' => 'dataVenda',
                                    'label' => 'Data da Venda',
                                    'rules' => 'required|trim'
                                ),
                                array(
                                    'field'=>'clientes_id',
                                    'label'=>'clientes',
                                    'rules'=>'trim|required'
                                ),
                                array(
                                    'field'=>'usuarios_id',
                                    'label'=>'usuarios_id',
                                    'rules'=>'trim|required'
                                ))
		);
			   
/*
DIR-  R.REC/CLA/PRO/ANO
GM: 01/001/UGEA/2017 - R.REC PRETENCE A GM (01.GM(gm pretence ao local do user ou na tabela correspondencia ao campo origem))
DRH: 01/001/UGEA/2017 - R.REC PRETENCE A DRH (01.DRH(drh pretence ao local do user ou na tabela correspondencia ao campo origem))

logica
se(numCorrespondencia=="valor introduzido pelo user" e origem="local do user" ){
    Codigo correspondencia deve ser diferente.
}
*/