<?php

    include "./Estoque/Usuario.php";
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];
    $login = $_POST['login'];
    $senha =  $_POST['senha'];

    $Ul = new Usuario($nome, $nascimento, $cpf, $tipo, $login, $senha);

    if ($_POST && empty($id)) {
        $E = $Ul->cadastrarUsuario();

        if ($E == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        } else if ($E == "NA"){
            echo "<script>alert('Erro, usuário já cadastrado');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        };
    }if(!empty($id)){

        $E = $Ul->editarUsuario($id);

        if ($E == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        } else if ($E == "NA"){
            echo "<script>alert('Erro, usuário já cadastrado');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        };
        if(!empty($senha)){
            $Ul->editarSenha($id);
        }

    };

?>