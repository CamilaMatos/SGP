<?php
class Usuario {
    private $nome;
    private $dataNasc;
    private $documento;
    private $idTipo;
    private $login;
    private $senha;

    public function __construct($nome, $dataNasc, $documento, $idTipo, $login, $senha)
    {
        $this->nome = $nome;
        $this->dataNasc = $dataNasc;
        $this->documento = $documento;
        $this->idTipo = $idTipo;
        $this->login = $login;
        $this->senha = $senha;
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
 
    public function getDataNasc()
    {
        return $this->dataNasc;
    }

    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;

        return $this;
    }
 
    public function getDocumento()
    {
        return $this->documento;
    }

    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }
 
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;

        return $this;
    }
 
    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }
 
    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function logar($login, $senha){

    }

    public function cadastrarUsuario($nome, $dataNasc, $documento, $idTipo, $login, $senha){
        
    }

    public function editarUsuario($idUsuario, $nome, $dataNasc, $documento, $idTipo, $login, $senha){

    }

    public function excluirUsuario($idUsuario){

    }

    public function alterarTipoUsuario($idUsuario, $idTipo){

    }

}