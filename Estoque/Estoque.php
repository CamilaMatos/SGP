<?php
require_once "./Classes/Conecta.php";
class Estoque {
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

    public function cadastrarEstoque(){
        if(empty($this->estoquePorNome())){
            $sql = "insert into estoque values (NULL, :nome, :descricao, :idStatus)";
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
            $resultado = "R";//recusado pois já existe cadastro desse estoque
        }
        
        return $resultado;
    }

    public function editarEstoque($id){
        if(empty($this->estoquePorNome())){
            $sql = "update estoque SET nome=:nome, descricao=:descricao, idStatus=:idStatus where idEstoque=:idEstoque";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":descricao", $this->descricao);
            $consulta->bindParam(":idStatus", $this->idStatus);
            $consulta->bindParam(":idEstoque", $id);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro desse estoque
        }

        return $resultado;
    }

    public function excluirEstoque($id){
        //verificar se não há lotes cadastrados com esse estoque
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from estoque where idEstoque=:idEstoque";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idEstoque", $id);

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

    public function alterarStatusEstoque($id){
        $sql = "update estoque SET idStatus=:idStatus where idEstoque=:idEstoque";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idEstoqueStatus", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function verificarRegistros($id) {
        $sql = "select idEstoque from lote where idEstoque=:idEstoque";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idEstoque", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function estoquePorNome(){
        $sql = "select * from estoque where nome=:nome";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    
}