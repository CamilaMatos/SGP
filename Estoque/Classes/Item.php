<?php
class Item{
    private $idItem;
    private $nome;
    private $unidadeMedia;
    private $idCategoria;
    private $idMarca;
    private $idUnidadeMedida;
    private $idStatus;

    public function __construct($nome, $unidadeMedia, $idCategoria, $idMarca, $idUnidadeMedida, $idStatus)
    
    {
        $this->nome = $nome;
        $this->unidadeMedia = $unidadeMedia;
        $this->idCategoria = $idCategoria;
        $this->idMarca = $idMarca;
        $this->idUnidadeMedida = $idUnidadeMedida;
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
 
    public function getunidadeMedia()
    {
        return $this->unidadeMedia;
    }


    public function setunidadeMedia($unidadeMedia)
    {
        $this->unidadeMedia = $unidadeMedia;

        return $this;
    }
 
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }


    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }
 
    public function getIdMarca()
    {
        return $this->idMarca;
    }


    public function setIdMarca($idMarca)
    {
        $this->idMarca = $idMarca;

        return $this;
    }
 
    public function getidUnidadeMedida()
    {
        return $this->idUnidadeMedida;
    }


    public function setidUnidadeMedida($idUnidadeMedida)
    {
        $this->idUnidadeMedida = $idUnidadeMedida;

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

    public function cadastrarItem($nome, $unidadeMedia, $idCategoria, $idMarca, $idUnidadeMedida, $idStatus){
        
    }

    public function editarItem($idItem, $nome, $unidadeMedia, $idCategoria, $idMarca, $idUnidadeMedida, $idStatus){

    }

    public function excluirItem($idItem){

    }

    public function alterarStatusItem($idItem, $idStatus){

    }

}