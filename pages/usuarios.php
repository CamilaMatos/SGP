<?php

include "./Estoque/Usuario.php";

if ($_POST) {
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];
    $login = $_POST['login'];
    $senha =  $_POST['senha'];
    $Ul = new Usuario($nome, $nascimento, $cpf, $tipo, $login, $senha);
    $Ul->cadastrarUsuario();
    print_r($Ul);
}

?>

<form action="" method="post">
    <div class="formNewProd">
        <input type="text" name="nome" id="nome" placeholder="nome">
        <input type="date" name="nascimento" id="nascimento">
        <input type="text" name="cpf" id="cpf" placeholder="CPF">
        <select name="tipo" id="tipo">
            <option value="">Selecione um tipo...</option>
            <?php
            $sql = "select * from tipo order by idTipo";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>
                <option value="<?= $dados->idTipo ?>"><?= $dados->nome ?></option>
            <?php
            }
            ?>
        </select>
        <input type="text" name="login" id="login" placeholder="Login">
        <input type="text" name="senha" id="senha" placeholder="Senha">
        <button type="submit">Cadastrar Usuário</button>
    </div>
</form>

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