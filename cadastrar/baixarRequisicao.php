<?php
    include "./Estoque/Movimentacao.php";

    $idSolicitacao = $id;
    $idUsuario = $_SESSION['idUsuario'];
    
    $M = new Movimentacao($idSolicitacao, $idUsuario, NULL, NULL);

    $resultado = $M->realizarMovimentacao($idSolicitacao);

    if ($resultado == "E") {
        echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
        echo "<script>location.href='listar/requisicao'</script>";
    }if ($resultado == "R") {
        echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
        echo "<script>location.href='listar/requisicao'</script>";
    } else {
        echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
        echo "<script>location.href='listar/requisicao'</script>";
    }

?>