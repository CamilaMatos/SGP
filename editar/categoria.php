<?php

    $sql = "select * from categoria where idCategoria = :idCategoria limit 1";
    $consulta= $pdo->prepare($sql);
    $consulta->bindParam(":idCategoria", $id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

?>

<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova categoria</h1>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            <div class="modal-body">
                <form action="cadastrar/categoria/<?=$id?>" method="post" id="formCategoria">
                    <div class="formNewProd">
                        <div class="form-row">
                            <div class="formCol">
                                <label for="nome" class="formLabel">Nome da Categoria:</label>
                                <input type="text" name="nome" id="nome" value="<?=$dados->nome?>" class="formInput">
                            </div>
                        </div>
                        
                    </div>
                </form>
                <br>
            </div>
            <div class="modal-footer">
                <button type="submit" class="formSubmitButton" form="formCategoria">Enviar</button>
            </div>
        </div>
    </div>