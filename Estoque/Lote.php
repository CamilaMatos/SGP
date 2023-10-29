<?php
require_once "../Classes/Conecta.php";
class Lote {
    private $idItem;
    private $idEstoque;
    private $quantidadeInicial;
    private $quantidadeAtual;
    private $validade;
    private $valorUnitario;
    private $pdo;

    public function __construct($idItem, $idEstoque, $quantidadeInicial, $quantidadeAtual, $validade, $valorUnitario)
    {
        $this->idItem = $idItem;
        $this->idEstoque = $idEstoque;
        $this->quantidadeInicial = $quantidadeInicial;
        $this->quantidadeAtual = $quantidadeAtual;
        $this->validade = $validade;
        $this->valorUnitario = $valorUnitario;
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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function inserirLote(){
        $sql = "insert into lote values (NULL, :idItem, :idEstoque, :quantidadeInicial, :quantidadeAtual, :validade, :valorUnitario)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->bindParam(":quantidadeInicial", $this->quantidadeInicial);
        $consulta->bindParam(":quantidadeAtual", $this->quantidadeAtual);
        $consulta->bindParam(":validade", $this->validade);
        $consulta->bindParam(":valorUnitario", $this->valorUnitario);

        if ($consulta->execute()) {
            $resultado = $this->pdo->lastInsertId();//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarLote($id){
        $sql = "update lote SET idEstoque=:idEstoque, quantidadeInicial=:quantidadeInicial, quantidadeAtual=:quantidadeAtual, validade=:validade, valorUnitario=:valorUnitario where idLote=:idLote";
        $consulta = $this->pdo->prepare($sql);
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
        //verificar se não existe solicitação com esse lote
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from lote where idLote=:idLote";
            $consulta = $this->pdo->prepare($sql);
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
        $sql = "select * from itensSolicitacao where idLote=:idLote";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idLote", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }


    
}