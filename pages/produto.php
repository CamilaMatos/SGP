<h1>Produto</h1>
<br>
<br>
<form action="" method="post">
    <input type="text" name="pesquisa" id="pesquisa" placeholder="Ex. Arroz" class="searchBar">
    <button type="submit">Pesquisar</button>
</form>
<br>
<br>
<?php
if ($_POST && ($_POST['pesquisa'] != NULL)) {
?>

    <table>
        <thead>
            <tr>
                <td>
                    <p>Id. Produto</p>
                </td>
                <td>
                    <p>Produto</p>
                </td>
                <td>
                    <p>Categoria</p>
                </td>
                <td>
                    <p>Marca</p>
                </td>
                <td>
                    <p>Unidade de Medida</p>
                </td>
                <td>
                    <p>Status</p>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $pesquisa = trim($_POST['pesquisa']);
            $sql = "select i.idItem id, i.nome nome, c.nome categoria, m.nome marca, uM.nome unidadeMedida, s.nome status from item i
            inner join categoria c
            on i.idcategoria = c.idCategoria 
            inner join marca m
            on i.idMarca = m.idmarca
            inner join unidadeMedida uM
            on i.idUnidadeMedida = uM.idUnidadeMedida
            inner join status s
            on i.idStatus = s.idStatus
            where i.nome like '%$pesquisa%'
            order by idItem ";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>
                <tr>
                    <td>
                        <p><?= $dados->id ?></p>
                    </td>
                    <td>
                        <p><?= $dados->nome ?></p>
                    </td>
                    <td>
                        <p><?= $dados->categoria ?></p>
                    </td>
                    <td>
                        <p><?= $dados->marca ?></p>
                    </td>
                    <td>
                        <p><?= $dados->unidadeMedida ?></p>
                    </td>
                    <td>
                        <p><?= $dados->status ?></p>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
?>
<br>
<br>
<h1>
    Ultimos adicionados
</h1>
<table>
    <thead>
        <tr>
            <td>
                <p>Id. Produto</p>
            </td>
            <td>
                <p>Produto</p>
            </td>
            <td>
                <p>Categoria</p>
            </td>
            <td>
                <p>Marca</p>
            </td>
            <td>
                <p>Unidade de Medida</p>
            </td>
            <td>
                <p>Status</p>
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "select i.idItem id, i.nome nome, c.nome categoria, m.nome marca, uM.nome unidadeMedida, s.nome status from item i
            inner join categoria c
            on i.idcategoria = c.idCategoria 
            inner join marca m
            on i.idMarca = m.idmarca
            inner join unidadeMedida uM
            on i.idUnidadeMedida = uM.idUnidadeMedida
            inner join status s
            on i.idStatus = s.idStatus
            order by idItem desc limit 15";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <tr>
                <td>
                    <p><?= $dados->id ?></p>
                </td>
                <td>
                    <p><?= $dados->nome ?></p>
                </td>
                <td>
                    <p><?= $dados->categoria ?></p>
                </td>
                <td>
                    <p><?= $dados->marca ?></p>
                </td>
                <td>
                    <p><?= $dados->unidadeMedida ?></p>
                </td>
                <td>
                    <p><?= $dados->status ?></p>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>