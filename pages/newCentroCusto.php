<?php
if ($_POST) {
    $nome = trim($_POST['nome']);
}
?>
<div>

</div>
<form action="" method="post">
    <input type="text" name="nome" id="nome" placeholder="Novo Centro de Custo">
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
<button>
    Nova Categoria
</button>