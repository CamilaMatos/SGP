<?php
    require "./configs/functions.php";
?>
<div class="col-12 pageHeader" style="display: flex">
    <div class="col-2">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-8">
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
                Solicitar Transferência
            </button>
        </a>
    </div>
    <br>
    <br>
    <div class="flex-row">
        <table class="table-striped table70Length">
            <thead>
                <tr>
                    <th>
                        Número
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
                    $sql = "select s.idSolicitacao numero, cc.nome destino, t.nome tipo, s.data abertura, s.necessidade limite,
                        st.nome as status from solicitacao s
                        inner join centrocusto cc on s.idCentroCusto = cc.idCentroCusto
                        inner join tipo t on s.idTipo = t.idTipo
                        inner join status st on s.idStatus = st.idStatus order by numero desc limit 15";
        
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                            <tr>
                                <td>
                                    <?=$dados->numero?>
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
    
                                    <a href="editar/requisicao/<?=$dados->numero?>">
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
                location.href = "excluir/solicitacao/" + id;
            }
        })
    }
</script>
