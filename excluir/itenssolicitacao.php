<?php
    include "./Estoque/ItensSolicitacao.php";

    $Itens = new ItensSolicitacao(NULL, NULL, NULL, NULL, NULL);
    $resultado = $Itens->excluirItemSolicitacao($id2, $id);
    echo($resultado);

    if($resultado == "R"){
        echo "<script>alert('Item não foi excluido pois a solicitação já foi atendida!');</script>";
    }
    if($resultado == "E"){
        echo "<script>alert('Erro! O item não pode ser excluido!');</script>";
    }
    else{
        echo "<script>alert('Item foi excluido com sucesso!');</script>";
    }


?>