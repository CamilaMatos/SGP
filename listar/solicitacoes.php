<div class="col-12 pageHeader" style="display: flex">
    <div class="col-2">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-8">
        <h1>Solicitações</h1>
    </div>
</div>

<form action="" method="post">
    <select name="centroOrigem" id="centroOrigem">
        <option value="">Selecione o Centro de Custo de Origem</option>
        <?php
        $sql = "select * from centrocusto order by nome";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <option value="<?= $dados->idCentroCusto ?>"><?= $dados->nome ?></option>
        <?php
        }
        ?>
    </select>
    <select name="centroDestino" id="centroDestino">
        <option value="">Selecione o Centro de Custo de Destino</option>
        <?php
        $sql = "select * from centrocusto order by nome";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <option value="<?= $dados->idCentroCusto ?>"><?= $dados->nome ?></option>
        <?php
        }
        ?>
    </select>
    <input type="text" name="item" id="item" placeholder="Item da Requisição">
    <input type="text" name="qtdDisponivel" id="qtdDisponivel" readonly>
    <input type="text" name="qtdSolicitada" id="qtdSolictada">
</form>

<button type="button" class="newButton" data-toggle="modal" data-target="#modalCadRequisicao">
    + Nova Requisição
</button>

<button type="button" class="newButton" data-toggle="modal" data-target="#modalCadTransferencia">
    Solicitar Transferência
</button>

<div class="flex-row">
    <table class="table-striped">
        <thead>
            <tr>
                <th>
                    Número
                </th>
                <th>
                    Destino
                </th>
                <th>
                    Tipo
                </th>
                <th>
                    Data de abertura
                </th>
                <th>
                    Data Limite
                </th>
                <th>
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "select s.idSolicitacaoMovimentacao numero, cc.nome destino, t.nome tipo, s.data abertura, s.necessidade limite,
                    st.nome status from solicitacaomovimentacao s
                    inner join centrocusto cc on s.idCentroCusto = cc.idCentroCusto
                    inner join tipo t on s.idTipo = t.idTipo
                    inner join status st on s.idStatus = st.idStatus order by numero desc limit 15";
    
                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                    ?>
                        <tr>
                            <td>
                                <?=$dados->numero?>
                            </td>
                            <td>
                                <?=$dados->destino?>
                            </td>
                            <td>
                                <?=$dados->tipo?>
                            </td>
                            <td>
                                <?=$dados->abertura?>
                            </td>
                            <td>
                                <?=$dados->limite?>
                            </td>
                            <td>
                                <?=$dados->status?>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCadRequisicao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Requisição</h1>
        </div>
        <div class="modal-body">
            <form name="formProdutos" method="post" action="itensRequisicao.php" data-parsley-validade="" target="itens">
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
                    </div>
                    <div class="form-row">
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
                    <iframe name="itens" class="card" width="100%" height="300px" src="itensRequisicao.php?venda_id=<?=$id?>"></iframe>
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
</div>

<div class="modal fade" id="modalCadTransferencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    </div>
                    <div class="form-row">
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
</div>