<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Solicitar Transferência </h1>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="id" class="formLabel">Id:</label>
                            <input type="text" name="id" id="id" placeholder="Id" readonly class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="marca" class="formLabel">Tipo:</label>
                            <select name="marca" id="marca" class="formInput">
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
                            <label for="marca" class="formLabel">Marca:</label>
                            <select name="marca" id="marca" class="formInput">
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
                        <div class="formCol">
                            <label for="unMedida" class="formLabel">Un. de Medida</label>
                            <select name="unMedida" id="unMedida" class="formInput">
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
                            <label for="unMedia" class="formLabel">Un. Média</label>
                            <input type="text" name="unMedia" id="unMedia" placeholder="Un. Média" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="categoria" class="formLabel">Categoria:</label>
                            <select name="categoria" id="categoria" class="formInput">
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
                    <br>
                    <br>
                    <div class="submitCol">
                        <button type="submit" class="formSubmitButton">Enviar</button>
                    </div>
                </div>
            </form>
            <br>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
</div>