<div class="col-12 pageHeader" style="display: flex">
    <div class="col-1">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-10">
        <h1>Usuários</h1>
    </div>
</div>
<!--Botão de ativação da Modal-->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadUsuario">
    Adicionar Usuário
</button>
<div class="flex-row">
    <table class="table-striped">
        <thead>
            <tr>
                <th>
                    <p>Colaborador</p>
                </th>
                <th>
                    <p>Setor</p>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select u.nome funcionario, t.nome setor from usuario u inner join tipo t on u.idTipo = t.idTipo order by u.nome";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>
                <tr>
                    <td>
                        <p><?= $dados->funcionario ?></p>
                    </td>
                    <td>
                        <p><?= $dados->setor ?></p>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!--Código da Modal -->
<div class="modal fade" id="modalCadUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Usuário</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="nome" class="formLabel">Nome:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="nascimento" class="formSelectLabel">Data de Nascimento:</label>
                            <input type="date" name="nascimento" id="nascimento" class="formInput">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="cpf" class="formLabel">CPF:</label>
                            <input type="text" name="cpf" id="cpf" placeholder="CPF" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="tipo" class="formSelectLabel">Tipo do Funcionario: </label>
                            <select name="tipo" id="tipo" class="formInput">
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
                            <input type="text" name="login" id="login" placeholder="Login" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="senha" class="formLabel">Senha:</label>
                            <input type="text" name="senha" id="senha" placeholder="Senha" class="formInput">
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
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })
</script>