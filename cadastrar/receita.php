<?php
    include './Producao/ReceitaParametrizacao.php';


    $nome = $_POST['nome'];
    $idCategoria = $_POST['idCategoria'];
    $tempo = $_POST['tempo'];
    $modo = $_POST['modo'];
    $rendimento = $_POST['rendimento'];

    $R = new ReceitaParametrizacao($nome, $idCategoria, $tempo, $modo, $rendimento);

    if ($_POST && empty($id)) {
        
        $idReceita = $R->cadastrarReceita();

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/receitas'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro! Já existe uma receita com esse nome!');</script>";
            echo "<script>location.href='listar/receitas'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/receitas'</script>";
        };
    }

    if(!empty($id)) {

        $resultado = $R->editarReceita($id);

        if ($resultado == "E") {
            echo "<script>alert('A edição não pode ser realizada!');</script>";
            echo "<script>location.href='listar/receitas'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro! Já existe uma receita com esse nome!');</script>";
            echo "<script>location.href='listar/receitas'</script>";
        }
        else {
            echo "<script>alert('Edição realizada com sucesso!!!!');</script>";
            echo "<script>location.href='listar/receitas'</script>";
        };

    }
?>