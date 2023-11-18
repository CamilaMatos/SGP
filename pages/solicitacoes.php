<form>
    <input type="button" value="<-" onclick="history.back()">
</form>

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


<table>
    <thead>
        <tr>
            <td>
                Número
            </td>
            <td>
                Destino
            </td>
            <td>
                Tipo
            </td>
            <td>
                Data de abertura
            </td>
            <td>
                Data Limite
            </td>
            <td>
                Status
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql = "select s.idSolicitacao numero, cc.nome destino, t.nome tipo, s.data abertura, s.necessidade limite,
                st.nome status from solicitacao s
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

<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Solicitação</h1>
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
                            <label for="nome" class="formLabel">Nome:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" class="formInput">
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