<?php
    include "./Estoque/Solicitacao.php";

    $idSolicitacao = $id;
    $idStatus = 11;
    
    $S = new Solicitacao(NULL, NULL, NULL, $idStatus, NULL, NULL, NULL);
    $resultado = $S->alterarStatusSolicitacao($idSolicitacao, $idStatus);

    if ($resultado == "E") {
        echo "<script>alert('Não foi possível recusar a transferência!');</script>";
        echo "<script>location.href='listar/transferencias'</script>";
    } else {
        echo "<script>alert('Transferência recusada!');</script>";
        echo "<script>location.href='listar/transferencias'</script>";
    }

?>