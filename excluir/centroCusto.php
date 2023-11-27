<?php

    include "./Estoque/CentroCusto.php";

    $CC = new CentroCusto (NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    

    if (!empty($id)) {
        $resultado = $CC->excluirCentroCusto($id);

        if($resultado == "S"){
            echo "<script>alert('Centro de Custo excluido com sucesso!!');</script>";
            echo "<script>location.href='listar/categorias'</script>";
        } else{
            echo "<script>alert('A inserção do Centro de Custo falhou, por que algo deu errado!!');</script>";
            echo "<script>location.href='listar/categorias'</script>";
        }
        
    }
?>
