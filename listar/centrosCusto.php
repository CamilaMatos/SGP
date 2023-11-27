<div class="col-12 pageHeader" style="display: flex">
<div class="col-1">
        <a href="pages/manutencao" class="backButton">
            <i class="fa-solid fa-arrow-left-long" style="float: left; margin-top: 43%;"></i>
        </a>
    </div>
    <div class="col-10">
        <h1>Centros de Custo</h1>
    </div>
</div>

<div class="contentDiv">

    <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
        + Novo Centro de Custo
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
                        $sql = "select * from marca where nome LIKE '%$pesquisa%' order by idMarca";
                        $consulta =  $pdo->prepare($sql);
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <p><?= $dados->idMarca ?></p>
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
                <div class="card">

                    <table class="table table-striped table70Length">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <p>Id. Centro de Custo</p>
                                </th>
                                <th scope="col">
                                    <p>Centro de Custo</p>
                                </th>
                                <th scope="col">
                                    <p>Descrição</p>
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
                            $sql = "select cc.*,s.nome status from centrocusto cc
                                inner join status s on (cc.idStatus = s.idStatus) order by idCentroCusto";
                            $consulta =  $pdo->prepare($sql);
                            $consulta->execute();
                            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                            ?>
                                <tr>
                                    <th scope="row">
                                        <p><?= $dados->idCentroCusto ?></p>
                                    </th>
                                    <td>
                                        <p><?= $dados->nome ?></p>
                                    </td>
                                    <td>
                                        <p><?= $dados->descricao ?></p>
                                    </td>
                                    <td>
                                        <p><?= $dados->status ?></p>
                                    </td>
                                    <td>
    
                                        <a href="javascript:excluir(<?=$dados->idCentroCusto?>)" title="Excluir"
                                        class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
    
                                        <a href="editar/centroCusto/<?=$dados->idCentroCusto?>" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
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
            <form action="cadastrar/centroCusto" method="post" id="formCentroCusto">
                <div class="formNewProd">
                    <div class="form-row">

                        <div class="formCol">
                            <label for="nome" class="formLabel">Centro de Custo:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="descricao" class="formLabel">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" placeholder="Descrição" class="formInput">
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
        <button type="submit" class="formSubmitButton" form="formCentroCusto">Enviar</button>
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
                location.href = "excluir/centroCusto/" + id;
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