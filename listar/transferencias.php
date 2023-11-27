<div class="contentDiv">

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
                            inner join status st on s.idStatus = st.idStatus where s.idTipo = 3  and s.idStatus = 9 order by numero";
            
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
                                        
                                        <a href="cadastrar/baixarTransferencia/<?=$dados->numero?>" class="btn btn-success btn-sm">
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
            title: "Você deseja mesmo recusar essa transferência?",
            showCancelButton: true,
            confirmButtonText: "Recusar",
            cancelButtonText: "Cancelar",
        }).then((result)=>{
            if (result.isConfirmed) {
                location.href = "cadastrar/recusarTransferencia/" + id;
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