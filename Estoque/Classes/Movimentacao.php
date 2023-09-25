<?php
require_once "Conecta.php";
require_once "Consultar.php";
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

    public function registrarMovimentacao(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into movimentacao values (NULL, :idSolicitacao, :idUsuario, :idStatus, :data)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":data", $this->data);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function baixarItem($idLote) {
        $qtdSolicitada = $this->verificarQuantidade($idLote);
        $consulta = new Consultar($idLote, NULL);
        $qtdLote = $consulta->quantidadeLote();
        $quantidade = $qtdLote->quantidadeAtual - $qtdSolicitada->quantidade;
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update lote SET quantidadeAtual=:quantidadeAtual where idLote=:idLote";
        $consulta = $pdo->prepare($sql);
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
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select quantidade from itensSolicitacao where idSolicitacao=:idSolicitacao and idLote=:idLote";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idLote", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}