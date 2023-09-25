<?php
require_once "Conecta.php";
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

    public function inserirItemSolicitacao(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into itensSolicitacao values (:idSolicitacao, :idLote, :quantidade)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idLote", $this->idLote);
        $consulta->bindParam(":quantidade", $this->quantidade);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarItemSolicitacao($id, $idLote){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "update itensSolicitacao SET quantidade=:quantidade where idSolicitacao=:idSolicitacao and idLote=:idLote";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":quantidade", $this->quantidade);
            $consulta->bindParam(":idSolicitacao", $id);
            $consulta->bindParam(":idLote", $idLote);

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

    public function excluirItemSolicitacao($id, $idLote){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from itensSolicitacao where idSolicitacao=:idSolicitacao and idLote=:idLote";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":idSolicitacao", $id);
            $consulta->bindParam(":idLote", $idLote);

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

    public function verificarRegistros($id) {
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from movimentacao where idSolicitacao=:idSolicitacao";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

}