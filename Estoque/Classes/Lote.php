<?php
require_once "Conecta.php";
class Lote {
    private $idLote;
    private $idItem;
    private $idEstoque;
    private $quantidadeInicial;
    private $quantidadeAtual;
    private $validade;
    private $valorUnitario;

    public function __construct($idLote, $idItem, $idEstoque, $quantidadeInicial, $quantidadeAtual, $validade, $valorUnitario)
    {
        $this->idLote = $idLote;
        $this->idItem = $idItem;
        $this->idEstoque = $idEstoque;
        $this->quantidadeInicial = $quantidadeInicial;
        $this->quantidadeAtual = $quantidadeAtual;
        $this->validade = $validade;
        $this->valorUnitario = $valorUnitario;
    }
 
    public function getIdLote()
    {
        return $this->idLote;
    }

    public function setIdLote($idLote)
    {
        $this->idLote = $idLote;

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
 
    public function getIdEstoque()
    {
        return $this->idEstoque;
    }

    public function setIdEstoque($idEstoque)
    {
        $this->idEstoque = $idEstoque;

        return $this;
    }
 
    public function getQuantidadeInicial()
    {
        return $this->quantidadeInicial;
    }

    public function setQuantidadeInicial($quantidadeInicial)
    {
        $this->quantidadeInicial = $quantidadeInicial;

        return $this;
    }
 
    public function getQuantidadeAtual()
    {
        return $this->quantidadeAtual;
    }

    public function setQuantidadeAtual($quantidadeAtual)
    {
        $this->quantidadeAtual = $quantidadeAtual;

        return $this;
    }
 
    public function getValidade()
    {
        return $this->validade;
    }

    public function setValidade($validade)
    {
        $this->validade = $validade;

        return $this;
    }
 
    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }

    public function setValorUnitario($valorUnitario)
    {
        $this->valorUnitario = $valorUnitario;

        return $this;
    }

    public function inserirLote(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into lote values (NULL, :idItem, :idEstoque, :quantidadeInicial, :quantidadeAtual, :validade, :valorUnitario)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->bindParam(":quantidadeInicial", $this->quantidadeInicial);
        $consulta->bindParam(":quantidadeAtual", $this->quantidadeAtual);
        $consulta->bindParam(":validade", $this->validade);
        $consulta->bindParam(":valorUnitario", $this->valorUnitario);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarLote($id){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update lote SET idEstoque=:idEstoque, quantidadeInicial=:quantidadeInicial, quantidadeAtual=:quantidadeAtual, validade=:validade, valorUnitario=:valorUnitario where idLote=:idLote";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->bindParam(":quantidadeInicial", $this->quantidadeInicial);
        $consulta->bindParam(":quantidadeAtual", $this->quantidadeAtual);
        $consulta->bindParam(":validade", $this->validade);
        $consulta->bindParam(":valorUnitario", $this->valorUnitario);
        $consulta->bindParam(":idLote", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function excluirLote($id){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se não existe solicitação com esse lote
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from lote where idLote=:idLote";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":idLote", $id);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//operação recusada
        }

        return $resultado;
    }

    public function verificarRegistros($id) {
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from itensSolicitacao where idLote=:idLote";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idLote", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }


    public function consultarEstoqueItem($idItem, $idEstoque){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select SUM(quantidadeAtual) from lote where idItem=:idItem and idEstoque=:idEstoque";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idItem", $idItem);
        $consulta->bindParam(":idEstoque", $idEstoque);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}