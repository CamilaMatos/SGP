<?php
    $sql = "select * from unidademedida where idUnidadeMedida = $id";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $dadosUN = $consulta->fetch(PDO::FETCH_OBJ);
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Produto</h1>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
        <div class="modal-body">
            <form action="cadastrar/unidadeMedida" method="post" id="formUM">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="nome" class="formLabel">Nome da Unidade de Medida:</label>
                            <input type="text" name="nome" id="nome" value="<?=$dadosUN->nome?>" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="nome" class="formLabel">Descrição da Unidade de Medida:</label>
                            <input type="text" name="descricao" id="descricao" value="<?=$dadosUN->descricao?>" class="formInput">
                        </div>
                    </div>
                </div>
            </form>
            <br>
        </div>
        <div class="modal-footer">
            <button type="submit" class="formSubmitButton" form="formUM" >Enviar</button>
        </div>
    </div>
</div>