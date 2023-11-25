<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/summernote-lite.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/vanilla-masker.js"></script>
    <script src="js/parsley.min.js"></script>
    <script src="js/summernote-lite.min.js"></script>
    <script src="js/summernote-pt-BR.js"></script>
    <script src="https://kit.fontawesome.com/4af1129b29.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <?php
            require "configs/conecta.php";
            require "estoque/ItensSolicitacao.php";

            $op = trim($_GET["op"] ?? $_POST["op"] ?? NULL);
            $idSolicitacao = trim($_GET["idSolicitacao"] ?? $_POST["idSolicitacao"] ?? NULL);
            $idItem = trim($_GET["idItem"] ?? $_POST["idItem"] ?? NULL);

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
            if($op == "excluir"){

                $Itens = new ItensSolicitacao(NULL, NULL, NULL, NULL, NULL);
                $resultado = $Itens->excluirItemSolicitacao($idSolicitacao, $idItem);

                if($resultado == "R"){
                    echo "<script>alert('Item não foi excluido pois a solicitação já foi atendida!');</script>";
                }
                if($resultado == "E"){
                    echo "<script>alert('Erro! O item não pode ser excluido!');</script>";
                }
                else{
                    echo "<script>alert('Item foi excluido com sucesso!');</script>";
                }
            }


            $sql = "select i.idItem, i.nome, itens.quantidade from itenssolicitacao itens
            inner join item i on (itens.idItem = i.idItem)
            where idSolicitacao = :idSolicitacao";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":idSolicitacao", $idSolicitacao);
            $consulta->execute();



            ?>
            <div class="flex-row">
                <table class="table-striped tableFullLength text-center">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p>Id. do Item</p>
                            </th>
                            <th scope="col">
                                <p>Item</p>
                            </th>
                            <th scope="col">
                                <p>Qtd. Solicitada</p>
                            </th>
                            <th scope="col">
                                <p>Opções</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <?=$dados->idItem?>
                                        </th>
                                        <td>
                                            <?=$dados->nome?>
                                        </td>
                                        <td>
                                            <?=$dados->quantidade?>
                                        </td>
                                        <td>
                                            <a href="itensRequisicao.php?op=excluir&idSolicitacao=<?=$idSolicitacao?>&idItem=<?=$dados->idItem?>" title="Excluir"
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
            </div>
            <?php
        ?>
        
    </body>
</html>



<script>
    function Excluir(id, id2){
        var idSolicitacao = <?=$idSolicitacao?>;
        location.href = "excluir/itenssolicitacao/" + id + "/" + id2;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>