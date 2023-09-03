<?php
class Estoque {
    private $idEstoque;
    private $nome;
    private $descricao;
    private $idStatus;

    public function __construct($nome, $descricao, $idStatus)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->idStatus = $idStatus;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;

        return $this;
    }

    public function cadastrarEstoque($nome, $descricao, $idStatus){
        
    }

    public function editarEstoque($idEstoque, $nome, $descricao){

    }

    public function excluirEstoque($idEstoque){

    }

    public function alterarStatusEstoque($idEstoque, $idStatus){

    }

    public function consultarEstoque($parametro){
        
    }
}