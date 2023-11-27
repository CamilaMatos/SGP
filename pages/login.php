<link rel="stylesheet" href="css/style.css">

<header class="header">

</header>
<?php

if (!empty($_POST)) {


    include "./Estoque/Usuario.php";
    $login =  trim($_POST['login']);
    $password = trim($_POST['password']);

    $U = new Usuario(null, null, null, null, $login, $password, NULL);

    $sql = "select * from usuario where login=:login";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":login", $login);
    $consulta->execute();

    $dadosU = $consulta->fetch(PDO::FETCH_OBJ);

    $dados = $U->logar();

    if (!$dados) {

        echo "<script>alert('Credenciais erradas, tente novamente!');</script>";

    }if($dados && ($dadosU->idStatus == 2)){

        echo "<script>alert('Usuário Inativado, não foi possível fazer login!');</script>";

    } if($dados && ($dadosU->idStatus == 1) ) {
        $_SESSION['login'] = $dados->login;
        $_SESSION['nome'] = $dados->nome;
        $_SESSION['tipo'] = $dados->idTipo;
        $_SESSION['idUsuario'] = $dados->idUsuario;
        $_SESSION['nascimento'] = $dados->dataNasc;

        echo "<script>location.href='pages/home'</script>";
    }
}

?>
<div class="loginContainer">
    <div class="bgContainer">
        <img src="https://mundo.gimbastore.com.br/wp-content/uploads/2019/01/ESTOQUE-min.jpg" class="loginBg" alt="Login BackGround">
    </div>
    <div class="mainForm">
        <form action="pages/login" method="POST">
            <div class="formulario">
                <i class="fa-regular fa-circle-user loginIcon"></i>
                <br>
                <br>
                <br>
                <label for="login" class="loginLabel">Usuário:</label>
                <br>
                <input type="text" placeholder="Login" id="login" name="login" class="loginInput">
                <br>
                <label for="password"class="loginLabel">Senha:</label>
                <br>
                <input type="password" placeholder="Senha" id="password" name="password" class="loginInput">
                <br>
                <br>
                <button type="submit" class="submitButton">Login</button>               
            </div>
        </form> 
    </div>
</div>
<?php
    require "footer.php"
?>