<?php
    include "./Estoque/Solicitacao.php";

    $idSolicitacao = $id;
    $idStatus = 11;
    
    $S = new Solicitacao(NULL, NULL, NULL, $idStatus, NULL, NULL, NULL);
    $resultado = $S->alterarStatusSolicitacao($idSolicitacao, $idStatus);

    if ($resultado == "E") {
        echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
        echo "<script>location.href='listar/transferencias'</script>";
    }if ($resultado == "R") {
        echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
        echo "<script>location.href='listar/transferencias'</script>";
    } else {
        echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
        echo "<script>location.href='listar/transferencias'</script>";
    }

?>