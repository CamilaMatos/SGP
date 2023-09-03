<?php
class Lote {
    private $idLote;
    private $idItem;
    private $idEstoque;
    private $quantidadeInicial;
    private $quantidadeAtual;
    private $validade;
    private $valorUnitario;

    public function __construct($idItem, $idEstoque, $quantidadeInicial, $quantidadeAtual, $validade, $valorUnitario)
    {
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

    public function inserirLote($idItem, $idEstoque, $quantidadeInicial, $quantidadeAtual, $validade, $valorUnitario){
        
    }

    public function editarLote($idItem, $idEstoque, $quantidadeInicial, $quantidadeAtual, $validade, $valorUnitario){

    }

    public function consultarEstoqueItem($idItem, $idEstoque){
        
    }
}