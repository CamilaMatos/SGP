<?php
require_once "./Classes/Conecta.php";
require_once "Consultar.php";

class Categoria {
    private $nome;
    private $pdo;

    public function __construct($nome)
    {
        $this->nome = $nome;
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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function cadastrarCategoria(){
        $id = null;
        if(empty($this->categoriaPorNome($id))) {
            $sql = "insert into categoria values (NULL, :nome)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);

            if ($consulta->execute()) {
                $resultado = $this->pdo->lastInsertId();//sucesso
            } else {
                $resultado = "E";//erro
            };
        } else {
                $resultado = "R";//recusado pois já existe cadastro dessa categoria
        }
        
        return $resultado;
    }

    public function editarCategoria($id){
        if(empty($this->categoriaPorNome($id))) {
            $sql = "update categoria SET nome=:nome where idCategoria=:idCategoria";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":idCategoria", $id);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro dessa categoria
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

    public function categoriaPorNome($id){
        if($id == null){
            $sql = "select * from categoria where nome=:nome";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        } else {
            $sql = "select * from categoria where nome=:nome and idCategoria=:id";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":id", $id);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        }

        return $resultado;
    }
}