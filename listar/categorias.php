<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <button type="button" onclick="history.back()" class="backButton"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-10">
        <h1>Categorias</h1>
    </div>
</div>

<div class="contentDiv">

    <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
        + Nova Categoria
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
                                <p>Id. Marca</p>
                            </th>
                            <th scope="col">
                                <p>Marca</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pesquisa = trim($_POST['pesquisa']);
                        $sql = "select * from categoria where nome LIKE '%$pesquisa%' order by idCategoria";
                        $consulta =  $pdo->prepare($sql);
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>
                                <th scope="row">
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
            <?php
            } else {
                ?>
                <table class="table table-striped table70Length">
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
                <?php
            }
        ?>
    </div>
    
</div>


<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova categoria</h1>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            <div class="modal-body">
                <form action="cadastrar/categoria" method="post" id="formCategoria">
                    <div class="formNewProd">
                        <div class="form-row">
                            <div class="formCol">
                                <label for="nome" class="formLabel">Nome da Categoria:</label>
                                <input type="text" name="nome" id="nome" placeholder="Lt." class="formInput">
                            </div>
                        </div>
                        
                    </div>
                </form>
                <br>
            </div>
            <div class="modal-footer">
                <button type="submit" class="formSubmitButton" form="formCategoria">Enviar</button>
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