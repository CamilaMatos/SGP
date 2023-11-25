<?php
    include './Estoque/CentroCusto.php';

    if ($_POST && ($_POST['nome'] != '')) {
        $nome = trim($_POST['nome']);
        $descricao = trim($_POST['descricao']);
        $status = trim($_POST['status']);

        $Um = new CentroCusto($nome, $descricao, $status);

        $resultado = $Um->cadastrarCentroCusto();

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/centrosCusto'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
            echo "<script>location.href='listar/centrosCusto'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/centrosCusto'</script>";
        }
    }
?>