
<div class="flex-row">
    <div class="profileCard">
        
        <div class="pCardRS">
            <div class="cAlign">
                <div class="flex-row">
                    <div class="pPictureBackground">
                        <i class="fa-regular fa-circle-user loginIcon"></i>
                    </div>
                </div>
                <br>
                <div class="profile-row">
                    <div class="col-3"></div>
                    <div class="col-3 text-left">
                        <label for="nome">Nome:  </label>
                    </div>
                    <div class="col-6 text-left">
                        <?=$_SESSION['nome']?>
                    </div>
                </div>
                        
                <div class="profile-row">
                    <div class="col-3"></div>
                    <div class="col-3 text-left">
                        <label for="login">Login:   </label>
                    </div>
                    <div class="col-6 text-left">
                        <?=$_SESSION['login']?>
                    </div>
                </div>
                    
                <div class="profile-row">
                    <div class="col-3"></div>
                    <div class="col-3 text-left">
                        <label for="cargo">Cargo:</label>
                    </div>
                    <?php
                        $tipo = $_SESSION['tipo'];
                        $sql = "select t.nome from tipo t where idTipo=:idTipo";
                        $consulta = $pdo->prepare($sql);
                        $consulta->bindParam(":idTipo", $tipo);
                        $consulta->execute();
                        $dadosT = $consulta->fetch(PDO::FETCH_OBJ);
                        
                    ?>
                    <div class="col-6 text-left">
                        <?=$dadosT->nome?>
                    </div>
                    
                </div>
                <div class="profile-row">
                    <div class="col-3"></div>
                    <div class="col-3 text-left">
                        <label for="nacimento">Nascimento:</label>
                    </div>
                    <div class="col-6 text-left">
                        <?=$_SESSION['nascimento']?>
                    </div>
                    
                </div>
                <div class="form-row">
                    <button type="button" class="newButton" data-toggle="modal" data-target="#modalTrocaSenha">
                        Alterar Senha
                    </button>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modalTrocaSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Produto</h1>
        </div>
        <div class="modal-body">
            <form name="trocaDeSenha" action="" method="post">
                <div class="formNewProd">
                    <div class="form-row">
                        <div class="formCol">
                            <label for="nome" class="formLabel">Nome da Unidade de Medida:</label>
                            <input type="text" name="nome" id="nome" placeholder="Ex. Lt" class="formInput">
                        </div>
                        <div class="formCol">
                            <label for="nome" class="formLabel">Descrição da Unidade de Medida:</label>
                            <input type="text" name="descricao" id="descricao" placeholder="Ex. Litro" class="formInput">
                        </div>
                    </div>
                </div>
            </form>
            <br>
        </div>
      <div class="modal-footer">
        <button type="submit" class="formSubmitButton">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>