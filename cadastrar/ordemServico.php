<?php

    include "./Producao/OrdemServico.php";

    $idReceita = $_POST['idReceita'];
    $idUsuario = $_POST['idUsuario'];
    $entrega = $_POST['entrega'];
    $rendimentoEsperado = $_POST['rendimentoEsperado'];
    $observacao = $_POST['observacao'];
    $idCentroCusto = $_POST['idCentroCusto'];
    $idEstoque = $_POST['idEstoque'];

    $OS = new OrdemServico($idReceita, $idUsuario, $entrega, $rendimentoEsperado, NULL, $observacao, NULL, NULL, NULL,);

    
    
    if ($_POST && empty($id)) {
        
        
        
        $resultado = $OS->gerarOS($idCentroCusto, $idEstoque);

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/ordensServico'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro, item já cadastrado');</script>";
            echo "<script>location.href='listar/ordensServico'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/ordensServico'</script>";
        };
    }

    if(!empty($id)) {

        $resultado = $I->editarItem($id);

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/ordensServico'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro, item já cadastrado');</script>";
            echo "<script>location.href='listar/ordensServico'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/ordensServico'</script>";
        };

    }
?>

<h1><?=$id?></h1>

