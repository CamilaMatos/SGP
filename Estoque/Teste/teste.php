<?php
require_once "../Classes/Conecta.php";
$conectar = new Conecta();
$pdo = $conectar->conectar();
include "../Classes/CentroCusto.php";
include "../Classes/Usuario.php";
include "../Classes/Movimentacao.php";
include "../../Classes/Funcao.php";


// se solicitar mais do que tem no lote


$F = new Movimentacao(null, 1, 1, 1, '2023-10-02');
// $F->verificarQuantidade(1);
// print($F->realizarTransferencia());


//$I = new ItensSolicitacao(1, null, 8, 1, 1);
//$I->quebrarLotes();
//$I->setQuantidade(9);
//print($I->editarItemSolicitacao(1, 1));
//$I->excluirItem(1, 1);