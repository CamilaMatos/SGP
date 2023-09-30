<?php
require_once "Conecta.php";

class CentroCusto {
    private $idCentroCusto;
    private $nome;
    private $descricao;
    private $idStatus;

    public function __construct($idCentroCusto, $nome, $descricao, $idStatus)
    {
        $this->idCentroCusto = $idCentroCusto;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->idStatus = $idStatus;
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
        $sql = "insert into centroCusto values (NULL, :nome, :descricao, :idStatus)";
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

    public function editarCentroCusto($id){
        $sql = "update centroCusto SET nome=:nome, descricao=:descricao, idStatus=:idStatus where idCentroCusto=:idCentroCusto";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":descricao", $this->descricao);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idCentroCusto", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function excluirCentroCusto($id){
        //verificar se não há itens cadastrados com essa categoria
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from centroCusto where idCentroCusto=:idCentroCusto";
            $consulta = $this->conexao()->prepare($sql);
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
        $consulta = $this->conexao()->prepare($sql);
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
        $sql = "select * from solicitacaomovimentacao where centroCusto=:centroCusto";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":centroCusto", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    
}