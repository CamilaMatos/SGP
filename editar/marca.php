<?php
    $sql = "select * from marca where idMarca=:idMarca";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":idMarca", $id);
    $consulta->execute();

    $dadosM = $consulta->fetch(PDO::FETCH_OBJ);

?>


<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Marca</h1>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
        <div class="modal-body">
            <form action="cadastrar/marca" method="post" id="formMarca">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="nome" class="formLabel">Nome da Marca:</label>
                            <input type="text" name="nome" id="nome" value="<?=$dadosM->nome?>" class="formInput">
                        </div>
                    </div>
                </div>
            </form>
            <br>
        </div>
        <div class="modal-footer">
            <button type="submit" class="formSubmitButton" form="formMarca">Enviar</button>
        </div>
    </div>
</div>