<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <button type="button" onclick="history.back()" class="backButton "><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
        
    </div>
    <div class="col-10">
        <h1>Estoque</h1>
    </div>
</div>
<div class="contentDiv">
    <div class="flex-row">
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
                    $sql = "select l.idLote, i.nome, l.quantidadeAtual, un.nome unMedida, l.validade from lote l
                        inner join item i on (l.idItem = i.idItem)
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
                                    <?=$dados->quantidadeAtual?>
                                </td>
                                <td>
                                    <?=$dados->unMedida?>
                                </td>
                                <td>
                                    <?=$dados->validade?>
                                </td>
                                <td>
                                    Opção
                                </td>
                            </tr>
                        <?php
                    };
                ?>
            </tbody>
        </table>
        <div class="optionScroll">
            <a href="listar/produtos">
                <div class="scrollOption">
                    <p>Produtos</p>
                </div>
            </a>
            <div class="flex-row">
                <div class="optionBorder"></div>
            </div>
            <a href="listar/movimentacoes">
                <div class="scrollOption">
                    <p>Movimentações</p>           
                </div>
            </a>
            <div class="flex-row">
                <div class="optionBorder"></div>
            </div>
            <a href="listar/solicitacoes">
                <div class="scrollOption">
                    <p>Solicitações</p>
                </div>
            </a>
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