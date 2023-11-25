<?php
    include './Estoque/UnidadeMedida.php';

    if ($_POST && ($_POST['nome'] != '')) {
        $nome = trim($_POST['nome']);
        $descricao = trim($_POST['descricao']);

        $Um = new UnidadeMedida($nome, $descricao);

        $resultado = $Um->cadastrarUnidadeMedida();

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/unidadesMedida'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
            echo "<script>location.href='listar/unidadesMedida'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/unidadesMedida'</script>";
        }
    }
?>