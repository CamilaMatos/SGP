<?php

    include "./Estoque/Estoque.php";

    $Um = new Estoque(NULL, NULL, NULL);

    

    if (!empty($id)) {
        $resultado = $Um->excluirEstoque($id);

        if($resultado == "S"){
            echo "<script>alert('Estoque excluido com sucesso!!');</script>";
            echo "<script>location.href='listar/estoque'</script>";
        } else{
            echo "<script>alert('A inserção da Categoria falhou, por que algo deu errado!!');</script>";
            echo "<script>location.href='listar/estoque'</script>";
        }
        
    }
?>
