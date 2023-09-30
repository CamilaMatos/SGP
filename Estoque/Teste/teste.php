<?php
require_once "../Classes/Conecta.php";
$conectar = new Conecta();
$pdo = $conectar->conectar();
include "../Classes/CentroCusto.php";

// $C= new Categoria(null, "Bebidas");
// // $C->setIdCentroCusto(2);
// // $C->setNome("Teste 3");
// print($C->cadastrarCategoria());


$C= new CentroCusto(NULL, 'Novo Teste', 'Teste Conecta 2', 1);
$C->cadastrarCentroCusto();