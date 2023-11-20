<?php
    function Requisicao(){
        include "./Estoque/Solicitacao.php";

        $origem = NULL;
        $idTipo = 2;
        $idCentroCusto = NULL;
        $idStatus = 8;
        $idSolicitante = $_SESSION['idUsuario'];
        $idEstoque = NULL;
        $data = date('Y-M-d');
        $necessidade = $data;

        $solicitacao = new Solicitacao($origem, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $data, $necessidade);

        $resultado = $solicitacao->solicitarRequisicao();
        
    }
?>
        