<br>
<form>
    <input type="button" value="<-" onclick="history.back()">
</form>
<h1>Produtos mais utilizados</h1>
<br>
<br>
<div class="contentDiv">
    <div class="flex-row">
        <form action="" method="post">
            <div class="searchBar">
                <input type="text" name="pesquisa" id="pesquisa" placeholder="Ex. Arroz" class="searchBarInput">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
            + Novo Produto
        </button>
    </div>
    
    <br>
    <br>
    <div class="flex-row">
        <?php
            if ($_POST && ($_POST['pesquisa'] != NULL)) {
                ?>
                <table>
                    <thead>
                        <tr>
                            <td>
                                <p>Id. Produto</p>
                            </td>
                            <td>
                                <p>Produto</p>
                            </td>
                            <td>
                                <p>Categoria</p>
                            </td>
                            <td>
                                <p>Marca</p>
                            </td>
                            <td>
                                <p>Unidade de Medida</p>
                            </td>
                            <td>
                                <p>Status</p>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = trim($_POST['pesquisa']);
                        $sql = "select i.idItem id, i.nome nome, c.nome categoria, m.nome marca, uM.nome unidadeMedida, s.nome status from item i
                        inner join categoria c
                        on i.idcategoria = c.idCategoria 
                        inner join marca m
                        on i.idMarca = m.idmarca
                        inner join unidadeMedida uM
                        on i.idUnidadeMedida = uM.idUnidadeMedida
                        inner join status s
                        on i.idStatus = s.idStatus
                        where i.nome like '%$pesquisa%'
                        order by idItem ";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                        ?>
                            <tr>
                                <td>
                                    <p><?= $dados->id ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->nome ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->categoria ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->marca ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->unidadeMedida ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->status ?></p>
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
                <table>
                    <thead>
                        <tr>
                            <td>
                                <p>Id. Produto</p>
                            </td>
                            <td>
                                <p>Produto</p>
                            </td>
                            <td>
                                <p>Categoria</p>
                            </td>
                            <td>
                                <p>Marca</p>
                            </td>
                            <td>
                                <p>Unidade de Medida</p>
                            </td>
                            <td>
                                <p>Status</p>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select i.idItem id, i.nome nome, c.nome categoria, m.nome marca, uM.nome unidadeMedida, s.nome status from item i
                            inner join categoria c
                            on i.idcategoria = c.idCategoria 
                            inner join marca m
                            on i.idMarca = m.idmarca
                            inner join unidadeMedida uM
                            on i.idUnidadeMedida = uM.idUnidadeMedida
                            inner join status s
                            on i.idStatus = s.idStatus
                            order by idItem desc limit 15";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                        ?>
                            <tr>
                                <td>
                                    <p><?= $dados->id ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->nome ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->categoria ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->marca ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->unidadeMedida ?></p>
                                </td>
                                <td>
                                    <p><?= $dados->status ?></p>
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
</div>

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