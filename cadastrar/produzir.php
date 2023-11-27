<?php
    include "./Producao/OrdemServico.php";

    $OS = new OrdemServico(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    $OS->assinar($id, 11, $_SESSION['idUsuario']);
    echo "<script>alert('Ordem Levada para produção!!');</script>";
    echo "<script>location.href='listar/ordensServico'</script>";

?>