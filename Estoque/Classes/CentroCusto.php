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

    public function cadastrarCentroCusto(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into centroCusto values (NULL, :nome, :descricao, :idStatus)";
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

    public function editarCentroCusto(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update centroCusto SET nome=:nome, descricao=:descricao where idCentroCusto=:idCentroCusto";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":descricao", $this->descricao);
        $consulta->bindParam(":idCentroCusto", $this->idCentroCusto);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "S";//erro
        }

        return $resultado;
    }

    public function excluirCentroCusto(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se não há itens cadastrados com essa categoria
        if(empty($this->verificarRegistros())){
            $sql = "delete from centroCusto where idCentroCusto=:idCentroCusto";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":idCentroCusto", $this->idCentroCusto);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "N";//erro
            }
        } else {
            $resultado = "R";//operação recusada, não é permitido excluir categorias com item registrados
        }

        return $resultado;
    }

    public function alterarStatusCentroCusto($idCentroCusto, $idStatus){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update centroCusto SET idStatus=:idStatus where idCentroCusto=:idCentroCusto";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idCentroCustoStatus", $this->idCentroCusto);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "S";//erro
        }

        return $resultado;
    }

    public function verificarRegistros() {
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from solicitacao where idCentroCusto=:idCentroCusto";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idCentroCusto", $this->idCentroCusto);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

}