<?php
    require "configs/conecta.php";

    // $idSolicitacao = trim($_GET["venda_id"] ?? $_POST["venda_id"] ?? 1);

    $idSolicitacao = 1;

    $sql = "select i.idItem, i.nome, im.quantidade from itensmovimentacao im
    inner join lote l on (im.idLote = l.idLote)
    inner join item i on (l.idItem = i.idItem)
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
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <?php

?>
