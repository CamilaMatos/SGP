<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <a href="pages/manutencao" class="backButton">
            <i class="fa-solid fa-arrow-left-long" style="float: left; margin-top: 43%;"></i>
        </a>
    </div>
    <div class="col-10">
        <h1>Receitas</h1>
    </div>
</div>
<div class="contentDiv">
    <div class="flex-row">
        <a href="novos/receita">
            <button type="button" class="newButton" data-target="#modalCadProduto">
                + Nova Receita
            </button>
        </a>
    </div>
    
    <br>
    <br>
    <div class="flex-row">
        <?php
            if ($_POST && ($_POST['pesquisa'] != NULL)) {
                $pesquisa = trim($_POST['pesquisa']);
                ?>
                <table class="table-striped table85Length">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p>Id. Receita</p>
                            </th>
                            <th scope="col">
                                <p>Receita</p>
                            </th>
                            <th scope="col">
                                <p>Categoria</p>
                            </th>
                            <th scope="col">
                                <p>Tempo de Preparo</p>
                            </th>
                            <th scope="col">
                                <p>Opções</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "select r.idReceita id, r.nome nome, c.nome categoria, r.tempo tempo from receitaparametrizacao r
                                inner join categoria c on (r.idCategoria = c.idCategoria)
                                where nome LIKE %$pesquisa%order by id desc";
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
                                        <p><?= $dados->tempo ?></p>
                                    </td>
                                    <td>

                                        <a href="javascript:excluir(<?=$dados->id?>)" title="Excluir"
                                        class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <a href="editar/receita/<?=$dados->id?>" class="btn btn-success btn-sm">
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
            } else {
                ?>
                <div class="card">

                    <table class="table-striped table85Length">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <p>Id. Receita</p>
                                </th>
                                <th scope="col">
                                    <p>Receita</p>
                                </th>
                                <th scope="col">
                                    <p>Categoria</p>
                                </th>
                                <th scope="col">
                                    <p>Tempo de Preparo</p>
                                </th>
                                <th scope="col">
                                    <p>Opções</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "select r.idReceita id, r.nome nome, c.nome categoria, r.tempo tempo from receitaparametrizacao r
                                    inner join categoria c on (r.idCategoria = c.idCategoria)
                                    order by id desc";
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
                                            <p><?= $dados->tempo ?></p>
                                        </td>
                                        <td>
    
                                            <a href="javascript:excluir(<?=$dados->id?>)" title="Excluir"
                                            class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
    
                                            <a href="editar/receita/<?=$dados->id?>" class="btn btn-success btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
    
                                        </td>
                                    </tr>
                                <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
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
                location.href = "excluir/receitaParametrizacao/" + id;
            }
        })
    }
    $(document).ready(function(){
        $(".table85Length").DataTable({
            "pageLength": 10,
            "bLengthChange" : false,
            "info":false, 
            "order": [[0, 'desc']],
            language: {
            "emptyTable": "Nenhum registro encontrado",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "loadingRecords": "Carregando...",
            "zeroRecords": "Nenhum registro encontrado",
            "search": "Pesquisar",
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