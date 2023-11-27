<?php
    include './Estoque/Solicitacao.php';

    $origem = NULL;
    $idTipo = 3;
    $idCentroCusto = NULL;
    $idStatus = 8;
    $idSolicitante = $_SESSION['idUsuario'];
    $idEstoque = NULL;
    $data = date('Y-M-d');
    $necessidade = $data;

    $S = new Solicitacao($origem, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $necessidade);

    $idSolicitacao = $S->solicitarTransferencia();

?>




<div class="contentDiv">
    <div class="flex-row">
        <div class="modal-content" style="width: 75vw !important; margin: 0;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Transferência </h1>
                <a href="listar/solicitacoes">
                    <button type="button" class="btn btn-secondary">Fechar</button>
                </a>
            </div>
            <div class="modal-body">
                <div class="formNewProd">
                    <form action="cadastrar/solicitacoes/<?=$idSolicitacao?>" id="formSolicitacao" method="post">
                        <div class="form-row">
                            <div class="formCol">
                                <input type="hidden" name="idSolicitante" id="idSolicitante" value="<?=$idSolicitante?>">
                                <input type="hidden" name="idTipo" id="idTipo" value="<?=$idTipo?>">
                                <input type="hidden" name="idStatus" id="idStatus" value="<?=$idStatus?>">

                                <label for="origem">Origem:</label>
                                <select name="origem" id="origem" class="formInput" required>
                                    <option value="" >Selecione uma origem:</option>
                                    <?php
                                        $sql = "select * from estoque";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();
                                        while($dadosc = $consulta->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                                <option value="<?=$dadosc->idEstoque?>"><?=$dadosc->nome?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="idEstoque">Destino:</label>
                                <select name="idEstoque" id="idEstoque" class="formInput" required>
                                    <option value="">Selecione um destino:</option>
                                    <?php
                                        $sql = "select * from estoque";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();
                                        while($dadosc1 = $consulta->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                                <option value="<?=$dadosc1->idEstoque?>"><?=$dadosc1->nome?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="necessidade" class="formLabel">Data Limite:</label>
                                <input type="date" name="necessidade" id="necessidade" class="formInput" required>
                            </div>
                        </div>

                    </form>
                    <form name="formProdutos" method="post" action="itensRequisicao.php" data-parsley-validade="" target="itens">
                        <div class="form-row">
                            <div class="formCol">
                                <input type="hidden" name="idSolicitacao" id="idSolicitacao" value="<?=$idSolicitacao?>" readonly class="formInput">
                            </div>
                            <div class="formCol">
                                <label for="marca" class="formLabel">Produtos:</label>
                                <select name="idItem" id="idItem" class="formInput">
                                    <option value="">Selecione um item:</option>
                                    <?php
                                    $sql = "select * from Item";
                                    $consulta = $pdo->prepare($sql);
                                    $consulta->execute();
                                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <option value="<?= $dados->idItem ?>"><?= $dados->nome ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
    
                            <div class="formCol">
                                <label for="qtd">Quantidade</label>
                                <input type="text" name="qtd" id="qtd" placeholder="Qtd." class="formInput">
                            </div>
    
                            <div class="formCol">
                                <div class="submitCol">
                                    <button type="submit" class="formSubmitButton">Adicionar Produto</button>
                                </div>
                            </div>
    
                        </div>
                        <br>
                        <iframe name="itens" class="card" width="100%" height="300px" src="itensRequisicao.php?idSolicitacao=<?=$idSolicitacao?>"></iframe>
                        <br>
                    </form>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <div class="submitCol" >
                    <button type="submit" class="formSubmitButton" form="formSolicitacao">Solicitar Transferência</button>
                </div>
            </div>
        </div>
        
    </div>

</div>