<?php
    include './Estoque/Solicitacao.php';
    $sql = "select * from solicitacao where idSolicitacao = :idSolicitacao";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':idSolicitacao', $id);
    $consulta->execute();

    $dados = $consulta->fetch(PDO::FETCH_OBJ);
?>


<div class="contentDiv">
    <div class="flex-row">
        <div class="modal-content" style="width: 75vw !important; margin: 0;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Requisição Nº<?=$id?></h1>
                
                <button type="button" class="btn btn-secondary" onclick="history.back()" data-dismiss="modal">Fechar</button>
                
            </div>
            <div class="modal-body">
                <div class="formNewProd">
                    <form action="cadastrar/editSolicitacoes/<?=$id?>" id="formSolicitacao" method="post">
                        <div class="form-row">
                            <div class="formCol">
                                <input type="hidden" name="idSolicitante" id="idSolicitante" value="<?=$dados->idSolicitante?>">
                                <input type="hidden" name="idTipo" id="idTipo" value="<?=$dados->idTipo?>">
                                <input type="hidden" name="idStatus" id="idStatus" value="<?=$dados->idStatus?>">

                                <label for="origem">Origem:</label>
                                <select name="origem" id="origem" class="formInput">
                                    <option value="" >Selecione uma origem:</option>
                                    <?php
                                        $sql = "select * from estoque";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();
                                        while($dadosc = $consulta->fetch(PDO::FETCH_OBJ)){
                                            if($dadosc->idEstoque == $dados->origem){
                                                ?>
                                                    <option value="<?=$dadosc->idEstoque?>" selected><?=$dadosc->nome?></option>
                                                <?php
                                                
                                            }else{
                                                ?>
                                                    <option value="<?=$dadosc->idEstoque?>"><?=$dadosc->nome?></option>
                                                <?php
                                            }
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
                                            if($dadosc1->idCentroCusto == $dados->idCentroCusto){
                                                ?>
                                                    <option value="<?=$dadosc1->idCentroCusto?>" selected><?=$dadosc1->nome?></option>
                                                <?php
                                                
                                            }else{
                                                ?>
                                                    <option value="<?=$dadosc1->idCentroCusto?>"><?=$dadosc1->nome?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="necessidade" class="formLabel">Data Limite:</label>
                                <input type="date" name="necessidade" id="necessidade" class="formInput" value="<?=$dados->necessidade?>">
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
                                <input type="number" name="qtd" id="qtd" placeholder="Qtd." class="formInput">
                            </div>
    
                            <div class="formCol">
                                <div class="submitCol">
                                    <button type="submit" class="formSubmitButton">Adicionar Produto</button>
                                </div>
                            </div>
    
                        </div>
                        <br>
                        <iframe name="itens" class="card" width="100%" height="300px" src="itensRequisicao.php?idSolicitacao=<?=$id?>"></iframe>
                        <br>
                    </form>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <div class="submitCol" >
                    <button type="submit" class="formSubmitButton" form="formSolicitacao">Cadastrar Requisição</button>
                </div>
            </div>
        </div>
        
    </div>

</div>