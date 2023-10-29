<?php
require_once "../Classes/Conecta.php";
require_once "Consultar.php";
require_once "Lote.php";
class Movimentacao {
    private $idSolicitacao;
    private $idUsuario;
    private $idStatus;
    private $data;
    private $pdo;

    public function __construct($idSolicitacao, $idUsuario, $idStatus, $data)
    {
        $this->idSolicitacao = $idSolicitacao;
        $this->idUsuario = $idUsuario;
        $this->idStatus = $idStatus;
        $this->data = date('Y-m-d');
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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function realizarMovimentacao(){
        $sql = "insert into movimentacao values (NULL, :idSolicitacao, :idUsuario, :idStatus, :data)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":data", $this->data);

        if ($consulta->execute()) {
            $resultado = $this->pdo->lastInsertId();//sucesso
        } else {
            $resultado = "E";//erro
        }

        $sql = "select * from itensMovimentacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->execute();
        
        while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            $this->baixarItem($dados->idLote);
        };
        
        return $resultado;
    }

    public function realizarTransferencia(){
        $sql = "insert into movimentacao values (NULL, :idSolicitacao, :idUsuario, :idStatus, :data)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":data", $this->data);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        $sql = "select * from itensMovimentacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->execute();
        
        while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            $lote = $this->buscarLote($dados->idLote);
            $solicitacao = $this->buscarSolicitacao($this->idSolicitacao);
            $loteNovo = new Lote(null, $lote->idItem, $solicitacao->idEstoque, $dados->quantidade, $dados->quantidade, $lote->validade, $lote->valorUnitario);
            $loteNovo->inserirLote($solicitacao->idUsuario);
            $this->baixarItem($dados->idLote);
        };
        
        return $resultado;

    }

    public function baixarItem($idLote) {
        $qtdSolicitada = $this->verificarQuantidade($idLote);
        $consultar = new Consultar($idLote, NULL);
        $qtdLote = $consultar->quantidadeLote();
        if($qtdLote->quantidadeAtual>=$qtdSolicitada->quantidade){
            $quantidade = $qtdLote->quantidadeAtual - $qtdSolicitada->quantidade;
            $sql = "update lote SET quantidadeAtual=:quantidadeAtual where idLote=:idLote";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":quantidadeAtual", $quantidade);
            $consulta->bindParam(":idLote", $idLote);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "I";//saldo Insuficiente
        }

        return $resultado;
    }

    public function verificarQuantidade($id) {
        $sql = "select quantidade from itensMovimentacao where idSolicitacao=:idSolicitacao and idLote=:idLote";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idLote", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function buscarLote($idLote) {
        $sql = "select * from lote where idLote=:idLote";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idLote", $idLote);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function buscarSolicitacao($idSolicitacao) {
        $sql = "select * from solicitacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $idSolicitacao);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function consultarEstoqueItem($idItem, $idEstoque){
        $sql = "select SUM(quantidadeAtual) from lote where idItem=:idItem and idEstoque=:idEstoque";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idItem", $idItem);
        $consulta->bindParam(":idEstoque", $idEstoque);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }    
}