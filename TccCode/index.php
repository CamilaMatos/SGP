<?php
session_start();

include "configs/conecta.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>S.G.P</title>

    <base href="<?= $base ?>">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/summernote-lite.min.css">

    <link rel="shortcut icon" href="images/icone.png">

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/vanilla-masker.js"></script>
    <script src="js/parsley.min.js"></script>
    <script src="js/summernote-lite.min.js"></script>
    <script src="js/summernote-pt-BR.js"></script>
</head>

<body>

    <?php
    require "header.php";
    ?>
    <main>
        <?php
        $page = "login";

        if (isset($_GET["param"])) {
            $param = trim($_GET["param"]);
            $param = explode("/", $param);
            $page = $param[1];
        }

        $page = "pages/{$page}.php";

        if (file_exists($page)) {
            require $page;
        } else {
            require "pages/404.php";
        }

        ?>
    </main>
    <?php
    require "footer.php";
    ?>

</body>

</html>