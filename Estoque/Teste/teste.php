<?php
require_once "../Classes/Conecta.php";
$conectar = new Conecta();
$pdo = $conectar->conectar();
include "../Classes/CentroCusto.php";
include "../Classes/Usuario.php";
include "../Classes/Movimentacao.php";
include "../../Classes/Funcao.php";

// fazer função de transferencia de lote de um estoque para o outro


$F = new Usuario(null, 'teste', 'teste', 'teste', 1, 'camila.mato', '123');
print($F->cadastrarUsuario());