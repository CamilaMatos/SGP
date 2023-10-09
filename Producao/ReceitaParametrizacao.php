<?php
require_once "Conecta.php";
class ReceitaParametrizacao {
    private $idReceita;
    private $nome;
    private $categoria;
    private $tempo;
    private $modo;
    private $rendimento;

    public function __construct($idReceita, $nome, $categoria, $tempo, $modo, $rendimento)
    {
        $this->idReceita = $idReceita;
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->tempo = $tempo;
        $this->modo = $modo;
        $this->rendimento = $rendimento;
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
 
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
 
    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }
 
    public function getTempo()
    {
        return $this->tempo;
    }

    public function setTempo($tempo)
    {
        $this->tempo = $tempo;

        return $this;
    }
 
    public function getModo()
    {
        return $this->modo;
    }

    public function setModo($modo)
    {
        $this->modo = $modo;

        return $this;
    }
 
    public function getRendimento()
    {
        return $this->rendimento;
    }

    public function setRendimento($rendimento)
    {
        $this->rendimento = $rendimento;

        return $this;
    }

    public function cadastrarReceita(){

    }

    public function editarReceita(){

    }

    public function excluirReceita(){

    }
}
?>