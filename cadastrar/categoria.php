<?php
    include './Estoque/Categoria.php';

    if ($_POST && ($_POST['nome'] != '')) {
        $nome = trim($_POST['nome']);

        $Um = new Categoria($nome);

        if (!$Um->cadastrarCategoria()) {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/newCategoria'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/newCategoria'</script>";
        }
    }
?>