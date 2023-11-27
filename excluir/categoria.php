<?php

    include "./Estoque/Categoria.php";

    $C = new Categoria (NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    

    if (!empty($id)) {
        $resultado = $C->excluirCategoria($id);

        if($resultado == "S"){
            echo "<script>alert('Categoria excluida com sucesso!!');</script>";
            echo "<script>location.href='listar/entradas'</script>";
        } else{
            echo "<script>alert('A inserção da Categoria falhou, por que algo deu errado!!');</script>";
            echo "<script>location.href='listar/entradas'</script>";
        }
        
    }
?>
