<?php
    include "./Estoque/Usuario.php";

    $idUsuario = $id;
    $idStatus = 2;
    
    $S = new Usuario(NULL, NULL, NULL, $idStatus, NULL, NULL, NULL);
    $resultado = $S->alterarStatusUsuario($idSolicitacao, $idStatus);

    if ($resultado == "E") {
        echo "<script>alert('Status não pode ser alterado!');</script>";
        echo "<script>location.href='listar/requisicoes'</script>";
    } else {
        echo "<script>alert('Status alterado com sucesso!!!');</script>";
        echo "<script>location.href='listar/requisicoes'</script>";
    }

?>