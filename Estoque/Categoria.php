<?php
require_once "./Classes/Conecta.php";
class Categoria {
    private $idCategoria;
    private $nome;
    private $pdo;

    public function __construct($idCategoria, $nome)
    {
        $this->idCategoria = $idCategoria;
        $this->nome = $nome;
        $this->pdo = $this->conexao();
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function cadastrarCategoria(){
        $sql = "insert into categoria values (NULL, :nome)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);

        if ($consulta->execute()) {
            $resultado = $this->pdo->lastInsertId();//sucesso
        } else {
            $resultado = "E";//erro
        };
        return $resultado;
    }

    public function editarCategoria($id){
        $sql = "update categoria SET nome=:nome where idCategoria=:idCategoria";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":idCategoria", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function excluirCategoria($id){
        //verificar se não há itens cadastrados com essa categoria
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from categoria where idCategoria=:idCategoria";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idCategoria", $id);

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
        $sql = "select idCategoria from item where idCategoria=:idCategoria";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idCategoria", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    
}