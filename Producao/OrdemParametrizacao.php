<?php
require_once "./Classes/Conecta.php";
class OrdemParametrizacao {
    private $idReceita;
    private $idItem;
    private $quantidade;
    private $idUnidadeMedida;
    private $pdo;

    public function __construct($idReceita, $idItem, $quantidade, $idUnidadeMedida)
    {
        $this->idReceita = $idReceita;
        $this->idItem = $idItem;
        $this->quantidade = $quantidade;
        $this->idUnidadeMedida = $idUnidadeMedida;
        $this->pdo = $this->conexao();
    }

    public function getIdReceita()
    {
        return $this->idReceita;
    }
     
    public function setIdReceita($idReceita)
    {
        $this->idReceita = $idReceita;

        return $this;
    } 

    public function getIdItem()
    {
        return $this->idItem;
    }
     
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;

        return $this;
    } 

    public function getQuantidade()
    {
        return $this->quantidade;
    }
     
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    } 

    public function getIdUnidadeMedida()
    {
        return $this->idUnidadeMedida;
    }
     
    public function setIdUnidadeMedida($idUnidadeMedida)
    {
        $this->idUnidadeMedida = $idUnidadeMedida;

        return $this;
    }

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function cadastrarIngrediente(){
        $sql = "insert into ordemParametrizacao values (:idReceita, :idItem, :quantidade, :idUnidadeMedida)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idReceita", $this->idReceita);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":quantidade", $this->quantidade);
        $consulta->bindParam(":idUnidadeMedida", $this->idUnidadeMedida);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarIngrediente(){
        $sql = "update ordemParametrizacao SET quantidade=:quantidade, idUnidadeMedida=:idUnidadeMedida where idReceita=:idReceita and idItem=:idItem";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":quantidade", $this->quantidade);
        $consulta->bindParam(":idUnidadeMedida", $this->idUnidadeMedida);
        $consulta->bindParam(":idReceita", $this->idReceita);
        $consulta->bindParam(":idItem", $this->idItem);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function excluirIngrediente(){
        $sql = "delete from ordemParametrizacao where idReceita=:idReceita and idItem=:idItem";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idReceita", $this->idReceita);
        $consulta->bindParam(":idItem", $this->idItem);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }
}
?>