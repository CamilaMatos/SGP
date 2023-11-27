<?php
    include './Estoque/Marca.php';

    if ($_POST && ($_POST['nome'] != '')) {
        $nome = trim($_POST['nome']);

        $Um = new Marca($nome);

        $resultado = $Um->cadastrarMarca();

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/marcas'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Já existe uma marca com esse nome!!!');</script>";
            echo "<script>location.href='listar/marcas'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/marcas'</script>";
        }
    }
?>