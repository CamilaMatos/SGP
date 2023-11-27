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

    $S = new Solicitacao($origem, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $necessidade);

    if(!empty($id)) {

        $resultado = $S->editarSolicitacao($id);

        if ($resultado == "E") {
            echo "<script>alert('A solicitação não pode ser cadastrada por que algo deu errado!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";

        } else if ($resultado == "R"){
            echo "<script>alert('Erro, item já cadastrado');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";
        }
        else {
            echo "<script>alert('Requisição editada com sucesso!!!');</script>";
            echo "<script>location.href='listar/solicitacoes'</script>";
        };

    }
?>