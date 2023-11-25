<?php
    include './Estoque/Solicitacao.php';

    $origem = NULL;
    $idTipo = 2;
    $idCentroCusto = NULL;
    $idStatus = 8;
    $idSolicitante = $_SESSION['idUsuario'];
    $idEstoque = NULL;
    $data = date('Y-M-d');
    $necessidade = $data;

    $S = new Solicitacao($origem, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $necessidade);

    $idSolicitacao = $S->SolicitarRequisicao();

    echo($idSolicitacao);
?>




<div class="contentDiv">
    <div class="flex-row">
        <div class="modal-content" style="width: 75vw !important; margin: 0;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Requisição:</h1>
            </div>
            <div class="modal-body">
                <div class="formNewProd">
                    <form action="cadastrar/solicitacoes" id="formSolicitacao" method="post">
                        <div class="form-row">
                            <div class="formCol">
                                <input type="hidden" name="idSolicitante" id="idSolicitante" value="<?=$idSolicitante?>">
                                <input type="hidden" name="idTipo" id="idTipo" value="<?=$idTipo?>">
                                <input type="hidden" name="idStatus" id="idStatus" value="<?=$idStatus?>">
                                <input type="hidden" name="idEstoque" id="idEstoque" value="<?=$idEstoque?>">

                                <label for="origem">Origem:</label>
                                <select name="origem" id="origem" class="formInput">
                                    <option value="" >Selecione uma origem:</option>
                                    <?php
                                        $sql = "select * from centrocusto";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();
                                        while($dadosc = $consulta->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                                <option value="<?=$dadosc->idCentroCusto?>"><?=$dadosc->nome?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="idCentroCusto">Destino:</label>
                                <select name="idCentroCusto" id="idCentroCusto" class="formInput">
                                    <option value="">Selecione um destino:</option>
                                    <?php
                                        $sql = "select * from centrocusto";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();
                                        while($dadosc1 = $consulta->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                                <option value="<?=$dadosc1->idCentroCusto?>"><?=$dadosc1->nome?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="necessidade" class="formLabel">Data Limite:</label>
                                <input type="date" name="necessidade" id="necessidade" class="formInput">
                            </div>
                        </div>

                    </form>
                    <form name="formProdutos" method="post" action="itensRequisicao.php" data-parsley-validade="" target="itens">
                        <div class="form-row">
                            <div class="formCol">
                                <input type="hidden" name="idSolicitacao" id="idSolicitacao" value="<?=$id?>" readonly class="formInput">
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
                        <?php
                            echo($idSolicitacao);
                        ?>
                        <iframe name="itens" class="card" width="100%" height="300px" src="itensRequisicao.php?idSolicitacao=<?=$idSolicitacao?>"></iframe>
                        <br>
                    </form>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <div class="submitCol" >
                    <button type="submit" class="formSubmitButton" form="formSolicitacao">Cadastrar Requisição</button>
                </div>
                <a href="listar/solicitacoes">
                    <button type="button" class="btn btn-secondary">Fechar</button>
                </a>
            </div>
        </div>
        
    </div>

</div>