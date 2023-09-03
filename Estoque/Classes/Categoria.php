<?php
class Categoria {
    private $idCategoria;
    private $nome;

    public function __construct($nome)
    {
        $this->nome = $nome;
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

    public function cadastrarCategoria($nome){
        
    }

    public function editarCategoria($idCategoria, $nome){

    }

    public function excluirCategoria($idCategoria){

    }

    public function consultarCategoria($parametro){
        
    }

}