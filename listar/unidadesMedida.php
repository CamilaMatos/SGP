<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <button type="button" onclick="history.back()" class="backButton"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-10">
        <h1>Unidades de Medida</h1>
    </div>
</div>

<br>

<div class="flex-row">
    <form action="cadastrar/unidadeMedida" method="post">
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
            <table class="table table-striped table70Length">
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
            <table class="table table-striped table70Length">
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
                        <th scope="col">
                            <p>Opções</p>
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
                            <td>

                                <a href="javascript:excluir(<?=$dados->idUnidadeMedida?>)" title="Excluir"
                                class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>

                                <a href="editar/unidadeMedida/<?=$dados->idUnidadeMedida?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
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

<br>
<br>

<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Produto</h1>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            <div class="modal-body">
                <form action="cadastrar/unidadeMedida" method="post" id="formUM">
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
                <button type="submit" class="formSubmitButton" form="formUM" >Enviar</button>
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
                location.href = "excluir/unidadeMedida/" + id;
            }
        })
    }
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