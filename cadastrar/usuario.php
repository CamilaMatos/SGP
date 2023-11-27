<?php

    include "./Estoque/Usuario.php";
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];
    $login = $_POST['login'];
    $senha =  $_POST['senha'];
    $status = 1;
    $Ul = new Usuario($nome, $nascimento, $cpf, $tipo, $login, $senha, $status);

    if ($_POST && empty($id)) {
        $E = $Ul->cadastrarUsuario();

        if ($E == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        } else if ($E == "NA"){
            echo "<script>alert('Erro! Login não disponível!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        };
    }if(!empty($id)){

        $E = $Ul->editarUsuario($id);

        if(!empty($senha)){
            $Ul->editarSenha($id);
        }
        
        if ($E == "E") {
            echo "<script>alert('Usuário não pode ser editado!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        } else if ($E == "NA"){
            echo "<script>alert('Erro! Login não disponível!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }
        else {
            echo "<script>alert('Cadastro editado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }

    };

?>