<?php
include './Estoque/Categoria.php';

if ($_POST && ($_POST['nome'] != '')) {
    $nome = trim($_POST['nome']);

    $Um = new Categoria($nome);

    if (!$Um->cadastrarCategoria()) {
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
        <input type="text" name="nome" id="nome" placeholder="Nova Categoria" required>
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
                <p>Id. Categoria</p>
            </td>
            <td>
                <p>Categoria</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "select * from categoria order by idCategoria desc limit 10";
        $consulta =  $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <tr>
                <td>
                    <p><?= $dados->idCategoria ?></p>
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