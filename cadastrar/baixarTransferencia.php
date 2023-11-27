<?php
    include "./Estoque/Movimentacao.php";

    $idSolicitacao = $id;
    $idUsuario = $_SESSION['idUsuario'];
    
    $M = new Movimentacao($idSolicitacao, $idUsuario, NULL, NULL);

    $resultado = $M->realizarTransferencia($idSolicitacao);

    if ($resultado == "E") {
        echo "<script>alert('Erro!!!');</script>";
        echo "<script>location.href='listar/transferencias'</script>";
    }if ($resultado == "R") {
        echo "<script>alert('Erro! Saldo insuficiente para atender a transferência!!!');</script>";
        echo "<script>location.href='listar/transferencias'</script>";
    } else {
        echo "<script>alert('Sucesso! Transferência atendida!!!');</script>";
        echo "<script>location.href='listar/transferencias'</script>";
    }

?>