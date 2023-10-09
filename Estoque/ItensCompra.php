<?php
require_once "Conecta.php";
class ItensSolicitacao{
    private $idSolicitacao;
    private $idItem;
    private $quantidade;

    public function __construct($idSolicitacao, $idItem, $quantidade)
    {
        $this->idSolicitacao = $idSolicitacao;
        $this->idItem = $idItem;
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
 
    public function getIdItem()
    {
        return $this->idItem;
    }

    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;

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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function inserirItemCompra(){
        $sql = "insert into itensCompra values (:idSolicitacao, :idItem, :quantidade)";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idItem", $this->idItem);
        $consulta->bindParam(":quantidade", $this->quantidade);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarItemCompra($id, $idItem){
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "update itensCompra SET quantidade=:quantidade where idSolicitacao=:idSolicitacao and idItem=:idItem";
            $consulta = $this->conexao()->prepare($sql);
            $consulta->bindParam(":quantidade", $this->quantidade);
            $consulta->bindParam(":idSolicitacao", $id);
            $consulta->bindParam(":idItem", $idItem);

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

    public function excluirItemCompra($id, $idItem){
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from itensCompra where idSolicitacao=:idSolicitacao and idItem=:idItem";
            $consulta = $this->conexao()->prepare($sql);
            $consulta->bindParam(":idSolicitacao", $id);
            $consulta->bindParam(":idItem", $idItem);

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
        $sql = "select * from movimentacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

}