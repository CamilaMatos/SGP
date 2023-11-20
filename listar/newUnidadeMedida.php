<div class="col-12 pageHeader" style="display: flex">
    <div class="col-2">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-8">
        <h1>Unidades de Medida</h1>
    </div>
</div>

<br>

<div class="flex-row">
    <form action="" method="post">
        <div class="searchBar">
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Ex. Arroz" class="searchBarInput">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
    <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
        + Nova Unidade de medida
    </button>
</div>

<br>

<div class="flex-row">
    <?php
        if ($_POST && ($_POST['pesquisa'] != NULL)) {
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            <p>Id. Unidade de Medida</p>
                        </th>
                        <th scope="col">
                            <p>Unidade de Medida</p>
                        </th>
                        <th scope="col">
                            <p>Descrição</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pesquisa = trim($_POST['pesquisa']);
                    $sql = "select * from unidademedida where descricao LIKE '%$pesquisa%' order by idUnidadeMedida";
                    $consulta =  $pdo->prepare($sql);
                    $consulta->execute();
                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                        ?>
                        <tr>
                            <th scope="row">
                                <p><?= $dados->idUnidadeMedida ?></p>
                            </th>
                            <td>
                                <p><?= $dados->nome ?></p>
                            </td>
                            <td>
                                <p><?= $dados->descricao ?></p>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            <p>Id. Unidade de Medida</p>
                        </th>
                        <th scope="col">
                            <p>Unidade de Medida</p>
                        </th>
                        <th scope="col">
                            <p>Descrição</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "select * from unidademedida order by idUnidadeMedida desc limit 10";
                    $consulta =  $pdo->prepare($sql);
                    $consulta->execute();
                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                        ?>
                        <tr>
                            <th scope="row">
                                <p><?= $dados->idUnidadeMedida ?></p>
                            </th>
                            <td>
                                <p><?= $dados->nome ?></p>
                            </td>
                            <td>
                                <p><?= $dados->descricao ?></p>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
    ?>
    
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
            <form action="cadastrar/unidadeMedida" method="post">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="nome" class="formLabel">Nome da Unidade de Medida:</label>
                            <input type="text" name="nome" id="nome" placeholder="Ex. Lt" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="nome" class="formLabel">Descrição da Unidade de Medida:</label>
                            <input type="text" name="descricao" id="descricao" placeholder="Ex. Litro" class="formInput">
                        </div>
                    </div>
                </div>
            </form>
            <br>
        </div>
      <div class="modal-footer">
        <button type="submit" class="formSubmitButton">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>