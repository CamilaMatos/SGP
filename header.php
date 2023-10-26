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
    <button class="hamburguerMenu" id="sideBarIcon" type="button" value="fechado" onclick="sideBar(this)">☰</button>
    <a href="pages/home" class="headerIcon" <?=$stilo?>>
        home
    </a>

    <ul class="headerUl">
    </ul>
</header>