<?php

    include "./Estoque/Item.php";

    if ($_POST) {
        $nome = $_POST['nome'];
        $unMedia = $_POST['unMedia'];
        $categoria = $_POST['categoria'];
        $marca = $_POST['marca'];
        $unMedida = $_POST['unMedida'];
        $status = 1;

        $I = new Item($nome, $unMedia, $categoria, $marca, $unMedida, $status);

        $resultado = $I->cadastrarItem();

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/produtos'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro, item já cadastrado');</script>";
            echo "<script>location.href='listar/produtos'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/produtos'</script>";
        };
    }

?>

<h1>teste</h1>

