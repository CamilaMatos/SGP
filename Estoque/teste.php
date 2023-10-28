<?php

require_once "../Producao/OrdemServico.php";
//require_once "../Producao/ReceitaParametrizacao.php";
//require_once "Categoria.php";
//require_once "CentroCusto.php";


// ver sobre os retornos das funções e sobre os ids começar null
// ver sobre status aparecendo para todos


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

$OS = new OrdemServico(null, 2, 1, '2023-11-10', 500, null, null, 1, null, null);
print(".".$OS->gerarOS());
//$OS->buscarOrdem(2);

//$C = new Categoria(null, "Teste Conecta");
//print(".".$C->cadastrarCategoria());

//$CC = new CentroCusto(null, "Teste Conecta", "Teste Conecta", 1);
//print(".".$CC->cadastrarCentroCusto());

