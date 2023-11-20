<?php
    
    $I = new Item($nome, $unMedia, $categoria, $marca, $unMedida, $status);

    $sql = "select i.nome nome, i.unMedia unMedia, c.nome categoria, i.marca marca, iM.nome unMedida, i.status from item i
    inner join unidadeMedida uM on (i.idUnidadeMedida = um.idUnidadeMedida)
    inner join categoria c on (i.idCategoria = c.idCategoria)
    where i.idItem = :id";






?>