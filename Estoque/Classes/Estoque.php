<?php
require_once "Conecta.php";
class Estoque {
    private $idEstoque;
    private $nome;
    private $descricao;
    private $idStatus;

    public function __construct($idEstoque, $nome, $descricao, $idStatus)
    {
        $this->idEstoque = $idEstoque;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->idStatus = $idStatus;
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

    public function cadastrarEstoque(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into estoque values (NULL, :nome, :descricao, :idStatus)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":descricao", $this->descricao);
        $consulta->bindParam(":idStatus", $this->idStatus);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarEstoque($id){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update estoque SET nome=:nome, descricao=:descricao, idStatus=:idStatus where idEstoque=:idEstoque";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":descricao", $this->descricao);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idEstoque", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function excluirEstoque($id){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se não há lotes cadastrados com esse estoque
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from estoque where idEstoque=:idEstoque";
            $consulta = $pdo->prepare($sql);
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
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update estoque SET idStatus=:idStatus where idEstoque=:idEstoque";
        $consulta = $pdo->prepare($sql);
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
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select idEstoque from lote where idEstoque=:idEstoque";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idEstoque", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

}