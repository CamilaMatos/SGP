<?php

    include "./Estoque/Usuario.php";

    if ($_POST) {
        $nome = $_POST['nome'];
        $nascimento = $_POST['nascimento'];
        $cpf = $_POST['cpf'];
        $tipo = $_POST['tipo'];
        $login = $_POST['login'];
        $senha =  $_POST['senha'];
        $Ul = new Usuario($nome, $nascimento, $cpf, $tipo, $login, $senha);
        $E = $Ul->cadastrarUsuario();

        if ($E == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        } else if ($E == "NA"){
            echo "<script>alert('Erro, usuário já cadastrado');</script>";
            
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            
        };
    }

?>