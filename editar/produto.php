
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Produto</h1>
            <a href="listar/produtos">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </a>
        </div>
        <div class="modal-body">
            <form action="cadastrar/produtos/<?=$id?>" method="post" id="editProduto">
                <div class="formNewProd">

                    <?php
                        $sql = "select nome, unidadeMedia from item where idItem = :id limit 1";
                        $consulta = $pdo->prepare($sql);
                        $consulta->bindParam(":id", $id);
                        $consulta->execute();
                        while($dados2 = $consulta->fetch(PDO::FETCH_OBJ)){
                            ?>
                                <div class="form-row">
                                    <div class="formCol">
                                        <label for="nome" class="formLabel">
                                            Nome:
                                        </label>
                                        <input type="text" name="nome" id="nome" value="<?=$dados2->nome?>" class="formInput" required>
                                    </div>
                                    <div class="formCol">
                                        <label for="marca" class="formLabel">Marca:</label>
                                        <select name="marca" id="marca" class="formInput" required>
                                            <option value="">Selecione uma marca</option>
                                            <?php
                                            $sql = "select * from marca";
                                            $consulta = $pdo->prepare($sql);
                                            $consulta->execute();
                                            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                            ?>
                                                <option value="<?= $dados->idMarca ?>"><?= $dados->nome ?></option>
                                            <?php
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
                                            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                            ?>
                                                <option value="<?= $dados->idUnidadeMedida ?>"><?= $dados->nome ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="formCol">
                                        <label for="unidadeMedia" class="formLabel">Unidade Média:</label>
                                        <input type="text" name="unMedia" id="unMedia" value="<?=$dados2->unidadeMedia?>" class="formInput" required>
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
                                            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                            ?>
                                                <option value=<?= $dados->idCategoria ?>><?= $dados->nome ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="formSubmitButton" form="editProduto">Enviar</button>
        </div>
    </div>
</div>

