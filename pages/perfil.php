
<div class="flex-row">
    <div class="profileCard">
        <div class="flex-row">
            <div class="col-4 pCardLS" >
                <div class="cAlign">
                    <div class="flex-row">
                        <div class="pPictureBackground">
                            <i class="fa-regular fa-circle-user loginIcon"></i>
                        </div>
                    </div>
                    <label for="nome">Nome:</label>
                    <input type="text" class="formInput" id="nome" readonly placeholder="<?=$_SESSION['nome']?>">
                </div>
            </div>
            <div class="flex-row">
                <div class="vOptionBorder"></div>
            </div>
            <div class="col-8 pCardRS">
                <div class="cAlign">
                    <div class="flex-row">
                        <div class="formCol">
                            <label for="login">Login:</label>
                            <input type="text" class="formInput" id="login" readonly placeholder="<?=$_SESSION['login']?>">
                        </div>
                        <div class="formCol">
                            <label for="cargo">Cargo:</label>
                            <input type="text" class="formInput" id="cargo" readonly placeholder="<?=$_SESSION['tipo']?>">
                        </div>
                    </div>
                    <div class="flex-row">
                        <div class="formCol">
                            <label for="nacimento">Data de Nascimento:</label>
                            <input type="text" class="formInput" readonly placeholder="<?=$_SESSION['nascimento']?>">
                        </div>
                    </div>
                    <div class="flex-row">
                        <button type="button" class="newButton" data-toggle="modal" data-target="#modalTrocaSenha">
                            Alterar Senha
                        </button>
                    </div>
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