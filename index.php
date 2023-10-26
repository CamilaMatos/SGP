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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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
    <script src="https://kit.fontawesome.com/4af1129b29.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="w3-sidebar w3-bar-block sideBar" id="mySidebar">
        <div class="sideBarTop">
            <div>
                <i class="fa-regular fa-circle-user loginIcon"></i>
            </div>
            <div>
                Nome do Cidadão
            </div>
        </div>
        <a href="pages/perfil" class="w3-bar-item w3-button">
            <div stye="direction: row">
                <div>
                    <i class="fa-solid fa-user optionsIcon"></i>
                </div>
                <div>
                    Perfil
                </div>
            </div>
        </a>
        <a href="pages/perfil" class="w3-bar-item w3-button">
            <i class="fa-solid fa-user optionsIcon"></i>
            Perfil
        </a>
        <a href="pages/permissoes" class="w3-bar-item w3-button">
            <i class="fa-solid fa-user-lock optionsIcon"></i>
            Permissões
        </a>
        <a href="pages/usuarios" class="w3-bar-item w3-button">
            <i class="fa-solid fa-users optionsIcon"></i>
            Usuários
        </a> 
        <a href="pages/manutencao" class="w3-bar-item w3-button">
            <i class="fa-solid fa-filter optionsIcon"></i>
            Parâmetros
        </a>
        <div class="logOutDiv">
            <a href="pages/sair">
                <i class="fa-solid fa-person-through-window optionsIcon"></i>
                Sair
            </a>    
        </div>
              
    </div>
    <div class="w3-overlay" onclick="w3_close()" style="z-index: 0;" id="myOverlay"></div>
    <div>
        <?php
            if(!isset($_SESSION['login'])){
                require "pages/login.php";
            }else{
                
                require "header.php";
                ?>
                    <main>
                        
                        <?php
                        $page = "home";
                        if (isset($_GET["param"])) {
                            $param = trim($_GET["param"]);
                            $param = explode("/", $param);
                            $pasta = $param[0] ?? NULL;
                            $arquivo = $param[1] ?? NULL;
                            $id = $param[2] ?? NULL;
                        }
                        
                        if (($pasta == "home") OR ($pasta == "index.php")) {
                            $page = "pages/home.php";
                        } else {
                            $page = "{$pasta}/{$arquivo}.php";
                        }
                        
                        //echo $pagina;
                        if (file_exists($page)) {
                            require $page;
                        } else {
                            require "pages/404.php";
                        }
                        ?>
                    </main>
                    <?php
                require "footer.php";
            }
        ?>
    </div>
    
<script>

    function sideBar(button){
        if(document.getElementById("sideBarIcon").value == "fechado"){
            w3_open();
        }else{
            w3_close();
        };
    };

    function w3_close() {
        document.getElementById("mySidebar").style.left = "-25%";
        document.getElementById("sideBarIcon").style.margin = "0% 0% 0% 0%";

        document.getElementById("sideBarIcon").value = "fechado";

        document.getElementById("myOverlay").style.display = "none";
    }

    function w3_open() {
        document.getElementById("mySidebar").style.transition = "500ms";
        document.getElementById("sideBarIcon").style.transition = "500ms";
        document.getElementById("mySidebar").style.left = "0%";
        document.getElementById("sideBarIcon").style.margin = "0% 0% 0% 25%";

        document.getElementById("sideBarIcon").value = "aberto";

        document.getElementById("myOverlay").style.transition = "500ms";
        document.getElementById("myOverlay").style.display = "block";
    }
</script>
</body>

</html>
