
<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <button type="button" onclick="history.back()" class="backButton"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-10">
        <h1>Estoques</h1>
    </div>
</div>

<div class="contentDiv">

    <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
        + Novo Estoque
    </button>

    <br>
    <br>
    
    <div class="flex-row">
        <?php
            if ($_POST && ($_POST['pesquisa'] != NULL)) {
                ?>
                <table class="table table-striped table70Length">
                <thead>
                        <tr>
                            <th scope="col">
                                <p>Id. Estoque</p>
                            </th>
                            <th scope="col">
                                <p>Estoque</p>
                            </th>
                            <th scope="col">
                                <p>Descrição</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = trim($_POST['pesquisa']);
                        $sql = "select * from estoque where nome LIKE '%$pesquisa%' order by idEstoque";
                        $consulta =  $pdo->prepare($sql);
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <p><?= $dados->idEstoque ?></p>
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
                <table class="table table-striped table70Length">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p>Id. Estoque</p>
                            </th>
                            <th scope="col">
                                <p>Estoque</p>
                            </th>
                            <th scope="col">
                                <p>Descrição</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from estoque order by idEstoque desc limit 10";
                        $consulta =  $pdo->prepare($sql);
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                        ?>
                            <tr>
                                <th scope="row">
                                    <p><?= $dados->idEstoque ?></p>
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

</div>

<br>
<br>

<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Estoque</h1>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
        <div class="modal-body">
            <form action="cadastrar/estoque" method="post" id="formEstoque">
                <div class="formNewProd">
                    <div class="form-row">

                        <div class="formCol">
                            <label for="nome" class="formLabel">Estoque:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" class="formInput" required>
                        </div>

                        <div class="formCol">
                            <label for="descricao" class="formLabel">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" placeholder="Descrição" class="formInput" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="status" class="formLabel">Status:</label>
                            <select name="status" id="status" class="formInput" required>
                                <option value="">Selecione o status de abertura...</option>
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
                </div>
            </form>
            <br>
        </div>
      <div class="modal-footer">
        <button type="submit" class="formSubmitButton" form="formEstoque">Enviar</button>
        
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $(".table").DataTable({
            searching: false,
            "pageLength": 15,
            "bLengthChange" : false,
            "info":false, 
            "order": [[0, 'desc']],
            language: {
            "emptyTable": "Nenhum registro encontrado",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "loadingRecords": "Carregando...",
            "zeroRecords": "Nenhum registro encontrado",
            "paginate": {
                "next": "Próximo",
                "previous": "Anterior",
                "first": "Primeiro",
                "last": "Último"
            },
            "lengthMenu": "Exibir _MENU_ resultados por página",
            "searchable": false
        },
        
        });
    })
</script>