<?php
    include "./Estoque/Movimentacao.php";

    $idSolicitacao = $id;
    $idUsuario = $_SESSION['idUsuario'];
    
    $M = new Movimentacao($idSolicitacao, $idUsuario, NULL, NULL);

    $resultado = $M->realizarMovimentacao($idSolicitacao);

    if ($resultado == "E") {
        echo "<script>alert('Erro!!!');</script>";
        echo "<script>location.href='listar/requisicoes'</script>";
    }if ($resultado == "R") {
        echo "<script>alert('Erro! Saldo insuficiente para atender a requisição!!!');</script>";
        echo "<script>location.href='listar/requisicoes'</script>";
    } else {
        echo "<script>alert('Sucesso! Requisição atendida!!!');</script>";
        echo "<script>location.href='listar/requisicoes'</script>";
    }

?>