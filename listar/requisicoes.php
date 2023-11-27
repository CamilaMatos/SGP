
<div class="contentDiv">
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
                        $sql = "select s.idSolicitacao numero, e.nome origem, cc.nome destino, t.nome tipo, s.data abertura, s.necessidade limite,
                            st.nome as status from solicitacao s
                            inner join centrocusto cc on s.idCentroCusto = cc.idCentroCusto
                            inner join estoque e on s.origem = e.idEstoque
                            inner join tipo t on s.idTipo = t.idTipo
                            inner join status st on s.idStatus = st.idStatus where s.idTipo = 2 and s.idStatus = 9 order by numero";
            
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
                                        
                                        <a href="cadastrar/baixarRequisicao/<?=$dados->numero?>" class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
    
                                        <a href="javascript:recusar(<?=$dados->numero?>)" title="Recusar"
                                        class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-ban"></i>
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
    function recusar(id) {
        Swal.fire({
            icon: "warning",
            title: "Você deseja mesmo excluir este registro?",
            showCancelButton: true,
            confirmButtonText: "Excluir",
            cancelButtonText: "Cancelar",
        }).then((result)=>{
            if (result.isConfirmed) {
                location.href = "cadastrar/recusar/" + id;
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