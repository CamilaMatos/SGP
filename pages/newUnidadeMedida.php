<?php
if ($_POST) {
    $nome = trim($_POST['nome']);
}
?>
<div>

</div>
<form action="" method="post">
    <input type="text" name="nome" id="nome" placeholder="Nova Unidade de Medida">
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
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<br>
<br>
<button>
    Nova Categoria
</button>