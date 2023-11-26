<?php
require_once "./Classes/Conecta.php";
class ItensSolicitacao{
    private $idSolicitacao;
    private $idLote;
    private $quantidade;
    private $idItem;
    private $idEstoque;
    private $pdo;

    public function __construct($idSolicitacao, $idLote, $quantidade, $idItem, $idEstoque)
    {
        $this->idSolicitacao = $idSolicitacao;
        $this->idLote = $idLote;
        $this->quantidade = $quantidade;
        $this->idItem = $idItem;
        $this->idEstoque = $idEstoque;
        $this->pdo = $this->conexao();
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

    public function getIdItem()
    {
        return $this->idItem;
    }

    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;

        return $this;
    }

    public function getIdEstoque()
    {
        return $this->idEstoque;
    }

    public function setIdEstoque($idEstoque)
    {
        $this->idEstoque = $idEstoque;

        return $this;
    }

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function inserirItemSolicitacao($quantidade){
        if(empty($this->consultarExistenciaItem())){
            //verificar se a solicitação ainda não foi atendida
            if(empty($this->verificarRegistros($this->idSolicitacao))){
                $sql = "insert into itensSolicitacao values (:idSolicitacao, :idItem, :quantidade)";
                $consulta = $this->pdo->prepare($sql);
                $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
                $consulta->bindParam(":idItem", $this->idItem);
                $consulta->bindParam(":quantidade", $quantidade);

                if ($consulta->execute()) {
                    $resultado = "S";//sucesso
                } else {
                    $resultado = "E";//erro
                }
            }else {
                    $resultado = "R";//operação recusada
                }
            
        } else{
            $resultado = "D";//item já inserido
        }

        return $resultado;
    }

    public function consultarExistenciaItem() {
        $sql = "select * from itensSolicitacao where idSolicitacao=:idSolicitacao and idItem=:idItem";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function inserirItemMovimentacao($quantidade){
        $sql = "insert into itensMovimentacao values (:idSolicitacao, :idLote, :quantidade)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idLote", $this->idLote);
        $consulta->bindParam(":quantidade", $quantidade);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarItemMovimentacao($idSolicitacao, $idItem){
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($idSolicitacao))){
            $sql = "select i.idSolicitacao, i.idLote, l.idItem from itensMovimentacao i 
            inner join lote l on (i.idLote = l.idLote)
            where l.idItem=:idItem and i.idSolicitacao=:idSolicitacao";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idItem", $idItem);
            $consulta->bindParam(":idSolicitacao", $idSolicitacao);
            $consulta->execute();
            while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                $this->excluirItemLote($idSolicitacao, $dados->idLote);
            }
            $this->quebrarLotes();
            $resultado = "S";//sucesso
        } else {
            $resultado = "R";//operação recusada
        }

        return $resultado;
    }

    public function editarItemSolicitacao($idSolicitacao, $idItem, $quantidade){
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($idSolicitacao))){
            $sql = "update itensSolicitacao SET quantidade=:quantidade where idItem=:idItem and idSolicitacao=:idSolicitacao";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":quantidade", $quantidade);
            $consulta->bindParam(":idItem", $idItem);
            $consulta->bindParam(":idSolicitacao", $idSolicitacao);
            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//operação recusada
        }

        return $resultado;
    }

    public function excluirItemMovimentacao($idSolicitacao, $idItem){
            $resultado= "Erro";
            $sql = "select i.idLote from itensMovimentacao i 
            inner join lote l on (i.idLote = l.idLote)
            where l.idItem=:idItem and i.idSolicitacao=:idSolicitacao";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idItem", $idItem);
            $consulta->bindParam(":idSolicitacao", $idSolicitacao);
            $consulta->execute();
            while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                $resultado = $this->excluirItemLote($idSolicitacao, $dados->idLote);
            }
            return $resultado;
    }

    public function excluirItemLote($id, $idLote){
        $sql = "delete from itensMovimentacao where idSolicitacao=:idSolicitacao and idLote=:idLote";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $id);
        $consulta->bindParam(":idLote", $idLote);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function excluirItemSolicitacao($id, $idItem, $qtd){
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from itensSolicitacao where idSolicitacao=:idSolicitacao and idItem=:idItem";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idSolicitacao", $id);
            $consulta->bindParam(":idItem", $idItem);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
                $sql = "insert into excluirTemporario values (:idSolicitacao, :idItem, :quantidade)";
                $consulta = $this->pdo->prepare($sql);
                $consulta->bindParam(":idSolicitacao", $id);
                $consulta->bindParam(":idItem", $idItem);
                $consulta->bindParam(":quantidade", $qtd);
                if ($consulta->execute()) {
                    $resultado = "S";//sucesso
                } else {
                    $resultado = "E";//erro
                }
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//operação recusada
        }

        return $resultado;
    }

    public function verificarRegistros($id) {
        $sql = "select * from movimentacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function selecionarLote(){
        $sql = "select idLote, quantidadeAtual, Min(validade) from lote where idItem=:idItem and quantidadeAtual>0 and idEstoque=:idEstoque and idLote not in (select idLote from itensMovimentacao where idSolicitacao=:idSolicitacao)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function quebrarLotes(){
        $qtd = $this->consultarEstoqueItem();
        if($qtd>=$this->quantidade){
            while($this->quantidade>0){
                $lote = $this->selecionarLote();
                $this->setIdLote($lote->idLote);
                if($lote->quantidadeAtual>=$this->quantidade){
                    $this->inserirItemMovimentacao($this->quantidade);
                    $this->setQuantidade(0);
                } else{
                    $this->inserirItemMovimentacao($lote->quantidadeAtual);
                    $quantidade= $this->quantidade-$lote->quantidadeAtual;
                    $this->setQuantidade($quantidade);
                }
            $resultado = "S";//sucesso
            }
        } else {
            $resultado = "I";//saldo insuficiente
        }

        return $resultado;
    }

    public function consultarEstoqueItem(){
        $sql = "select SUM(quantidadeAtual) as qtd from lote where idItem=:idItem and idEstoque=:idEstoque";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        $resultado = $resultado->qtd;

        return $resultado;
    }    

}