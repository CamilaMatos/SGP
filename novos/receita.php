<?php
    include './Producao/ReceitaParametrizacao.php';


    $nome = NULL;
    $idCategoria = NULL;
    $tempo = NULL;
    $modo = NULL;
    $rendimento = NULL;

    $R = new ReceitaParametrizacao($nome, $idCategoria, $tempo, $modo, $rendimento);

    $idReceita = $R->cadastrarReceita();

?>




<div class="contentDiv">
    <div class="flex-row">
        <div class="modal-content" style="width: 75vw !important; margin: 0;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Requisição</h1>
                <a href="listar/solicitacoes">
                    <button type="button" class="btn btn-secondary">Fechar</button>
                </a>
            </div>
            <div class="modal-body">
                <div class="formNewProd">
                    <form action="cadastrar/receita/<?=$idReceita?>" id="formReceita" method="post">
                        <div class="form-row">
                            <div class="formCol">
                                <label for="nome" class="formLabel">Nome da Receita</label>
                                <input type="text" name="nome" id="nome" placeholder="Ex. Arroz" class="formInput" required>
                            </div>
                            <div class="formCol">
                                <label for="idCategoria">Categoria</label>
                                <select name="idCategoria" id="idCategoria" class="formInput" required>
                                    <option value="" >Selecione uma Categoria...</option>
                                    <?php
                                        $sql = "select * from categoria";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();
                                        while($dadosC = $consulta->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                                <option value="<?=$dadosC->idCategoria?>"><?=$dadosC->nome?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="formCol">
                                <label for="tempo" class="formLabel">Tempo:</label>
                                <input type="time" name="tempo" id="tempo" class="formInput" required>
                            </div>
                            <div class="formCol">
                                <label for="rendimento" class="formLabel">Rendimento:</label>
                                <input type="number" name="rendimento" id="rendimento" class="formInput" required>
                            </div>
                        </div>
                    </form>
                    <form name="formProdutos" method="post" action="itensReceita.php" data-parsley-validade="" target="itens">
                        <div class="form-row">
                            <div class="formCol">
                                <input type="hidden" name="idReceita" id="idReceita" value="<?=$idReceita?>" readonly class="formInput">
                            </div>
                            <div class="formCol">
                                <label for="marca" class="formLabel">Produtos:</label>
                                <select name="idItem" id="idItem" class="formInput">
                                    <option value="">Selecione um item:</option>
                                    <?php
                                    $sql = "select * from Item";
                                    $consulta = $pdo->prepare($sql);
                                    $consulta->execute();
                                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <option value="<?= $dados->idItem ?>"><?= $dados->nome ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
    
                            <div class="formCol">
                                <label for="qtd">Quantidade</label>
                                <input type="text" name="qtd" id="qtd" placeholder="Qtd." class="formInput">
                            </div>

                            <div class="formCol">
                                <label for="idUnidadeMedida" class="formLabel">Unidade de Medida:</label>
                                <select name="idUnidadeMedida" id="idUnidadeMedida" class="formInput">
                                    <option value="">Selecione um item:</option>
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
                            </div>
    
                            <div class="formCol">
                                <div class="submitCol">
                                    <button type="submit" class="formSubmitButton">Adicionar Produto</button>
                                </div>
                            </div>
    
                        </div>
                        <br>
                        <iframe name="itens" class="card" width="100%" height="300px" src="itensReceita.php?idReceita=<?=$idReceita?>"></iframe>
                        <br>
                    </form>
                    <div class="form-row">
                        <label for="modo">Modo de Preparo</label>
                        <textarea name="modo" id="modo" class="form-control" required rows="5" form="formReceita"></textarea>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <div class="submitCol" >
                    <button type="submit" class="formSubmitButton" form="formReceita">Cadastrar Requisição</button>
                </div>
            </div>
        </div>
        
    </div>

</div>