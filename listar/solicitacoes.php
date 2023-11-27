<?php
    require "./configs/functions.php";
?>
<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <a href="pages/estoque" class="backButton">
            <i class="fa-solid fa-arrow-left-long" style="float: left; margin-top: 43%;"></i>
        </a>
    </div>
    <div class="col-10">
        <h1>Solicitações</h1>
    </div>
</div>
<div class="contentDiv">

    <div class="flex-row">
        <a href="novos/requisicao">
            <button type="button" class="newButton">
                + Nova Requisição
            </button>
        </a>
        
        <a href="novos/transferencia">
            <button type="button" class="newButton">
                + Solicitar Transferência
            </button>
        </a>
    </div>
    <br>
    <br>
    <div class="flex-row">
        <div class="card">
            <h1>Requisições</h1>
            <table class="table table-striped table85Length">
                <thead>
                    <tr>
                        <th scope="col">
                            Número
                        </th>
                        <th scope="col">
                            Origem
                        </th>
                        <th scope="col">
                            Destino
                        </th>
                        <th scope="col">
                            Tipo
                        </th>
                        <th scope="col">
                            Data de abertura
                        </th>
                        <th scope="col">
                            Data Limite
                        </th>
                        <th scope="col">
                            Status
                        </th>
                        <th scope="col">
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $solicitante = $_SESSION['idUsuario'];
                        $sql = "select s.idSolicitacao numero, e.nome origem, cc.nome destino, t.nome tipo, s.data abertura, s.necessidade limite,
                            st.nome as status from solicitacao s
                            inner join centrocusto cc on s.idCentroCusto = cc.idCentroCusto
                            inner join estoque e on s.origem = e.idEstoque
                            inner join tipo t on s.idTipo = t.idTipo
                            inner join status st on s.idStatus = st.idStatus where s.idTipo = 2  and s.idSolicitante = $solicitante order by numero";
            
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                        while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                            ?>
                                <tr>
                                    <td>
                                        <?=$dados->numero?>
                                    </td>
                                    <td>
                                        <?=$dados->origem?>
                                    </td>
                                    <td>
                                        <?=$dados->destino?>
                                    </td>
                                    <td>
                                        <?=$dados->tipo?>
                                    </td>
                                    <td>
                                        <?=$dados->abertura?>
                                    </td>
                                    <td>
                                        <?=$dados->limite?>
                                    </td>
                                    <td>
                                        <?=$dados->status?>
                                    </td>
                                    <td>
                                        <a href="javascript:excluir(<?=$dados->numero?>)" title="Excluir"
                                        class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
        
                                        <a href="editar/requisicao/<?=$dados->numero?>" class="btn btn-success btn-sm">
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
    </div>
    <br>
    <br>
    <div class="flex-row">
        <div class="card">
            <h1>Transferências</h1>
            <table class="table table-striped table85Length">
                <thead>
                    <tr>
                        <th>
                            Número
                        </th>
                        <th>
                            Origem
                        </th>
                        <th>
                            Destino
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Data de abertura
                        </th>
                        <th>
                            Data Limite
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "select s.idSolicitacao numero, e1.nome origem, e.nome destino, t.nome tipo, s.data abertura, s.necessidade limite,
                            st.nome as status from solicitacao s
                            inner join estoque e on s.idEstoque = e.idEstoque
                            inner join estoque e1 on s.origem = e1.idEstoque
                            inner join tipo t on s.idTipo = t.idTipo
                            inner join status st on s.idStatus = st.idStatus where s.idTipo = 3 and s.idSolicitante = $solicitante order by numero";
            
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                        while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                            ?>
                                <tr>
                                    <td>
                                        <?=$dados->numero?>
                                    </td>
                                    <td>
                                        <?=$dados->origem?>
                                    </td>
                                    <td>
                                        <?=$dados->destino?>
                                    </td>
                                    <td>
                                        <?=$dados->tipo?>
                                    </td>
                                    <td>
                                        <?=$dados->abertura?>
                                    </td>
                                    <td>
                                        <?=$dados->limite?>
                                    </td>
                                    <td>
                                        <?=$dados->status?>
                                    </td>
                                    <td>
                                        <a href="javascript:excluir(<?=$dados->numero?>)" title="Excluir"
                                        class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
        
                                        <a href="editar/transferencia/<?=$dados->numero?>" class="btn btn-success btn-sm">
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
    </div>
</div>

<script>
    function excluir(id) {
        Swal.fire({
            icon: "warning",
            title: "Você deseja mesmo recusar essa requisição?",
            showCancelButton: true,
            confirmButtonText: "Recusar",
            cancelButtonText: "Cancelar",
        }).then((result)=>{
            if (result.isConfirmed) {
                location.href = "excluir/solicitacao/" + id;
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