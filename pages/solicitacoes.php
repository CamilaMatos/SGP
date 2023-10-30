<form>
    <input type="button" value="<-" onclick="history.back()">
</form>

<form action="" method="post">
    <select name="centroOrigem" id="centroOrigem">
        <option value="">Selecione o Centro de Custo de Origem</option>
        <?php
        $sql = "select * from centrocusto order by nome";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <option value="<?= $dados->idCentroCusto ?>"><?= $dados->nome ?></option>
        <?php
        }
        ?>
    </select>
    <select name="centroDestino" id="centroDestino">
        <option value="">Selecione o Centro de Custo de Destino</option>
        <?php
        $sql = "select * from centrocusto order by nome";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <option value="<?= $dados->idCentroCusto ?>"><?= $dados->nome ?></option>
        <?php
        }
        ?>
    </select>
    <input type="text" name="item" id="item" placeholder="Item da Requisição">
    <input type="text" name="qtdDisponivel" id="qtdDisponivel" readonly>
    <input type="text" name="qtdSolicitada" id="qtdSolictada">


</form>