<?php
    include './Estoque/Estoque.php';

    if ($_POST && ($_POST['nome'] != '') && empty($id)) {
        $nome = trim($_POST['nome']);
        $descricao = trim($_POST['descricao']);
        $status = trim($_POST['status']);

        $Um = new Estoque($nome, $descricao, $status);

        $resultado = $Um->cadastrarEstoque();

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/estoques'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Já existe um estoque com esse nome!!!');</script>";
            echo "<script>location.href='listar/estoques'</script>";
        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
            echo "<script>location.href='listar/estoques'</script>";
        }
    }
    if($_POST && !empty($id)){
        $nome = trim($_POST['nome']);
        $descricao = trim($_POST['descricao']);
        $status = trim($_POST['status']);

        $Um = new Estoque($nome, $descricao, $status);

        $resultado = $Um->editarEstoque($id);

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/estoques'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
            echo "<script>location.href='listar/estoques'</script>";
        } else {
            echo "<script>alert('Estoque editado com sucesso!!!');</script>";
            echo "<script>location.href='listar/estoques'</script>";
        }
    }
?>