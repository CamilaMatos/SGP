<?php
require_once "Conecta.php";
class Solicitacao {
    private $idSolicitacaoMovimentacao;
    private $idTipo;
    private $idCentroCusto;
    private $idStatus;
    private $idSolicitante;
    private $idEstoque;
    private $data;
    private $necessidade;

    public function __construct($idSolicitacaoMovimentacao, $idTipo, $idCentroCusto, $idStatus, $idSolicitante, $idEstoque, $data, $necessidade)
    {
        $this->idSolicitacaoMovimentacao = $idSolicitacaoMovimentacao;
        $this->idTipo = $idTipo;
        $this->idCentroCusto = $idCentroCusto;
        $this->idStatus = $idStatus;
        $this->idSolicitante = $idSolicitante;
        $this->idEstoque = $idEstoque;
        $this->data = $data;
        $this->necessidade = $necessidade;
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

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @returnself
     */ 
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

    public function solicitarRequisicao(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into solicitacao values (NULL, 2, :idCentroCusto, NULL, :idStatus, :idSolicitante, :data, :necessidade)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idCentroCusto", $this->idCentroCusto);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idSolicitante", $this->idSolicitante);
        $consulta->bindParam(":data", $this->data);
        $consulta->bindParam(":necessidade", $this->necessidade);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function solicitarTransferencia(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into solicitacao values (NULL, 3, NULL, :idEstoque, :idStatus, :idSolicitante, :data, :necessidade)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idEstoque", $this->idEstoque);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idSolicitante", $this->idSolicitante);
        $consulta->bindParam(":data", $this->data);
        $consulta->bindParam(":necessidade", $this->necessidade);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function alterarNecessidadeSolicitacao($id){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "update solicitacaoMovimentacao SET necessidade=:necessidade where idSolicitacao=:idSolicitacao";
            $consulta = $pdo->prepare($sql);
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
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se a solicitação ainda não foi atendida
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from solicitacaoMovimentacao where idSolicitacao=:idSolicitacao";
            $consulta = $pdo->prepare($sql);
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
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update solicitacaoMovimentacao SET idStatus=:idStatus where idSolicitacao=:idSolicitacao";
        $consulta = $pdo->prepare($sql);
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