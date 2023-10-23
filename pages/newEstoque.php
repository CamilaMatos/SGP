<?php
include './Estoque/Estoque.php';

if ($_POST && ($_POST['nome'] != '')) {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $status = trim($_POST['status']);

    $Um = new Estoque(NULL, $nome, $descricao, $status);

    if (!$Um->cadastrarEstoque()) {
        echo "<script>alert('Cadastro não pode ser realizado por que algo deu errado!!!');</script>";
    } else {
        echo "<script>alert('Cadastro realizado com sucesso!!!');</script>";
    }
}
?>
<div>

</div>
<form action="" method="post">
    <div class="formNewProd">
        <input type="text" name="nome" id="nome" placeholder="Nome do novo Estoque" required>
        <input type="text" name="descricao" id="descricao" placeholder="Descrição novo Estoque" required>
        <select name="status" id="status">
            <option value="">Selecione um status</option>
            <?php
            $sql = "select * from status order by nome";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>
                <option value="<?= $dados->idStatus ?>"><?= $dados->nome ?></option>
            <?php
            }
            ?>
        </select>
        <button type="submit">
            Cadastrar
        </button>
    </div>
</form>

<br>
<br>

<table>
    <thead>
        <tr>
            <td>
                <p>Id. Estoque</p>
            </td>
            <td>
                <p>Estoque</p>
            </td>
            <td>
                <p>Descrição</p>
            </td>
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
                <td>
                    <p><?= $dados->idEstoque ?></p>
                </td>
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

<br>
<br>