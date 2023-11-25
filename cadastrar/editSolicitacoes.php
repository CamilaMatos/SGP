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

    print_r($_POST);

    $S = new Solicitacao($origem, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $necessidade);

    if(!empty($id)) {

        $resultado = $S->editarSolicitacao($id);

        if ($resultado == "E") {
            echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
            

        } else if ($resultado == "R"){
            echo "<script>alert('Erro, item já cadastrado');</script>";
            
        }
        else {
            echo "<script>alert('Requisição editada com sucesso!!!');</script>";
            
        };

    }
?>