<?php

    include "./Estoque/Lote.php";

    if ($_POST) {
        $idItem = $_POST['item'];
        $idEstoque = $_POST['estoque'];
        $qtdInicial = $_POST['qtdInicial'];
        $qtdAtual = $_POST['qtdAtual'];
        $validade = $_POST['validade'];
        $vlUnitario =  $_POST['vlUnitario'];
        $idLoteOrigem = NULL;
        $idUsuario = $_SESSION['idUsuario'];
        $L = new Lote ($idItem, $idEstoque, $qtdInicial, $qtdAtual, $validade, $vlUnitario, $idLoteOrigem);
        if($L->inserirLote($idUsuario)){
            echo "<script>alert('Lote inserido com sucesso!!');</script>";
            echo "<script>location.href='listar/movimentacoes'</script>";
        } else{
            echo "<script>alert('A inserção do lote falhou, por que algo deu errado!!');</script>";
            echo "<script>location.href='listar/movimentacoes'</script>";
        }
        
    }
?>
