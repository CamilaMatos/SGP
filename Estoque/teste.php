<?php

require_once "../Producao/OrdemServico.php";
require_once "Categoria.php";
require_once "ItensSolicitacao.php";
//require_once "../Producao/ReceitaParametrizacao.php";
//require_once "Categoria.php";
//require_once "CentroCusto.php";


// ver sobre os retornos das funções e sobre os ids começar null
// ver sobre status aparecendo para todos
// ver o array de lotes do ItensSolicitacao
// posso criar um código para cada ação e registrar as o códico para os usuários que tem permissão
// verificar movimentação para não baixar itens com quantidade superior a que possui em estoque


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

$C = new Categoria("Embalagem");
print($C->cadastrarCategoria());
//$C->print();

