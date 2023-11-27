<?php

    include "./Estoque/UnidadeMedida.php";

    $UN = new UnidadeMedida (NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    

    if (!empty($id)) {
        $resultado = $UN->excluirUnidadeMedida($id);

        if($resultado == "S"){
            echo "<script>alert('Unidade de Medida excluida com sucesso!!');</script>";
            echo "<script>location.href='listar/unidadesMedida'</script>";
        } else{
            echo "<script>alert('Erro duarante a exclusão da unidade de medida!!');</script>";
            echo "<script>location.href='listar/unidadesMedida'</script>";
        }
        
    }
?>