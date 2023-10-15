<form action="" method="post">
    <select name="item" id="item">
        <option value="">Selecione um item</option>
        <?php
        $sql = "select i.idItem item, i.nome nome from item i order by nome";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <option value="<?= $dados->item ?>"><?= $dados->nome ?></option>
        <?php
        }
        ?>
    </select>
    <input type="date" name="fabricacao" id="fabricacao">
    <input type="date" name="validade" id="validade">
    <input type="text" name="lote" id="lote">
</form>