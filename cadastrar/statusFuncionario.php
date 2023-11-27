<?php
    include "./Estoque/Usuario.php";

    $sql = "select * from usuario where idUsuario=:idUsuario";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":idUsuario", $id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $idUsuario = $id;
    
    if($dados->idStatus == 1){
        $idStatus = 2;
        $S = new Usuario(NULL, NULL, NULL, $idStatus, NULL, NULL, NULL);
        $resultado = $S->alterarStatusUsuario($idUsuario, $idStatus);

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        } else {
            echo "<script>alert('Usuário inativado!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }
    }
    if($dados->idStatus == 2){

        $idStatus = 1;
        $S = new Usuario(NULL, NULL, NULL, $idStatus, NULL, NULL, NULL);
        $resultado = $S->alterarStatusUsuario($idUsuario, $idStatus);

        if ($resultado == "E") {
            echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }if ($resultado == "R") {
            echo "<script>alert('Erro! Item já cadastrado com esse nome!!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        } else {
            echo "<script>alert('Usuário ativado !!!');</script>";
            echo "<script>location.href='listar/usuarios'</script>";
        }
    }

?>