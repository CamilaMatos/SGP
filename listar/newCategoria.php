<div class="col-12 pageHeader" style="display: flex">
    <div class="col-2">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-8">
        <h1>Categorias</h1>
    </div>
</div>


<button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
    + Nova Categoria
</button>

<br>
<br>

<div class="flex-row">
    <table class="table-striped">
        <thead>
            <tr>
                <th scope="col">
                    <p>Id. Categoria</p>
                </th>
                <th scope="col">
                    <p>Categoria</p>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from categoria order by idCategoria desc limit 10";
            $consulta =  $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>
                <tr>
                    <th>
                        <p><?= $dados->idCategoria ?></p>
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

<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova categoria</h1>
            </div>
            <div class="modal-body">
                <form action="cadastrar/categoria" method="post">
                    <div class="formNewProd">
                        <div class="form-row">
                            <div class="formCol">
                                <label for="nome" class="formLabel">Nome da Categoria:</label>
                                <input type="text" name="nome" id="nome" placeholder="Lt." class="formInput">
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