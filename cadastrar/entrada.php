<?php

    include "./Estoque/Lote.php";

    $idItem = $_POST['item'];
    $idEstoque = $_POST['estoque'];
    $qtdInicial = $_POST['qtdInicial'];
    $qtdAtual = $_POST['qtdAtual'];
    $validade = $_POST['validade'];
    $vlUnitario =  $_POST['vlUnitario'];
    $idLoteOrigem = NULL;
    $idUsuario = $_SESSION['idUsuario'];

    $L = new Lote ($idItem, $idEstoque, $qtdInicial, $qtdAtual, $validade, $vlUnitario, $idLoteOrigem);

    print_r($_POST);

    if ($_POST && empty($id)) {

        $resultado = $L->inserirLote($idUsuario);

        if($resultado == "E"){
            echo "<script>alert('A inserção do lote falhou, por que algo deu errado!!');</script>";
            
        } else{
            echo "<script>alert('Lote inserido com sucesso!!');</script>";
            echo "<script>location.href='listar/movimentacoes'</script>";
        }
        
    }
    if(!empty($id)) {

        $resultado = $L->editarLote($id);

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/entradas'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro, item já cadastrado');</script>";
            echo "<script>location.href='listar/entradas'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/entradas'</script>";
        };

    }
?>
