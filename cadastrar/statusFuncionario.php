<?php
    include "./Estoque/Usuario.php";

    $idUsuario = $id;
    $idStatus = 2;
    
    $S = new Usuario(NULL, NULL, NULL, $idStatus, NULL, NULL, NULL);
    $resultado = $S->alterarStatusSolicitacao($idSolicitacao, $idStatus);

    if ($resultado == "E") {
        echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
        echo "<script>location.href='listar/requisicoes'</script>";
    }if ($resultado == "R") {
        echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
        echo "<script>location.href='listar/requisicoes'</script>";
    } else {
        echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
        echo "<script>location.href='listar/requisicoes'</script>";
    }

?>