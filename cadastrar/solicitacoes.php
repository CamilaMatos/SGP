
<?php
    include './Estoque/Solicitacao.php';

    $origem = $_POST['origem'] ?? NULL;
    $idTipo = $_POST['idTipo'] ?? NULL;
    $idCentroCusto = $_POST['idCentroCusto'] ?? NULL;
    $idStatus = $_POST['idStatus'] ?? NULL;
    $idSolicitante = $_SESSION['idUsuario'] ?? NULL;
    $idEstoque = $_POST['idEstoque'] ?? NULL;
    $data = date('Y-M-d');
    $necessidade = $_POST['necessidade'] ?? NULL;

    $op = trim($_GET["op"] ?? $_POST["op"] ?? NULL);

    echo ($op);


    $S = new Solicitacao($origem, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $necessidade);


    if ($_POST && empty($id)) {
        

        $resultado = $S->solicitarRequisicao();

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";

        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";
        };
    }

    if(!empty($id)) {

        $resultado = $S->finalizarSolicitacao($id);

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";

        } else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";
        };

    }
?>