<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <button type="button" onclick="history.back()" class="backButton"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-10">
        <h1>Entradas</h1>
    </div>
</div>


<div class="contentDiv">
    <div class="flex-row">
        <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
            + Nova Entrada
        </button>
    </div>
    <br>
    <br>
    <div class="flex-row">
        <div class="card">

            <table class="table table-striped table70Length">
                <thead>
                    <tr>
                        <th scope="row">
                            <p>Lote</p>
                        </th>
                        <th scope="row">
                            <p>Produto</p>
                        </th>
                        <th scope="row">
                            <p>Estoque</p>
                        </th>
                        <th scope="row">
                            <p>Qtd. Restante</p>
                        </th>
                        <th scope="row">
                            <p>Un.Medida</p>
                        </th>
                        <th scope="row">
                            <p>Validade</p>
                        </th>
                        <th scope="row">
                            <p>Opções</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "select l.idLote, i.nome, e.nome estoque, l.quantidadeAtual, un.nome unMedida, l.validade from lote l
                            inner join item i on (l.idItem = i.idItem)
                            inner join estoque e on (l.idEstoque = e.idEstoque)
                            inner join unidademedida un on (i.idUnidadeMedida = un.idUnidadeMedida) order by l.validade";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                        while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                            ?>
                                <tr>
                                    <th scope="row">
                                        <?=$dados->idLote?>
                                    </th>
                                    <td>
                                        <?=$dados->nome?>
                                    </td>
                                    <td>
                                        <?=$dados->estoque?>
                                    </td>
                                    <td>
                                        <?=$dados->quantidadeAtual?>
                                    </td>
                                    <td>
                                        <?=$dados->unMedida?>
                                    </td>
                                    <td>
                                        <?=$dados->validade?>
                                    </td>
                                    <td>
    
                                        <a href="javascript:excluir(<?=$dados->idLote?>)" title="Excluir"
                                        class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
    
                                        <a href="editar/entrada/<?=$dados->idLote?>" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    
    
                                    </td>
                                </tr>
                            <?php
                        };
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Entrada</h1>
            </div>
            <div class="modal-body">
                <form action="cadastrar/entrada" method="post"  id="formEntrada">
                    <div class="formNewProd">
                        <div class="form-row">
                            <div class="formCol">
                                <label for="item" class="formLabel">Produto:</label>
                                <select name="item" id="item" required class="formInput">
                                    <option value="">Selecione um item:</option>
                                    <?php
                                        $sql = "select i.idItem item, i.nome nome from item i order by nome";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();
                                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                        ?>
                                            <option value="<?= $dados->item ?>"><?= $dados->nome ?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="estoque" class="formLabel">Estoque:</label>
                                <select name="estoque" id="estoque" required class="formInput">
                                    <option value="">Selecione um estoque:</option>
                                    <?php
                                        $sql = "select e.idEstoque estoque, e.nome nome from estoque e order by nome";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();
                                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                        ?>
                                            <option value="<?= $dados->estoque ?>"><?= $dados->nome ?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="formCol">
                                <label for="qtdInicial" class="formLabel">Quantidade Inicial:</label>
                                <input type="number" name="qtdInicial" id="qtdInicial" placeholder="Insira a quantidade inicial do lote:" required class="formInput">
                            </div>
                            <div class="formCol">
                                <label for="qtdAtual" class="formLabel">Quantidade Atual:</label>
                                <input type="number" name="qtdAtual" id="qtdAtual" placeholder="Insira a quantidade Atual do lote:" required class="formInput">
                            </div>           
                        </div>
                        <div class="form-row">
                            <div class="formCol">
                                <label for="validade" class="formLabel">Data de Validade:</label>
                                <input type="date" name="validade" id="validade" required class="formInput">
                            </div>
                            <div class="formCol">
                                <label for="vlUnitario" class="formLabel">Valor Unitário:</label>
                                <input type="float" name="vlUnitario" id="vlUnitario" placeholder="Insira o valor de cada unidade:" required class="formInput">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="submitCol" >
                    <button type="submit" class="formSubmitButton" form="formEntrada">Cadastrar</button>
                </div>
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
                location.href = "excluir/entrada/" + id;
            }
        })
    }
    $(document).ready(function(){
        $(".table").DataTable({
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