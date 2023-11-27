<?php

    include "./Estoque/Lote.php";

    $L = new Lote (NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    

    if (!empty($id)) {
        $resultado = $L->excluirLote($id);

        if($resultado == "S"){
            echo "<script>alert('Lote excluido com sucesso!!');</script>";
            echo "<script>location.href='listar/entradas'</script>";
        } else{
            echo "<script>alert('A inserção do lote falhou, por que algo deu errado!!');</script>";
            echo "<script>location.href='listar/entradas'</script>";
        }
        
    }
?>
