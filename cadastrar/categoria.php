<?php
    include './Estoque/Categoria.php';

    if ($_POST && ($_POST['nome'] != '') && empty($id)) {
        $nome = trim($_POST['nome']);

        $Um = new Categoria($nome);

        $resultado = $Um->cadastrarCategoria();

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/categorias'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Já existe uma categoria com esse nome!!!');</script>";
            echo "<script>location.href='listar/categorias'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/categorias'</script>";
        }
    }
    if($_POST && !empty($id)){
        $nome = trim($_POST['nome']);

        $Um = new Categoria($nome);

        $resultado = $Um->editarCategoria($id);

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/categorias'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
            echo "<script>location.href='listar/categorias'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/categorias'</script>";
        }
    }
?>