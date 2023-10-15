<table>
    <thead>
        <tr>
            <td>
                <p>Colaborador</p>
            </td>
            <td>
                <p>Setor</p>
            </td>
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