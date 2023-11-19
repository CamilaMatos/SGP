<?php
    include './Estoque/CentroCusto.php';

    if ($_POST && ($_POST['nome'] != '')) {
        $nome = trim($_POST['nome']);
        $descricao = trim($_POST['descricao']);
        $status = trim($_POST['status']);

        $Um = new CentroCusto($nome, $descricao, $status);

        if (!$Um->cadastrarCentroCusto()) {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/newCategoria'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/newCategoria'</script>";
        }
    }
?>