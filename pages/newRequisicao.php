
<?php

    include "./Estoque/Solicitacao.php";

    if ($_POST) {
        $idTipo = $_POST['tipo'];
        $idCentroCusto = $_POST['centroCusto'];
        $idStatus = $_POST['status'];
        $idSolicitante = $_POST['solicitante'];
        $idEstoque = $_POST['estoque'];
        $data =  $_POST['data'];
        $necessidade = $_POST['necessidade'];

        $R = new Solicitacao (NULL, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $data, $necessidade);
        if($R->solicitarRequisicao()){
            echo "<script>alert('Lote inserido com sucesso!!');</script>";
        } else{
            echo "<script>alert('A inserção do lote falhou, por que algo deu errado!!');</script>";
        }
        
    }
?>


<form action="" method="post">
    <div class="formNewProd">
        <select name="tipo" id="tipo" required>
            <option value="">Selecione um item:</option>
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
        <select name="estoque" id="estoque" required>
            <option value="">Selecione um estoque:</option>
            <?php
                $sql = "select e.idEstoque estoque, e.nome nome from estoque e order by nome";
                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <option value="<?= $dados->estoque ?>"><?= $dados->nome ?></option>
                    <?php
                }
            ?>
        </select>
        <input type="number" name="qtdInicial" id="qtdInicial" placeholder="Insira a quantidade inicial do lote:" required>
        <input type="number" name="qtdAtual" id="qtdAtual" placeholder="Insira a quantidade Atual do lote:" required>
        <input type="date" name="validade" id="validade" required>
        <input type="float" name="vlUnitario" id="vlUnitario" placeholder="Insira o valor de cada unidade:" required>
        <button type="submit">
            Cadastrar
        </button>
    </div>
</form>
<form action="" method="post">
    <div class="formNewProd">

        <select name="tipo" id="tipo" required>
            <option value="">Selecione um item:</option>
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
        <select name="estoque" id="estoque" required>
            <option value="">Selecione um estoque:</option>
            <?php
                $sql = "select e.idEstoque estoque, e.nome nome from estoque e order by nome";
                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <option value="<?= $dados->estoque ?>"><?= $dados->nome ?></option>
                    <?php
                }
                ?>
        </select>
        <input type="number" name="qtdInicial" id="qtdInicial" placeholder="Insira a quantidade inicial do lote:" required>
        <input type="number" name="qtdAtual" id="qtdAtual" placeholder="Insira a quantidade Atual do lote:" required>
        <input type="date" name="validade" id="validade" required>
        <input type="float" name="vlUnitario" id="vlUnitario" placeholder="Insira o valor de cada unidade:" required>
        <button type="submit">
            Cadastrar
        </button>
    </div>
</form>