<?php
    include "./Estoque/Solicitacao.php";

    $S = new Solicitacao (NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    $resultado = $S->excluirSolicitacao($id);

    if($resultado == "E"){
        echo "<script>alert('Falha ao excluir!');</script>";
        echo "<script>location.href='listar/solicitacoes'</script>"; 
    }
    if($resultado == "R"){
        echo "<script>alert('A requisição/transferência não pode ser excluida pois já está sendo usada em uma operação!');</script>";
        echo "<script>location.href='listar/solicitacoes'</script>"; 
    }
    else{
        echo "<script>alert('Requisição/transferência foi excluida com sucesso!');</script>";
        echo "<script>location.href='listar/solicitacoes'</script>"; 
    }



?>