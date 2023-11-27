<?php
    include "./Producao/OrdemServico.php";

    $OS = new OrdemServico(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

    if($_POST){

        
        $sql = "select * from ordemservico where idOrdemServico = :idOrdemServico";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idOrdemServico", $id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        print_r($dados);
        
        $idEstoque = $_POST['idEstoque'];
        $validade = $_POST['validade'];
        $idReceita = $dados->idReceita;
        $rendimentoReal = $_POST['rendimentoReal'];
        $idUsuario = $_SESSION['idUsuario'];

        $OS = new OrdemServico($idReceita, $idUsuario, NULL, NULL, $rendimentoReal, NULL, NULL, NULL, NULL);

        $OS->concluirOS($dados->idSolicitacao, $dados->idOrdemServico, $idEstoque, $validade);
        echo "<script>alert('Itens Separados');</script>";
        echo "<script>location.href='listar/ordensServico'</script>";
    };

    $sql = "select * from ordemservico where idOrdemServico = :idOrdemServico";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":idOrdemServico", $id);
    $consulta->execute();
    $dadosOS = $consulta->fetch(PDO::FETCH_OBJ);

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Finalizar Ordem de serviço</h1>
        </div>
        <div class="modal-body">
            <form action="cadastrar/finalizar/<?=$id?>" method="post" id="formOrdemServico">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="rendimentoPlanejado" class="formLabel">Rendimento Planejado:</label>
                            <input type="number" name="rendimentoPlanejado" id="rendimentoPlanejado" readonly value="<?=$dadosOS->rendimentoEsperado?>" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="rendimentoReal" class="formLabel">Rendimento Real:</label>
                            <input type="number" name="rendimentoReal" id="rendimentoReal" class="formInput">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="idEstoque" class="formLabel">Estoque de Destino:</label>
                            <select name="idEstoque" id="idEstoque" class="formInput">
                                <option value="">Selecione um estoque...</option>
                                <?php
                                $sql = "select * from estoque";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dadosEst = $consulta->fetch(PDO::FETCH_OBJ)) {
                                ?>
                                    <option value="<?= $dadosEst->idEstoque ?>"><?= $dadosEst->nome ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="formCol">
                            <label for="validade" class="formLabel">Validade:</label>
                            <input type="date" name="validade" id="validade" class="formInput">
                        </div>
                    </div>
                </div>
            </form>
            <br>
        </div>
        <div class="modal-footer">
            <button type="submit" class="formSubmitButton" form="formOrdemServico">Enviar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
    </div>
</div>