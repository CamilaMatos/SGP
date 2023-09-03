<?php
class ItensSolicitacao{
    private $idSolicitacao;
    private $idLote;
    private $quantidade;

    public function __construct($idSolicitacao, $idLote, $quantidade)
    {
        $this->idSolicitacao = $idSolicitacao;
        $this->idLote = $idLote;
        $this->quantidade = $quantidade;
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
 
    public function getIdLote()
    {
        return $this->idLote;
    }

    public function setIdLote($idLote)
    {
        $this->idLote = $idLote;

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

    public function inserirItemSolicitacao($idSolicitacao, $idLote, $quantidade){
        
    }

    public function editarItemSolicitacao($idSolicitacao, $idLote, $quantidade){

    }

    public function excluirItemSolicitacao($idItemSolicitacao, $idLote){

    }

    public function consultarItemSolicitacao($idItemSolicitacao, $idLote){
        
    }

}