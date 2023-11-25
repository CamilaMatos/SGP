<?php
    include "./Estoque/Solicitacao.php";

    $S = new Solicitacao (NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    $resultado = $S->excluirSolicitacao($id);

    if($resultado == "E"){
        echo "<script>alert('Falha ao excluir o item!');</script>";
        echo "<script>location.href='listar/solicitacoes'</script>"; 
    }
    if($resultado == "R"){
        echo "<script>alert('O item não pode ser excluido pois já está sendo usado em uma operação!');</script>";
        echo "<script>location.href='listar/solicitacoes'</script>"; 
    }
    else{
        echo "<script>alert('O item foi excluido com sucesso!');</script>";
        echo "<script>location.href='listar/solicitacoes'</script>"; 
    }



?>