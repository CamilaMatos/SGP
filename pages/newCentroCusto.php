<?php
include './Estoque/CentroCusto.php';

if ($_POST && ($_POST['nome'] != '')) {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $status = trim($_POST['status']);

    $Um = new CentroCusto(NULL, $nome, $descricao, $status);

    if (!$Um->cadastrarCentroCusto()) {
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
        <input type="text" name="nome" id="nome" placeholder="Novo Centro de Custo" required>
        <input type="text" name="descricao" id="descricao" placeholder="Descricao do Centro de Custo" required>
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
                <p>Id. Centro de Custo</p>
            </td>
            <td>
                <p>Centro de Custo</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "select * from centrocusto order by idCentroCusto desc limit 10";
        $consulta =  $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <tr>
                <td>
                    <p><?= $dados->idCentroCusto ?></p>
                </td>
                <td>
                    <p><?= $dados->nome ?></p>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<br>
<br>