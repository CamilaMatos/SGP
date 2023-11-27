<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <button type="button" onclick="history.back()" class="backButton"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-10">
        <h1>Usuários</h1>
    </div>
</div>
<!--Botão de ativação da Modal-->
<div class="contentDiv">

    <button type="button" class="newButton" data-toggle="modal" data-target="#modalCadUsuario">
        Adicionar Usuário
    </button>

    <br>
    <br>

    <div class="flex-row">
        <table class="table table-striped table70Length">
            <thead>
                <tr>
                    <th scope="col">
                        <p>Id. Colaborador</p>
                    </th>
                    <th scope="col">
                        <p>Colaborador</p>
                    </th>
                    <th scope="col">
                        <p>Nascimento</p>
                    </th>
                    <th scope="col">
                        <p>Documento</p>
                    </th>
                    <th scope="col">
                        <p>Tipo</p>
                    </th>
                    <th scope="col">
                        <p>Login</p>
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
                    $sql = "select u.idUsuario, u.nome, u.dataNasc, u.documento, t.nome cargo, u.login, s.nome status from usuario u
                        inner join status s on (u.idStatus = s.idStatus) 
                        inner join tipo t on (u.idTipo = t.idTipo) order by u.nome";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?>
                        <tr>
                            <th scope="row">
                                <p><?= $dados->idUsuario ?></p>
                            </th>
                            <td>
                                <p><?= $dados->nome ?></p>
                            </td>
                            <td>
                                <p><?= $dados->dataNasc ?></p>
                            </td>
                            <td>
                                <p><?= $dados->documento ?></p>
                            </td>
                            <td>
                                <p><?= $dados->cargo ?></p>
                            </td>
                            <td>
                                <p><?= $dados->login ?></p>
                            </td>
                            <td>
                                <p><?= $dados-> status?></p>
                            </td>
                            <td>
                                
                                <a href="editar/usuario/<?=$dados->idUsuario?>" class="btn btn-success btn-sm">
                                <i class="fas fa-edit"></i>
                                </a>

                                <a href="javascript:desativar(<?=$dados->idUsuario?>)" title="Recusar"
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

<!--Código da Modal -->
<div class="modal fade" id="modalCadUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Usuário</h1>
        </div>
        <div class="modal-body">
            <form action="cadastrar/usuario" method="post">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="nome" class="formLabel">Nome:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" class="formInput" required>
                        </div>
                        <div class="formCol">
                            <label for="nascimento" class="formSelectLabel">Data de Nascimento:</label>
                            <input type="date" name="nascimento" id="nascimento" class="formInput" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="cpf" class="formLabel">CPF:</label>
                            <input type="text" name="cpf" id="cpf" placeholder="CPF" class="formInput" required>
                        </div>
                        <div class="formCol">
                            <label for="tipo" class="formSelectLabel">Tipo do Funcionario: </label>
                            <select name="tipo" id="tipo" class="formInput" required>
                                <option value="">Selecione um tipo...</option>
                                <?php
                                $sql = "select * from tipo order by idTipo";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                ?>
                                    <option value="<?= $dados->idTipo ?>"><?= $dados->nome ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="login" class="formLabel">Login:</label>
                            <input type="text" name="login" id="login" placeholder="Login" class="formInput" required>
                        </div>
                        <div class="formCol">
                            <label for="senha" class="formLabel">Senha:</label>
                            <input type="text" name="senha" id="senha" placeholder="Senha" class="formInput" required>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="submitCol">
                        <button type="submit" class="formSubmitButton">Cadastrar Usuário</button>
                    </div>
                </div>
            </form>
            <br>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
    function desativar(id) {
        Swal.fire({
            icon: "warning",
            title: "Você deseja mesmo excluir este registro?",
            showCancelButton: true,
            confirmButtonText: "Excluir",
            cancelButtonText: "Cancelar",
        }).then((result)=>{
            if (result.isConfirmed) {
                location.href = "cadastrar/statusFuncionario/" + id;
            }
        })
    }
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })
    $(document).ready(function(){
        $(".table70Length").DataTable({
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