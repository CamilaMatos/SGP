<?php
    $sql = "select * from centrocusto where idCentroCusto=:idCentroCusto limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":idCentroCusto", $id);
    $consulta->execute();

    $dadosCC = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Produto</h1>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
        <div class="modal-body">
            <form action="cadastrar/centroCusto/" method="post" id="formCentroCusto">
                <div class="formNewProd">
                    <div class="form-row">

                        <div class="formCol">
                            <label for="nome" class="formLabel">Centro de Custo:</label>
                            <input type="text" name="nome" id="nome" value="<?=$dadosCC->nome?>" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="descricao" class="formLabel">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" value="<?=$dadosCC->descricao?>" class="formInput">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="formCol">
                            <label for="status" class="formLabel">Status:</label>
                            <select name="status" id="status" class="formInput" required>
                                <option value="">Selecione o status de abertura...</option>
                                <?php
                                $sql = "select * from status";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ($dadosS = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    if($dadosS->idStatus == $dadosCC->idStatus){
                                        ?>
                                            <option value="<?=$dadosS->idStatus?>" selected><?=$dadosS->nome?></option>
                                        <?php
                                        
                                    }else{
                                        ?>
                                            <option value="<?= $dadosS->idStatus ?>"><?= $dadosS->nome ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </form>
            <br>
        </div>
      <div class="modal-footer">
        <button type="submit" class="formSubmitButton" form="formCentroCusto">Enviar</button>
      </div>
    </div>
  </div>