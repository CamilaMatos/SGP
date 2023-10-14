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

            <input type="text" placeholder="Login" id="login" name="login">
            <input type="password" placeholder="Senha" id="password" name="password">
            <br>
            <br>
            <button type="submit">Enviar</button>

        </div>
    </form>

</div>