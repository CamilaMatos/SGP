<?php
include './Estoque/Estoque.php';

if ($_POST && ($_POST['nome'] != '')) {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $status = trim($_POST['status']);

    $Um = new Estoque($nome, $descricao, $status);

    if (!$Um->cadastrarEstoque()) {
        echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
    } else {
        echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
    }
}
?>

<div class="col-12 pageHeader" style="display: flex">
    <div class="col-2">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="float: left"></i></button>
    </div>
    <div class="col-8">
        <h1>Estoques</h1>
    </div>
</div>

<button type="button" class="newButton" data-toggle="modal" data-target="#modalCadProduto">
    + Novo Estoque
</button>

<div class="flex-row">
    <table class="table-striped">
        <thead>
            <tr>
                <th scope="col">
                    <p>Id. Estoque</p>
                </th>
                <th scope="col">
                    <p>Estoque</p>
                </th>
                <th scope="col">
                    <p>Descrição</p>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from estoque order by idEstoque desc limit 10";
            $consulta =  $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>
                <tr>
                    <th scope="row">
                        <p><?= $dados->idEstoque ?></p>
                    </th>
                    <td>
                        <p><?= $dados->nome ?></p>
                    </td>
                    <td>
                        <p><?= $dados->descricao ?></p>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<br>
<br>

<div class="modal fade" id="modalCadProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Estoque</h1>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="formNewProd">
                    <div class="form-row">

                        <div class="formCol">
                            <label for="nome" class="formLabel">Estoque:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome" class="formInput" required>
                        </div>

                        <div class="formCol">
                            <label for="descricao" class="formLabel">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" placeholder="Descrição" class="formInput" required>
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
        <button type="submit" class="formSubmitButton">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>