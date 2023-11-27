<?php

    include "./Estoque/Item.php";

    $nome = $_POST['nome'];
    $unMedia = $_POST['unMedia'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $unMedida = $_POST['unMedida'];
    $status = 1;

    $I = new Item($nome, $unMedia, $categoria, $marca, $unMedida, $status);

    if ($_POST && empty($id)) {
        

        $resultado = $I->cadastrarItem();

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/produtos'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro! Já existe um produto com esse nome');</script>";
            echo "<script>location.href='listar/produtos'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/produtos'</script>";
        };
    }

    if(!empty($id)) {

        $resultado = $I->editarItem($id);

        if ($resultado == "E") {
            echo "<script>alert('Produto não pode ser editado!');</script>";
            echo "<script>location.href='listar/produtos'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro! Já existe um item cadastrado com esse nome!');</script>";
            echo "<script>location.href='listar/produtos'</script>";
        }
        else {
            echo "<script>alert('Produto editado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/produtos'</script>";
        };

    }
?>

<h1><?=$id?></h1>

