<?php
    $sql = "select * from usuario where idUsuario = $id";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();

    $dadosU = $consulta->fetch(PDO::FETCH_OBJ);

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Funcionario:</h1>
            <button type="button" class="btn btn-secondary" onclick="history.back()" data-dismiss="modal">Fechar</button>
        </div>
        <div class="modal-body">
        <form action="cadastrar/usuario/<?=$id?>" method="post" id="editUsuario">
            <div class="formNewProd">
                <div class="form-row">
                    <div class="formCol">
                        <label for="nome" class="formLabel">Nome:</label>
                        <input type="text" name="nome" id="nome" value="<?=$dadosU->nome?>" class="formInput" required>
                    </div>
                    <div class="formCol">
                        <label for="nascimento" class="formSelectLabel">Data de Nascimento:</label>
                        <input type="date" name="nascimento" id="nascimento" value="<?=$dadosU->dataNasc?>" class="formInput" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="formCol">
                        <label for="cpf" class="formLabel">CPF:</label>
                        <input type="text" name="cpf" id="cpf" value="<?=$dadosU->documento?>" class="formInput" required>
                    </div>
                    <div class="formCol">
                        <label for="tipo" class="formSelectLabel">Tipo do Funcionario: </label>
                        <select name="tipo" id="tipo" class="formInput" required>
                            <option value="">Selecione um tipo...</option>
                            <?php
                            $sql = "select * from tipo order by idTipo";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();
                            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                if($dados->idTipo == $dadosU->idTipo){
                                    ?>
                                        <option value="<?=$dados->idTipo?>" selected><?=$dados->nome?></option>
                                    <?php
                                    
                                }else{
                                    ?>
                                        <option value="<?= $dados->idTipo ?>"><?= $dados->nome ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="formCol">
                        <label for="login" class="formLabel">Login:</label>
                        <input type="text" name="login" id="login" value="<?=$dadosU->login?>" class="formInput" required>
                    </div>
                    <div class="formCol">
                        <label for="senha" class="formLabel">Senha:</label>
                        <input type="text" name="senha" id="senha" placeholder="Senha" class="formInput">
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="formSubmitButton" form="editUsuario">Salvar Alterações</button>
        </div>
    </div>
</div>


