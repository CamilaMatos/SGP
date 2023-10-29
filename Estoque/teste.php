<?php

require_once "../Producao/OrdemServico.php";
require_once "Categoria.php";
require_once "ItensSolicitacao.php";
require_once "Solicitacao.php";
require_once "ItensSolicitacao.php";
require_once "Movimentacao.php";
//require_once "../Producao/ReceitaParametrizacao.php";
//require_once "Categoria.php";
//require_once "CentroCusto.php";


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
