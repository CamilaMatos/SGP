<link rel="stylesheet" href="css/style.css">
<header>
    <?php
    if (isset($_GET['param'])) {
        $param = trim($_GET["param"]);
        $param = explode("/", $param);
        $page = $param[1];
    }

    ?>

    <button type="button" onclick="history.back()" class="return"> <- </button>

            <a href="pages/home" class="headerIcon">
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
                                <a href='pages/login'>
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
</header>