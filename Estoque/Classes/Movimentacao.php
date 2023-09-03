<?php
class Movimentacao {
    private $idMovimentacao;
    private $idSolicitacao;
    private $idUsuario;
    private $idStatus;
    private $data;

    public function __construct($idSolicitacao, $idUsuario, $idStatus, $data)
    {
        $this->idSolicitacao = $idSolicitacao;
        $this->idUsuario = $idUsuario;
        $this->idStatus = $idStatus;
        $this->data = $data;
    }
 
    public function getIdMovimentacao()
    {
        return $this->idMovimentacao;
    }

    public function setIdMovimentacao($idMovimentacao)
    {
        $this->idMovimentacao = $idMovimentacao;

        return $this;
    }
 
    public function getIdSolicitacao()
    {
        return $this->idSolicitacao;
    }

    public function setIdSolicitacao($idSolicitacao)
    {
        $this->idSolicitacao = $idSolicitacao;

        return $this;
    }
 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

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
 
    public function getdata()
    {
        return $this->data;
    }

    public function setdata($data)
    {
        $this->data = $data;

        return $this;
    }

    public function realizarMovimentacao($idSolicitacao, $idUsuario, $idStatus, $data){
        
    }
}