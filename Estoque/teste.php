<?php
require_once "CentroCusto.php";
require_once "Usuario.php";
require_once "Movimentacao.php";
require_once "../Classes/Funcao.php";


// ver sobre os retornos das funções e sobre os ids começar null


//$F = new Movimentacao(null, 1, 1, 1, '2023-10-02');
// $F->verificarQuantidade(1);
// print($F->realizarTransferencia());


//$I = new ItensSolicitacao(1, null, 8, 1, 1);
//$I->quebrarLotes();
//$I->setQuantidade(9);
//print($I->editarItemSolicitacao(1, 1));
//$I->excluirItem(1, 1);

$C = new CentroCusto(null, 'Teste', 'Teste Conecta', 1);
print($C->cadastrarCentroCusto());