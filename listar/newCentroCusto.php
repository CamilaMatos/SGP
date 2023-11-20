<div class="col-12 pageHeader" style="display: flex">
    <div class="col-2">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-8">
        <h1>Centros de Custo</h1>
    </div>
</div>

<button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
    + Novo Centro de Custo
</button>

<div class="flex-row">
    <table class="table-striped">
        <thead>
            <tr>
                <th scope="col">
                    <p>Id. Centro de Custo</p>
                </th>
                <th scope="col">
                    <p>Centro de Custo</p>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from centrocusto order by idCentroCusto desc limit 10";
            $consulta =  $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>
                <tr>
                    <th scope="row">
                        <p><?= $dados->idCentroCusto ?></p>
                    </th>
                    <td>
                        <p><?= $dados->nome ?></p>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<br>
<br>

<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Produto</h1>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="formNewProd">
                    <div class="form-row">

                        <div class="formCol">
                            <label for="nome" class="formLabel">Centro de Custo:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" class="formInput">
                        </div>

                        <div class="formCol">
                            <label for="descricao" class="formLabel">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" placeholder="Descrição" class="formInput">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="status" class="formLabel">Status</label>
                            <select name="status" id="status" class="formInput">
                                <option value="">Selecione o Status de abertura...</option>
                                <?php
                                $sql = "select * from status";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                ?>
                                    <option value="<?= $dados->idStatus ?>"><?= $dados->nome ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="formSubmitButton">Enviar</button>
                </div>
            </form>
            <br>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>