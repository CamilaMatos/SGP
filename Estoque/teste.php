<?php
//requerindo a classe
//require_once "Categoria.php";

//estanciando a classe
//$C = new Categoria("Embalagem");//nome da classe

//chamando a função de cadastrar e printando o resultado 

//print("Resultado 1: ".$C->cadastrarCategoria());
//a categoria "Embalagem" ainda não foi cadastrada então a função irá cadastrá-la e retornar o id

//print("Resultado 2: ".$C->cadastrarCategoria());
//a categoria "Embalagem" já foi cadastrada entrão a função não deverá cadastrar novamente e retornará "R", o que signfica que o cadastro foi recusado



//require_once "../Producao/OrdemServico.php";
//$O = new OrdemParametrizacao(1, 2, 1, 1);
//$O->setIdItem(1);
//$O->setQuantidade(3);
//$O->cadastrarIngrediente();
//$O->editarIngrediente();
//print_r($O);
//$O->excluirIngrediente();



//SELECT l.valorUnitario, i.quantidade from lote l inner join itensmovimentacao i on (i.idLote = l.idLote) where i.idSolicitacao=

//require_once "Solicitacao.php";
//require_once "ItensSolicitacao.php";

//require_once "../Producao/OrdemServico.php";
//require_once "Categoria.php";
//require_once "CentroCusto.php";

//$OS = new OrdemServico(2, 1, '2023-11-27', 10, null, null, 1, null, null);
//$OS->gerarOS(2, 1);
//$OS->reservarIngredientes(33, 1, 53, 1);
//$OS->concluirOS(53, 33, 1, '2024-01-01');

//$S = new Solicitacao(1, 2, 3, 1, 1, null, '2023-11-11');
//$S->finalizarSolicitacao(35);

//$S = new Solicitacao(1, 1, 2, 1, 1, null, '2023-11-20');
//print($S->solicitarRequisicao());
//$I = new ItensSolicitacao(28, null, 1, 1, 1);
//print($I->inserirItemSolicitacao(2));
//print($I->quebrarLotes());

//$M = new Movimentacao(28, 1, 1, '2023-11-18');
//print($M->realizarMovimentacao());
//print($M->realizarTransferencia());
//$M = new Movimentacao()

//print($M->reverterBaixaPorItem(1, 3));
//print($M->reverterBaixa(6));


// ver sobre status aparecendo para todos
// posso criar um código para cada ação e registrar as o códico para os usuários que tem permissão



//$R = new ReceitaParametrizacao(null, 'Teste 2', 1, "01:00", null, null);
//print(".".$R->cadastrarReceita());
//$R->setNome('Testando de novo');
//print($R->editarReceita(1));
//print($R->excluirReceita(2));

//$O = new OrdemParametrizacao(1, 2, 1, 1);
//$O->setIdItem(1);
//$O->setQuantidade(3);
//$O->cadastrarIngrediente();
//$O->editarIngrediente();
//print_r($O);
//$O->excluirIngrediente();

//$OS = new OrdemServico(31, 2, 1, '2023-11-10', 500, null, null, 1, null, null);
//print($OS->concluirOS(31, 1, 2, 1));
//print(".".$OS->gerarOS(2, 1));
//$OS->buscarOrdem(2);

//$C = new Categoria(null, "Teste Conecta");
//print(".".$C->cadastrarCategoria());

//$CC = new CentroCusto(null, "Teste Conecta", "Teste Conecta", 1);
//print(".".$CC->cadastrarCentroCusto());

//$C = new Categoria("Embalagem");
//print($C->cadastrarCategoria());
//$C->print();

//$S = new Solicitacao(2, 2, 3, 1, 1, '2020-10-30');
//print_r($S);
//print($id = $S->solicitarRequisicao());

//$I = new ItensSolicitacao($id, null, 50, 1, 1);
//$I->inserirItemSolicitacao(50);
//print($I->quebrarLotes());
//arrumar origem da solicitação
//validar senha