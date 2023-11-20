<?php
require_once "./Classes/Conecta.php";
class ItemEstoque {
    private $idItem;
    private $idEstoque;
    private $quantidade;
    private $pdo;

    public function __construct($idItem, $idEstoque, $quantidade)
    {
        $this->idItem = $idItem;
        $this->idEstoque = $idEstoque;
        $this->quantidade = $quantidade;
        $this->pdo = $this->conexao();
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

    public function getIdEstoque()
    {
        return $this->idEstoque;
    }

    public function setIdEstoque($idEstoque)
    {
        $this->idEstoque = $idEstoque;

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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function cadastrarItemEstoque(){
        if(empty($this->itemPorIdEstoque())) {
            $sql = "insert into itemEstoque values (:idItem, :idEstoque, :quantidade)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idItem", $this->idItem);
            $consulta->bindParam(":idEstoque", $this->idEstoque);
            $consulta->bindParam(":quantidade", $this->quantidade);

            if ($consulta->execute()) {
                $resultado = $this->pdo->lastInsertId();//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro desse item
        }

        return $resultado;
    }

    public function editarItemEstoque($op){
        $qtdAtual = $this->itemPorIdEstoque()->quantidade;
        if($op=="+"){
            $qtdNova = $qtdAtual + $this->quantidade;
        } else {
            $qtdNova = $qtdAtual - $this->quantidade;
        }
        $sql = "update itemEstoque SET quantidade=:quantidade where idItem=:idItem and idEstoque=:idEstoque";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->bindParam(":quantidade", $qtdNova);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }
        

        return $resultado;
    }

    public function itemPorIdEstoque(){
        $sql = "select * from itemEstoque where idItem=:idItem and idEstoque=:idEstoque";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}