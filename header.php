<link rel="stylesheet" href="css/style.css">
<header>
    <?php
    if (isset($_GET['param'])) {
        $param = trim($_GET["param"]);
        $param = explode("/", $param);
        $page = $param[1];
    };

    if($page == "home"){
        $stilo = "hidden";
    }else{$stilo = "";};
    ?>
    <a href="pages/home" class="headerIcon" <?=$stilo?>>
        home
    </a>

    <ul class="headerUl">
        <li>
            <div class="dropdown">
                <span>Perfil</span>
                <ul class="dropdown-content">
                    <li>
                        <a href="pages/perfil">
                            Perfil
                        </a>
                    </li>
                    <li>
                        <a href="pages/permissoes">
                            Permissões
                        </a>
                    </li>
                    <li>
                        <a href="pages/admin">
                            Administração
                        </a>
                    </li>
                    <li>
                        <a href='pages/sair'>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</header>