<?php
include './Estoque/UnidadeMedida.php';

if ($_POST && ($_POST['nome'] != '')) {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    $Um = new UnidadeMedida($nome, $descricao);

    if (!$Um->cadastrarUnidadeMedida()) {
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
        <input type="text" name="nome" id="nome" placeholder="Nova Unidade de Medida" required>
        <input type="text" name="descricao" id="descricao" placeholder="Descrição da unidade de Medida" required>
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
                <p>Id. Unidade de Medida</p>
            </td>
            <td>
                <p>Unidade de Medida</p>
            </td>
            <td>
                <p>Descrição</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "select * from unidademedida order by idUnidadeMedida desc limit 10";
        $consulta =  $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <tr>
                <td>
                    <p><?= $dados->idUnidadeMedida ?></p>
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