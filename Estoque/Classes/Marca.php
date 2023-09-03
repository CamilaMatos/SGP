<?php
class Marca {
    private $idMarca;
    private $nome;

    public function __construct($nome)
    {
        $this->nome = $nome;
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
 
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function cadastrarMarca($nome){
        
    }

    public function editarMarca($idMarca, $nome){

    }

    public function excluirMarca($idMarca){

    }

    public function consultarMarca($parametro){
        
    }
}