<?php
    $sql = "select * from item where idItem = $id";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $dadosItem = $consulta->fetch(PDO::FETCH_OBJ);
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Produto</h1>
            
            <button type="button" class="btn btn-secondary" onclick="history.back()" data-dismiss="modal">Fechar</button>
            
        </div>
        <div class="modal-body">
            <form action="cadastrar/produtos/<?=$id?>" method="post" id="editProduto">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="nome" class="formLabel">
                                Nome:
                            </label>
                            <input type="text" name="nome" id="nome" value="<?=$dadosItem->nome?>" class="formInput" required>
                        </div>
                        <div class="formCol">
                            <label for="marca" class="formLabel">Marca:</label>
                            <select name="marca" id="marca" class="formInput" required>
                                <option value="">Selecione uma marca</option>
                                <?php
                                $sql = "select m.idMarca, m.nome from marca m";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dadosM = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    if($dadosM->idMarca == $dadosItem->idMarca){
                                        ?>
                                            <option value="<?=$dadosM->idMarca?>" selected><?=$dadosM->nome?></option>
                                        <?php
                                        
                                    }else{
                                        ?>
                                            <option value="<?= $dadosM->idMarca ?>"><?= $dadosM->nome ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="unMedida" class="formLabel">Unidade de Medida:</label>
                            <select name="unMedida" id="unMedida" class="formInput" required>
                                <option value="">Selecione uma unidade de medida</option>
                                <?php
                                $sql = "select * from unidademedida";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dadosUM = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    if($dadosUM->idUnidadeMedida == $dadosItem->idUnidadeMedida){
                                        ?>
                                            <option value="<?=$dadosUM->idUnidadeMedida?>" selected><?=$dadosUM->nome?></option>
                                        <?php
                                        
                                    }else{
                                        ?>
                                            <option value="<?= $dadosUM->idUnidadeMedida ?>"><?= $dadosUM->nome ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="formCol">
                            <label for="unidadeMedia" class="formLabel">Unidade Média:</label>
                            <input type="text" name="unMedia" id="unMedia" value="<?=$dadosItem->unidadeMedia?>" class="formInput" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="categoria" class="formLabel">Categoria:</label>
                            <select name="categoria" id="categoria" class="formInput" required>
                                <option value="">Selecione uma categoria</option>
                                <?php
                                $sql = "select * from categoria";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dadosC = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    if($dadosC->idCategoria == $dadosItem->idCategoria){
                                        ?>
                                            <option value="<?=$dadosC->idCategoria?>" selected><?=$dadosC->nome?></option>
                                        <?php
                                        
                                    }else{
                                        ?>
                                            <option value=<?= $dadosC->idCategoria ?>><?= $dadosC->nome ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            
                        </div>
                    </div>
                            
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="formSubmitButton" form="editProduto">Enviar</button>
        </div>
    </div>
</div>

