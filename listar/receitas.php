<div class="col-12 pageHeader" style="display: flex">
    <div class="col-2">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-8">
        <h1>Receitas</h1>
    </div>
</div>
<div class="contentDiv">
    <div class="flex-row">
        <form action="" method="post">
            <div class="searchBar">
                <input type="text" name="pesquisa" id="pesquisa" placeholder="Ex. Arroz" class="searchBarInput">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
            + Nova Receita
        </button>
    </div>
    
    <br>
    <br>
    <div class="flex-row">
        <?php
            if ($_POST && ($_POST['pesquisa'] != NULL)) {
                ?>
                <table class="table-striped table70Length">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p>Id. Produto</p>
                            </th>
                            <th scope="col">
                                <p>Produto</p>
                            </th>
                            <th scope="col">
                                <p>Categoria</p>
                            </th>
                            <th scope="col">
                                <p>Marca</p>
                            </th>
                            <th scope="col">
                                <p>Unidade de Medida</p>
                            </th>
                            <th scope="col">
                                <p>Status</p>
                            </th>
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
                                <th scope="row">
                                    <p><?= $dados->id ?></p>
                                </th>
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
                <table class="table-striped table70Length">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p>Id. Produto</p>
                            </th>
                            <th scope="col">
                                <p>Produto</p>
                            </th>
                            <th scope="col">
                                <p>Categoria</p>
                            </th>
                            <th scope="col">
                                <p>Marca</p>
                            </th>
                            <th scope="col">
                                <p>Unidade de Medida</p>
                            </th>
                            <th scope="col">
                                <p>Status</p>
                            </th>
                            <th scope="col">
                                <p>Opções</p>
                            </th>
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
                                <th scope="row">
                                    <p><?= $dados->id ?></p>
                                </th>
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
                                <td>

                                    <a href="javascript:excluir(<?=$dados->id?>)" title="Excluir"
                                    class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <a href="editar/produto/<?=$dados->id?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

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
                <form action="cadastrar/produtos" method="post">
                    <div class="formNewProd">
                        <div class="form-row">
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
                                <label for="unMedida" class="formLabel">Unidade de Medida:</label>
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
                                <label for="unidadeMedia" class="formLabel">Unidade Média:</label>
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
                        <button type="submit" class="formSubmitButton">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
  </div>
</div>

<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Produto</h1>
            </div>
            <div class="modal-body">
                <form action="cadastrar/produtos" method="post">
                    <div class="formNewProd">
                        <div class="form-row">
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
                                <label for="unMedida" class="formLabel">Unidade de Medida:</label>
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
                                <label for="unidadeMedia" class="formLabel">Unidade Média:</label>
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
                        <button type="submit" class="formSubmitButton">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
  </div>
</div>

<script>
    function excluir(id) {
        Swal.fire({
            icon: "warning",
            title: "Você deseja mesmo excluir este registro?",
            showCancelButton: true,
            confirmButtonText: "Excluir",
            cancelButtonText: "Cancelar",
        }).then((result)=>{
            if (result.isConfirmed) {
                location.href = "excluir/produto/" + id;
            }
        })
    }
</script>