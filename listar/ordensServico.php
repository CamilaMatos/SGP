
<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <a href="pages/producao" class="backButton">
            <i class="fa-solid fa-arrow-left-long" style="float: left; margin-top: 43%;"></i>
        </a>
    </div>
    <div class="col-10">
        <h1>Ordens de Serviço</h1>
    </div>
</div>

<div class="contentDiv">

    <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
        Nova Ordem de Serviço
    </button>

    <br>
    <br>
    
    <div class="flex-row">
        <div class="card">

            <table class="table table-striped table85Length">
                <thead>
                    <tr>
                        <th scope="col">
                            <p>Id. Ordem</p>
                        </th>
                        <th scope="col">
                            <p>Receita</p>
                        </th>
                        <th scope="col">
                            <p>Data de entrega</p>
                        </th>
                        <th scope="col">
                            <p>Rendimento Esperado</p>
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
                        $sql = "select os.idOrdemServico id, r.nome receita, os.entrega entrega, os.rendimentoEsperado rEsperado, s.nome status, s.idStatus idS from ordemservico os
                        inner join receitaparametrizacao r on (r.idReceita = os.idReceita) 
                        inner join status s on (s.idStatus = os.idStatus)";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?>
                        <tr>
                            <th scope="row">
                                <p><?= $dados->id ?></p>
                            </th>
                            <td>
                                <p><?= $dados->receita ?></p>
                            </td>
                            <td>
                                <p><?= $dados->entrega ?></p>
                            </td>
                            <td>
                                <p><?= $dados->rEsperado ?></p>
                            </td>
                            <td>
                                <p><?= $dados->status ?></p>
                            </td>
                            <td>
                                <?php
                                    if($dados->idS == 3){
    
                                        ?>
                                            <a href="cadastrar/separar/<?=$dados->id?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
    
                                            <a href="javascript:cancelar(<?=$dados->id?>)" title="Excluir"
                                            class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php
    
    
                                    }if($dados->idS == 7){
                                        ?>
                                            <a href="cadastrar/produzir/<?=$dados->id?>" class="btn btn-danger btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:cancelar(<?=$dados->id?>)" title="Excluir"
                                            class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php
    
                                    }if($dados->idS == 11){
    
                                        ?>
                                            <a href="cadastrar/finalizar/<?=$dados->id?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                    </a>
                                            
                                        <?php
    
                                    }
                                
                                ?>
                                
    
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
$OS = new OdermServiço(idReceita, idUsuario, entrega, rendimentoEsperado, NULL, observacao, null, null, null);//rendimentoReal pode ser null, só é necessário informar no se for estanciar para concluir a OS
$OS->gerarOS(idCentroCusto, idEstoque);//idCentroCusto é para onde vai o custo da OS, idEstoque é da onde sai os ingredientes



<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Ordem de Serviço</h1>
            </div>
            <div class="modal-body">
                <form action="cadastrar/ordemServico" method="post" id="formOrdemServico">
                    <div class="formNewProd">
                        <div class="form-row">
                            <div class="formCol">
                                <label for="idReceita" class="formLabel">Receita:</label>
                                <select name="idReceita" id="idReceita" class="formInput">
                                    <option value="">Selecione uma receita...</option>
                                    <?php
                                    $sql = "select r.idReceita, r.nome from receitaparametrizacao r where nome <> ''";
                                    $consulta = $pdo->prepare($sql);
                                    $consulta->execute();
                                    while ($dadosRec = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <option value="<?= $dadosRec->idReceita ?>"><?= $dadosRec->nome ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="idUsuario" id="idUsuario" value="<?=$_SESSION['idUsuario']?>">
                            </div>
                            <div class="formCol">
                                <label for="entrega" class="formLabel">Data de Entrega:</label>
                                <input type="date" name="entrega" id="entrega" class="formInput">
                            </div>
                            <div class="formCol">
                                <label for="rendimentoEsperado" class="formLabel">Rendimento Esperado:</label>
                                <input type="number" name="rendimentoEsperado" id="rendimentoEsperado" class="formInput">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="formCol">
                                <label for="idEstoque" class="formLabel">Estoque de Origem:</label>
                                <select name="idEstoque" id="idEstoque" class="formInput">
                                    <option value="">Selecione uma receita...</option>
                                    <?php
                                    $sql = "select * from estoque";
                                    $consulta = $pdo->prepare($sql);
                                    $consulta->execute();
                                    while ($dadosEst = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <option value="<?= $dadosEst->idEstoque ?>"><?= $dadosEst->nome ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="idCentroCusto" class="formLabel">Centro de Custo:</label>
                                <select name="idCentroCusto" id="idCentroCusto" class="formInput">
                                    <option value="">Selecione uma receita...</option>
                                    <?php
                                    $sql = "select * from centrocusto";
                                    $consulta = $pdo->prepare($sql);
                                    $consulta->execute();
                                    while ($dadosCC = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <option value="<?= $dadosCC->idCentroCusto ?>"><?= $dadosCC->nome ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                                
                            <label for="observacao">Modo de Preparo</label>
                            <textarea name="observacao" id="observacao" class="form-control" rows="5"></textarea>
                                
                        </div>
                    </div>
                </form>
                <br>
            </div>
            <div class="modal-footer">
                <button type="submit" class="formSubmitButton" form="formOrdemServico">Enviar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEndOrdem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Finalizar Ordem de serviço</h1>
            </div>
            <div class="modal-body">
                <form action="cadastrar/finalizar/<?=$dados->id?>" method="post" id="formOrdemServico">
                    <div class="formNewProd">
                        <div class="form-row">
                            <div class="formCol">
                                <label for="idEstoque" class="formLabel">Estoque de Origem:</label>
                                <select name="idEstoque" id="idEstoque" class="formInput">
                                    <option value="">Selecione uma receita...</option>
                                    <?php
                                    $sql = "select * from estoque";
                                    $consulta = $pdo->prepare($sql);
                                    $consulta->execute();
                                    while ($dadosEst = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <option value="<?= $dadosEst->idEstoque ?>"><?= $dadosEst->nome ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="validade" class="formLabel">Validade:</label>
                                <input type="date" name="validade" id="validade" >
                            </div>
                        </div>
                    </div>
                </form>
                <br>
            </div>
            <div class="modal-footer">
                <button type="submit" class="formSubmitButton" form="formOrdemServico">Enviar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function cancelar(id) {
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