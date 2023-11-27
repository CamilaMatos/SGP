<?php

    include "./Estoque/Lote.php";

    $idItem = $_POST['item'];
    $idEstoque = $_POST['estoque'];
    $qtdInicial = $_POST['qtdInicial'];
    $validade = $_POST['validade'];
    $vlUnitario =  $_POST['vlUnitario'];
    $idLoteOrigem = NULL;
    $idUsuario = $_SESSION['idUsuario'];

    $L = new Lote ($idItem, $idEstoque, $qtdInicial, $qtdInicial, $validade, $vlUnitario, $idLoteOrigem);

    print_r($_POST);

    if ($_POST && empty($id)) {

        $resultado = $L->inserirLote($idUsuario);

        if($resultado == "E"){
            echo "<script>alert('A inserção do lote falhou por que algo deu errado!!');</script>";
            
        } else{
            echo "<script>alert('Lote inserido com sucesso!!');</script>";
            echo "<script>location.href='listar/movimentacoes'</script>";
        }
        
    }
    if(!empty($id)) {

        $resultado = $L->editarLote($id);

        if ($resultado == "E") {
            echo "<script>alert('Lote não pode ser editado!!!');</script>";
            echo "<script>location.href='listar/entradas'</script>";

        } else {
            echo "<script>alert('Lote editado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/entradas'</script>";
        };

    }
?>
