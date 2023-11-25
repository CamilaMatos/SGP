<?php
require_once "./Classes/Conecta.php";

class CentroCusto {
    private $nome;
    private $descricao;
    private $idStatus;
    private $pdo;

    public function __construct($nome, $descricao, $idStatus)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->idStatus = $idStatus;
        $this->pdo = $this->conexao();
    }
 
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
 
    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function cadastrarCentroCusto(){
        $id = null;
        if(empty($this->centroCustoPorNome($id))){
            $sql = "insert into centroCusto values (NULL, :nome, :descricao, :idStatus)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":descricao", $this->descricao);
            $consulta->bindParam(":idStatus", $this->idStatus);
    
            if ($consulta->execute()) {
                $resultado = $this->pdo->lastInsertId();//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro desse centro de custo
        }

        return $resultado;
    }

    public function editarCentroCusto($id){
        if(empty($this->centroCustoPorNome($id))){
            $sql = "update centroCusto SET nome=:nome, descricao=:descricao, idStatus=:idStatus where idCentroCusto=:idCentroCusto";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":descricao", $this->descricao);
            $consulta->bindParam(":idStatus", $this->idStatus);
            $consulta->bindParam(":idCentroCusto", $id);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro desse centro de custo
        }

        return $resultado;
    }

    public function excluirCentroCusto($id){
        //verificar se não há itens cadastrados com essa categoria
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from centroCusto where idCentroCusto=:idCentroCusto";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idCentroCusto", $id);

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

    public function alterarStatusCentroCusto($id){
        $sql = "update centroCusto SET idStatus=:idStatus where idCentroCusto=:idCentroCusto";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idCentroCusto", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function verificarRegistros($id) {
        $sql = "select * from solicitacao where idCentroCusto=:centroCusto";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":centroCusto", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function centroCustoPorNome($id){
        if($id == null){
            $sql = "select * from centroCusto where nome=:nome";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        } else {
            $sql = "select * from centroCusto where nome=:nome and idCentroCusto=:id";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":id", $id);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        }

        return $resultado;
    } 
}