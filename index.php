<?php
session_start();
$page= "login";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/summernote-lite.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
    <?php
        if (isset($_GET['param'])) {
            $param = trim($_GET["param"]);
            $param = explode("/", $param);
            $page = $param[1];
        };

        if($page == "home"){
            $stilo = "hidden !important";
        }else{$stilo = "";}; 
        
        if($page == "permissoes"){
            $sPermissoes = "activeLink";
        }else{$sPermissoes = "";};

        if($page == "perfil"){
            $sPerfil = "activeLink";
        }else{$sPerfil = "";}; 

        if($page == "usuarios"){
            $sUsuarios = "activeLink";
        }else{$sUsuarios = "";}; 
        
        if($page == "manutencao"){
            $sManutencao = "activeLink";
        }else{$smanutencao = "";}; 
        
         
        
    ?>
    <div class="w3-sidebar w3-bar-block sideBar" id="mySidebar">
        <div class="sideBarTop">
            <div>
                <i class="fa-regular fa-circle-user loginIcon"></i>
            </div>
            <br>
            <div>
                <?php

                    $nome = $_SESSION['nome'];
                    echo "<p>$nome</p>";
                ?>
            </div>
        </div>
        <a href="pages/home" <?=$stilo?> class="butao">
            <div class="optionContainer">
                <div class="itemIconContainer">
                    <div class="itemIcon">
                        <i class="fa-solid fa-house optionsIcon"></i>
                    </div>
                </div>
                <div class="itemNameContainer">
                    <div class="itemName">
                        Home
                    </div>
                </div>
            </div>
        </a>
        <a href="pages/perfil" class="butao <?=$sPerfil?>">
            <div class="optionContainer">
                <div class="itemIconContainer">
                    <div class="itemIcon">
                        <i class="fa-solid fa-user optionsIcon"></i>
                    </div>
                </div>
                <div class="itemNameContainer">
                    <div class="itemName">
                        Perfil
                    </div>
                </div>
            </div>
        </a>
        <a href="pages/permissoes" hidden class="butao <?=$sPermissoes?>">
            <div class="optionContainer">
                <div class="itemIconContainer">
                    <div class="itemIcon">
                        <i class="fa-solid fa-user-lock optionsIcon"></i>
                    </div>
                </div>
                <div class="itemNameContainer">
                    <div class="itemName">
                        Permissões
                    </div>
                </div>
            </div>
        </a>
        <a href="listar/usuarios" class="butao <?=$sUsuarios?>">
            <div class="optionContainer">
                <div class="itemIconContainer">
                    <div class="itemIcon">
                        <i class="fa-solid fa-users optionsIcon"></i>
                    </div>
                </div>
                <div class="itemNameContainer">
                    <div class="itemName">
                        Usuários
                    </div>
                </div>
            </div>
        </a>
        <a href="pages/manutencao" class="butao <?=$sManutencao?>">
            <div class="optionContainer">
                <div class="itemIconContainer">
                    <div class="itemIcon">
                        <i class="fa-solid fa-filter optionsIcon"></i>
                    </div>
                </div>
                <div class="itemNameContainer">
                    <div class="itemName">
                        Parâmetros
                    </div>
                </div>
            </div>
        </a>
        <div class="logOutDiv">
            <a href="pages/sair">
                <i class="fa-solid fa-person-through-window optionsIconLogOut"></i>
                Sair
            </a>    
        </div>
              
    </div>
    <div class="w3-overlay" onclick="w3_close()" style="z-index: 1;" id="myOverlay"></div>
    <div>
        <?php
            if(!isset($_SESSION['login'])){
                require "pages/login.php";
            }else{
                
                require "header.php";
                ?>
                    <main>
                        
                        <?php
                        $page = "login";
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
    };

    function w3_open() {
        document.getElementById("mySidebar").style.transition = "500ms";
        document.getElementById("sideBarIcon").style.transition = "500ms";
        document.getElementById("mySidebar").style.left = "0%";
        document.getElementById("sideBarIcon").style.margin = "0% 0% 0% 25%";

        document.getElementById("sideBarIcon").value = "aberto";

        document.getElementById("myOverlay").style.transition = "500ms";
        document.getElementById("myOverlay").style.display = "block";
    };

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
</body>

</html>