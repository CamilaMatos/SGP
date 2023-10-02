<?php
require_once "Conecta.php";
require_once "Consultar.php";
require_once "Lote.php";
class Movimentacao {
    private $idMovimentacao;
    private $idSolicitacao;
    private $idUsuario;
    private $idStatus;
    private $data;

    public function __construct($idMovimentacao, $idSolicitacao, $idUsuario, $idStatus, $data)
    {
        $this->idMovimentacao = $idMovimentacao;
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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function realizarMovimentacao(){
        $sql = "insert into movimentacao values (NULL, :idSolicitacao, :idUsuario, :idStatus, :data)";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":data", $this->data);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        $sql = "select * from itensSolicitacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->execute();
        
        while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            $this->baixarItem($dados->idLote);
        };
        
        return $resultado;
    }

    public function realizarTransferencia(){
        $sql = "insert into movimentacao values (NULL, :idSolicitacao, :idUsuario, :idStatus, :data)";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":data", $this->data);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        $sql = "select * from itensSolicitacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->execute();
        
        while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            $lote = $this->buscarLote($dados->idLote);
            $solicitacao = $this->buscarSolicitacao($this->idSolicitacao);
            $loteNovo = new Lote(null, $lote->idItem, $solicitacao->idEstoque, $dados->quantidade, $dados->quantidade, $lote->validade, $lote->valorUnitario);
            $loteNovo->inserirLote();
            $this->baixarItem($dados->idLote);
        };
        
        return $resultado;

    }

    public function baixarItem($idLote) {
        $qtdSolicitada = $this->verificarQuantidade($idLote);
        $consultar = new Consultar($idLote, NULL);
        $qtdLote = $consultar->quantidadeLote();
        $quantidade = $qtdLote->quantidadeAtual - $qtdSolicitada->quantidade;
        $sql = "update lote SET quantidadeAtual=:quantidadeAtual where idLote=:idLote";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":quantidadeAtual", $quantidade);
        $consulta->bindParam(":idLote", $idLote);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function verificarQuantidade($id) {
        $sql = "select quantidade from itensSolicitacao where idSolicitacao=:idSolicitacao and idLote=:idLote";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idLote", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function buscarLote($idLote) {
        $sql = "select * from lote where idLote=:idLote";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idLote", $idLote);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function buscarSolicitacao($idSolicitacao) {
        $sql = "select * from solicitacaoMovimentacao where idSolicitacaoMovimentacao=:idSolicitacao";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $idSolicitacao);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}