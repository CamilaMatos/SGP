<?php
require_once "Conecta.php";
class ReceitaServico {
    private $idOrdem;
    private $idReceita;
    private $idItem;
    private $quantidade;

    public function __construct($idOrdem, $idReceita, $idItem, $quantidade)
    {
        $this->idOrdem = $idOrdem;
        $this->idReceita = $idReceita;
        $this->idItem = $idItem;
        $this->quantidade = $quantidade;
    }


 
    public function getIdOrdem()
    {
        return $this->idOrdem;
    }

    public function setIdOrdem($idOrdem)
    {
        $this->idOrdem = $idOrdem;

        return $this;
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

    public function editarIngrediente(){

    }
}
?>