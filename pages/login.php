<link rel="stylesheet" href="css/style.css">

<header class="">

</header>
<?php

if (!empty($_POST)) {


    include "./Estoque/Usuario.php";
    $login =  trim($_POST['login']);
    $password = trim($_POST['password']);

    $U = new Usuario(null, null, null, null, null, $login, $password);


    if (!$U->logar()) {
        echo "<script>alert('Credenciais erradas, tente novamente!');</script>";
    } else {
        $_SESSION['login'] = $login;

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