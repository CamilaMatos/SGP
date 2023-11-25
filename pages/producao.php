<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <button type="button" onclick="history.back()" class="backButton"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-10">
        <h1>Produção</h1>
    </div>
</div>

<div class="contentDiv">
    <div class="flex-row">
        <table class="table table-striped table70Length">
            <thead>
                <tr>
                    <th>
                        <p>Produto</p>
                    </th>
                    <th>
                        <p>Qtd.</p>
                    </th>
                    <th>
                        <p>Un. Medida</p>
                    </th>
                    <th>
                        <p>Lote</p>
                    </th>
                    <th>
                        <p>Validade</p>
                    </th>
                    <th>
                        <p>Opções</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>Leite</p>
                    </td>
                    <td>
                        <p>3</p>
                    </td>
                    <td>
                        <p>Caixa</p>
                    </td>
                    <td>
                        <p>
                            116
                        </p>
                    </td>
                    <td>
                        <p>26/08/2023</p>
                    </td>
                    <td>
                        <p>Movimentar</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Fermento</p>
                    </td>
                    <td>
                        <p>1</p>
                    </td>
                    <td>
                        <p>Pote</p>
                    </td>
                    <td>
                        <p>120</p>
                    </td>
                    <td>
                        <p>02/09/2023</p>
                    </td>
                    <td>
                        <p>Movimentar</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Milho</p>
                    </td>
                    <td>
                        <p>3</p>
                    </td>
                    <td>
                        <p>Lata</p>
                    </td>
                    <td>
                        <p>123</p>
                    </td>
                    <td>
                        <p>29/09/2023</p>
                    </td>
                    <td>
                        <p>Movimentar</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="optionScroll">
            <a href="listar/ordensServico">
                <div class="scrollOption">
                    <p>Ordens de Serviço</p>
                </div>
            </a>
            <div class="flex-row">
                <div class="optionBorder"></div>
            </div>
            <a href="listar/receitas">
                <div class="scrollOption">
                    <p>Receitas</p>           
                </div>
            </a>
            <!-- <div class="flex-row">
                <div class="optionBorder"></div>
            </div>
            <a href="listar/solicitacoes">
                <div class="scrollOption">
                    <p>Solicitações</p>
                </div>
            </a> -->
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