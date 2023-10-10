<?php
require_once "Conecta.php";
class OrdemParametrizacao {
    private $idReceita;

    private $idItem;

    private $quantidade;

    private $idUnidadeMedida;

    public function __construct($idReceita, $idItem, $quantidade, $idUnidadeMedida)
    {
        $this->idReceita = $idReceita;
        $this->idItem = $idItem;
        $this->quantidade = $quantidade;
        $this->idUnidadeMedida = $idUnidadeMedida;
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

    public function cadastrarIngrediente(){

    }

    public function editarIngrediente(){

    }

    public function excluirIngrediente(){
        
    }
}
?>