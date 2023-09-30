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

    public function getIdEstoque()
    {
        return $this->idEstoque;
    }

    public function setIdEstoque($idEstoque)
    {
        $this->idEstoque = $idEstoque;

        return $this;
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
        $sql = "insert into estoque values (NULL, :nome, :descricao, :idStatus)";
        $consulta = $this->conexao()->prepare($sql);
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
        $sql = "update estoque SET nome=:nome, descricao=:descricao, idStatus=:idStatus where idEstoque=:idEstoque";
        $consulta = $this->conexao()->prepare($sql);
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
        //verificar se não há lotes cadastrados com esse estoque
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from estoque where idEstoque=:idEstoque";
            $consulta = $this->conexao()->prepare($sql);
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
        $consulta = $this->conexao()->prepare($sql);
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
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idEstoque", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    
}