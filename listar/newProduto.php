<?php

if ($_POST) {
    include "./Estoque/Item.php";

    $nome =  trim($_POST['nome']);
    $unMedia =  trim($_POST['unMedia']);
    $categoria = trim($_POST['categoria']);
    $marca =  trim($_POST['marca']);
    $unMedida = trim($_POST['unMedida']);
    $Status = 1;
    $P = new Item($nome, $unMedia, $categoria, $marca, $unMedida, $Status);

    if (!$P->cadastrarItem()) {
        echo "<script>alert('Faltam informações para realizar o cadastro!!!!!!');</script>";
    } else {
        echo "<script>alert('Cadastro realizado com sucesso!!!!');</script>";
        echo "<script>location.href='pages/newProduto'</script>";
    }
} else {
?>
    <br>
    <br>
    <h1>Cadastrar Produto</h1>
    <br>
    <br>
    <form action="" method="post">
        <div class="formNewProd">
            <div class="formRow">
                <input type="text" name="id" id="id" placeholder="Id" readonly>
                <input type="text" name="nome" id="nome" placeholder="Nome">
            </div>
            <textarea name="descricao" id="descricao" placeholder="Descrição" class="areaDeTexto">
            </textarea>
            <div class="formRow">
                <select name="marca" id="marca">
                    <option value="">Selecione uma marca</option>
                    <?php
                    $sql = "select * from marca";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?>
                        <option value="<?= $dados->idMarca ?>"><?= $dados->nome ?></option>
                    <?php
                    }
                    ?>
                </select>
                <select name="unMedida" id="unMedida">
                    <option value="">Selecione uma unidade de medida</option>
                    <?php
                    $sql = "select * from unidademedida";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?>
                        <option value="<?= $dados->idUnidadeMedida ?>"><?= $dados->nome ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="text" name="unMedia" id="unMedia" placeholder="Un. Média">
            </div>
            <select name="categoria" id="categoria" class="listinha">
                <option value="">Selecione uma categoria</option>
                <?php
                $sql = "select * from categoria";
                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                ?>
                    <option value=<?= $dados->idCategoria ?>><?= $dados->nome ?></option>
                <?php
                }
                ?>
            </select>
            <div class="formRow">
                <button type="submit">Enviar</button>
            </div>

        </div>
    </form>
<?php
}
?>