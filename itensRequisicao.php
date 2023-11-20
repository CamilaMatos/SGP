<?php
    require "configs/conecta.php";
    require "estoque/ItensSolicitacao.php";

    // $idSolicitacao = trim($_GET["venda_id"] ?? $_POST["venda_id"] ?? 1);

    if($_POST){
        $idItem = $_POST['idItem'];
        $qtd = $_POST['qtd'];
        $idSolicitacao = $_POST['idSolicitacao'];

        $I = new ItensSolicitacao ($idSolicitacao, NULL, $qtd, $idItem, NULL);

        $resultado = $I->inserirItemSolicitacao($qtd);

        if($resultado == "E"){
            echo "<script>alert('Erro ao realizar inserção!');</script>";
        }
        else{
            echo "<script>alert('Produto inserido à requisição!');</script>";
        }
    }

    $idSolicitacao = 27;

    $sql = "select i.idItem, i.nome, itens.quantidade from itenssolicitacao itens
    inner join item i on (itens.idItem = i.idItem)
    where idSolicitacao = :idSolicitacao";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":idSolicitacao", $idSolicitacao);
    $consulta->execute();



    ?>
    <table>
        <thead>
            <tr>
                <th>
                    <p>Id. do Item</p>
                </th>
                <th>
                    <p>Item</p>
                </th>
                <th>
                    <p>Qtd. Solicitada</p>
                </th>
                <th>
                    <p>Opções</p>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                    ?>
                        <tr>
                            <th>
                                <?=$dados->idItem?>
                            </th>
                            <td>
                                <?=$dados->nome?>
                            </td>
                            <td>
                                <?=$dados->quantidade?>
                            </td>
                            <td>

                                <a href="javascript:Excluir(<?=$dados->idItem?>)" title="Excluir"
                                class="btn btn-danger btn-sm">
                                    Apagar
                                </a>

                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <?php

?>

<script>
    function Excluir(id){
        location.href = "excluir/itenssolicitacao/" + id;
    }
</script>