<?php

    include "./Producao/ReceitaParametrizacao.php";

    $R = new ReceitaParametrizacao(NULL, NULL, NULL, NULL, NULL);

    

    if (!empty($id)) {

        $resultado = $R->excluirReceita($id);

        if($resultado == "S"){
            echo "<script>alert('Receita excluida com sucesso!!');</script>";
            echo "<script>location.href='listar/receitas'</script>";
        } else{
            echo "<script>alert('A inserção da Categoria falhou, por que algo deu errado!!');</script>";
            echo "<script>location.href='listar/receitas'</script>";
        }
        
    }
?>
