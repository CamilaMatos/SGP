<?php
    include "./Producao/OrdemServico.php";

    $OS = new OrdemServico(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    $OS->assinar($id, 7, $_SESSION['idUsuario']);
    echo "<script>alert('Itens Separados');</script>";
    echo "<script>location.href='listar/ordensServico'</script>";

?>