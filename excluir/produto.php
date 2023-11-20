<?php
    include "./Estoque/Item.php";

    $I = new Item (NULL, NULL, NULL, NULL, NULL, NULL);

    $resultado = $I->excluirItem($id);

    if($resultado == "E"){
        echo "<script>alert('Falha ao excluir o item!');</script>";
        echo "<script>location.href='listar/produtos'</script>"; 
    }
    if($resultado == "R"){
        echo "<script>alert('O item não pode ser excluido pois já está sendo usado em uma operação!');</script>";
        echo "<script>location.href='listar/produtos'</script>"; 
    }
    else{
        echo "<script>alert('O item foi excluido com sucesso!');</script>";
        echo "<script>location.href='listar/produtos'</script>"; 
    }



?>