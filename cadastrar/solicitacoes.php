
<?php
    include './Estoque/Solicitacao.php';

    $origem = $_POST['origem'];
    $idTipo = $_POST['idTipo'];
    $idCentroCusto = $_POST['idCentroCusto'];
    $idStatus = ['idStatus'];
    $idSolicitante = $_SESSION['idUsuario'];
    $idEstoque = ['idEstoque'];
    $data = date('Y-M-d');
    $necessidade = ['necessidade'];

    $S = new Solicitacao($origem, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $necessidade);

    if ($_POST && empty($id)) {
        

        $resultado = $S->solicitarRequisicao();

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro, item já cadastrado');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";
        };
    }

    if(!empty($id)) {

        $resultado = $I->editarSolicitacao($id);

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro, item já cadastrado');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";
        }
        else {
            echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";
        };

    }
?>