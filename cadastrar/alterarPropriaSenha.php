<?php
    include "./Estoque/Usuario.php";

    $login =  $_SESSION['login'];
    $password = trim($_POST['password']);
    $novaSenha = trim($_POST['novaSenha']);
    $confirmaNovaSenha = trim($_POST['confirmaNovaSenha']);

    if($novaSenha != $confirmaNovaSenha){
        echo "<script>alert('Erro, a senha e a confirmação de senha devem ser iguais!');</script>";
        echo "<script>location.href='pages/perfil'</script>";
        
    }else{

        $U = new Usuario(null, null, null, null, $login, $password, NULL);
        
        $dados = $U->logar();
        
        if (!$dados) {
            echo "<script>alert('Credenciais erradas, tente novamente!');</script>";
            echo "<script>location.href='pages/perfil'</script>";

        } else {

            $US = new Usuario(null, null, null, null, $login, $novaSenha, NULL);

            $Senha = $US->editarSenha($id);

            echo "<script>alert('Senha alterada com sucesso!');</script>";
            echo "<script>location.href='pages/sair'</script>";
            
        }

    }

?>