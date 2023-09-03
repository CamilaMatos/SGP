<?php
class UnidadeMedida {
    private $idUnidadeMedida;
    private $nome;

    public function __construct($nome)
    {
        $this->nome = $nome;
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
 
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function cadastrarUnidadeMedida($nome){
        
    }

    public function editarUnidadeMedida($idUnidadeMedida, $nome){

    }

    public function excluirUnidadeMedida($idUnidadeMedida){

    }

}