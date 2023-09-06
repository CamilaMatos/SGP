<?php
class Solicitacao {
    private $idSolicitacaoMovimentacao;
    private $idTipo;
    private $destino;
    private $idStatus;
    private $idSolicitante;

    public function __construct($idSolicitacaoMovimentacao, $idTipo, $destino, $idStatus, $idSolicitante)
    {
        $this->idSolicitacaoMovimentacao = $idSolicitacaoMovimentacao;
        $this->idTipo = $idTipo;
        $this->destino = $destino;
        $this->idStatus = $idStatus;
        $this->idSolicitante = $idSolicitante;
    }
 
    public function getIdSolicitacaoMovimentacao()
    {
        return $this->idSolicitacaoMovimentacao;
    }

    public function setIdSolicitacaoMovimentacao($idSolicitacaoMovimentacao)
    {
        $this->idSolicitacaoMovimentacao = $idSolicitacaoMovimentacao;

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
 
    public function getDestino()
    {
        return $this->destino;
    }

    public function setDestino($destino)
    {
        $this->destino = $destino;

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
 
    public function getIdSolicitante()
    {
        return $this->idSolicitante;
    }

    public function setIdSolicitante($idSolicitante)
    {
        $this->idSolicitante = $idSolicitante;

        return $this;
    }

    public function cadastrarSolicitacao($idTipo, $destino, $idStatus, $idSolicitante){
        
    }

    public function editarSolicitacao($idSolicitacao, $idTipo, $destino, $idSolicitante){

    }

    public function excluirSolicitacao($idSolicitacao){

    }

    public function alterarStatusSolicitacao($idSolicitacao, $idStatus){

    }

}