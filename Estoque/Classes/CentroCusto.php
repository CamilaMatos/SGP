<?php
class CentroCusto {
    private $idCentroCusto;
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

    public function cadastrarCentroCusto($nome, $descricao, $idStatus){
        
    }

    public function editarCentroCusto($idCentroCusto, $nome, $descricao){

    }

    public function excluirCentroCusto($idCentroCusto){

    }

    public function alterarStatusCentroCusto($idCentroCusto, $idStatus){

    }

    public function consultarCentroCusto($parametro){
        
    }

}