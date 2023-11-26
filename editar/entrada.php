<?php
    $sql = "select * from lote where idLote = $id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $dadosE = $consulta->fetch(PDO::FETCH_OBJ);
?>


<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Entrada Nº<?=$id?></h1>
            <button type="button" class="btn btn-secondary" onclick="history.back()" data-dismiss="modal">Fechar</button>
        </div>
        <div class="modal-body">
        <form action="cadastrar/entrada/<?=$id?>" method="post"  id="editEntrada">
            <div class="formNewProd">
                <div class="form-row">
                    <div class="formCol">
                        <label for="item" class="formLabel">Produto:</label>
                        <select name="item" id="item" required class="formInput">
                            <option value="">Selecione um item:</option>
                            <?php
                                $sql = "select i.idItem item, i.nome nome from item i order by nome";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    if($dados->item == $dadosE->idItem){
                                        ?>
                                            <option value="<?=$dados->item?>" selected><?=$dados->nome?></option>
                                        <?php
                                        
                                    }else{
                                        ?>
                                            <option value="<?= $dados->item ?>"><?= $dados->nome ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="formCol">
                        <label for="estoque" class="formLabel">Estoque:</label>
                        <select name="estoque" id="estoque" required class="formInput">
                            <option value="">Selecione um estoque:</option>
                            <?php
                                $sql = "select e.idEstoque estoque, e.nome nome from estoque e order by nome";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    if($dados->estoque == $dadosE->idEstoque){
                                        ?>
                                            <option value="<?= $dados->estoque ?>" selected><?=$dados->nome?></option>
                                        <?php
                                        
                                    }else{
                                        ?>
                                            <option value="<?= $dados->estoque ?>"><?= $dados->nome ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="formCol">
                        <label for="qtdInicial" class="formLabel">Quantidade Inicial:</label>
                        <input type="number" name="qtdInicial" id="qtdInicial" value="<?=$dadosE->quantidadeInicial?>" required class="formInput">
                    </div>
                    <div class="formCol">
                        <label for="qtdAtual" class="formLabel">Quantidade Atual:</label>
                        <input type="number" name="qtdAtual" id="qtdAtual" value="<?=$dadosE->quantidadeAtual?>" required class="formInput">
                    </div>           
                </div>
                <div class="form-row">
                    <div class="formCol">
                        <label for="validade" class="formLabel">Data de Validade:</label>
                        <input type="date" name="validade" id="validade" required class="formInput" value="<?=$dadosE->validade?>">
                    </div>
                    <div class="formCol">
                        <label for="vlUnitario" class="formLabel">Valor Unitário:</label>
                        <input type="float" name="vlUnitario" id="vlUnitario" value="<?=$dadosE->valorUnitario?>" required class="formInput">
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="formSubmitButton" form="editEntrada">Enviar</button>
        </div>
    </div>
</div>

