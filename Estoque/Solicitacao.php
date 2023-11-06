<?php
require_once "./Classes/Conecta.php";
class Solicitacao {
    private $idTipo;
    private $idCentroCusto;
    private $idStatus;
    private $idSolicitante;
    private $idEstoque;
    private $data;
    private $necessidade;
    private $pdo;

    public function __construct($idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $necessidade)
    {
        $this->idTipo = $idTipo;
        $this->idCentroCusto = $idCentroCusto;
        $this->idStatus = $idStatus;
        $this->idSolicitante = $idSolicitante;
        $this->idEstoque = $idEstoque;
        $this->data = date('Y-m-d');;
        $this->necessidade = $necessidade;
        $this->pdo = $this->conexao();
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
 
    public function getIdCentroCusto()
    {
        return $this->idCentroCusto;
    }

    public function setIdCentroCusto($idCentroCusto)
    {
        $this->idCentroCusto = $idCentroCusto;

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

    public function getIdEstoque()
    {
        return $this->idEstoque;
    }

    public function setIdEstoque($idEstoque)
    {
        $this->idEstoque = $idEstoque;

        return $this;
    }
 
    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getNecessidade()
    {
        return $this->necessidade;
    }

    public function setNecessidade($necessidade)
    {
        $this->necessidade = $necessidade;

        return $this;
    }

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function solicitarRequisicao(){
        $sql = "insert into solicitacao values (NULL, :idTipo, :idCentroCusto, :idEstoque, :idStatus, :idSolicitante, :data, :necessidade)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idTipo", $this->idTipo);
        $consulta->bindParam(":idCentroCusto", $this->idCentroCusto);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idSolicitante", $this->idSolicitante);
        $consulta->bindParam(":data", $this->data);
        $consulta->bindParam(":necessidade", $this->necessidade);

        if ($consulta->execute()) {
            $resultado = $this->pdo->lastInsertId();//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function solicitarTransferencia(){
        $sql = "insert into solicitacao values (NULL, 3, NULL, :idEstoque, :idStatus, :idSolicitante, :data, :necessidade)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idSolicitante", $this->idSolicitante);
        $consulta->bindParam(":data", $this->data);
        $consulta->bindParam(":necessidade", $this->necessidade);

        if ($consulta->execute()) {
            $resultado = $this->pdo->lastInsertId();//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function alterarNecessidade($id){
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "update solicitacao SET necessidade=:necessidade where idSolicitacao=:idSolicitacao";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":necessidade", $this->necessidade);
            $consulta->bindParam(":idSolicitacao", $id);

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

    public function excluirSolicitacao($id){
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from solicitacao where idSolicitacao=:idSolicitacao";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idSolicitacao", $id);

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

    public function alterarStatusSolicitacao($id){
        $sql = "update solicitacao SET idStatus=:idStatus where idSolicitacao=:idSolicitacao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idSolicitacao", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
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