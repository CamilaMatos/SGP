<link rel="stylesheet" href="css/style.css">
<?php

if ($_POST) {


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
<div class="mainForm">

    <form action="pages/login" method="POST">
        <div class="formulario">
            <i class="fa-regular fa-circle-user loginIcon"></i>
            <br>
            <br>
            <input type="text" placeholder="Login" id="login" name="login" class="loginInput">
            <br>
            <input type="password" placeholder="Senha" id="password" name="password" class="loginInput">
            <br>
            <br>
            <button type="submit" class="submitButton">Enviar</button>

        </div>
    </form>

</div>