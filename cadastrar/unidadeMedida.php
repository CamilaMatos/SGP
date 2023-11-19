<?php
    include './Estoque/UnidadeMedida.php';

    if ($_POST && ($_POST['nome'] != '')) {
        $nome = trim($_POST['nome']);
        $descricao = trim($_POST['descricao']);

        $Um = new UnidadeMedida($nome, $descricao);

        if (!$Um->cadastrarUnidadeMedida()) {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/newUnidadeMedida'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/newUnidadeMedida'</script>";
        }
    }
?>