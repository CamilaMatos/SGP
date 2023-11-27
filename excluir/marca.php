<?php

    include "./Estoque/Marca.php";

    $Um = new Marca(NULL);

    

    if (!empty($id)) {
        $resultado = $Um->excluirMarca($id);

        if($resultado == "S"){
            echo "<script>alert('Estoque excluido com sucesso!!');</script>";
            echo "<script>location.href='listar/marcas'</script>";
        } else{
            echo "<script>alert('A inserção da Categoria falhou, por que algo deu errado!!');</script>";
            echo "<script>location.href='listar/marcas'</script>";
        }
        
    }
?>
