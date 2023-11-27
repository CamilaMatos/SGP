<?php
    include './Estoque/UnidadeMedida.php';

    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    $Um = new UnidadeMedida($nome, $descricao);

    if ($_POST && empty($id)) {

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
    if(!empty($id)){

        $resultado = $Um->editarUnidadeMedida($id);

        if ($resultado == "E") {
            echo "<script>alert('Erro ao alterar o cadastro!!!');</script>";
            echo "<script>location.href='listar/unidadesMedida'</script>";
        }else {
            echo "<script>alert('Cadastro alterado com Sucesso!!!');</script>";
            echo "<script>location.href='listar/unidadesMedida'</script>";
        }

    }
?>