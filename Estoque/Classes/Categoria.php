<?php
require_once "Conecta.php";
class Categoria {
    private $idCategoria;
    private $nome;

    public function __construct($nome)
    {
        $this->nome = $nome;
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


    public function cadastrarCategoria(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into categoria values (NULL, :nome)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarCategoria(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update categoria SET nome=:nome where idCategoria=:idCategoria";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":idCategoria", $this->idCategoria);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "S";//erro
        }

        return $resultado;
    }

    public function excluirCategoria(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se não há itens cadastrados com essa categoria
        if(empty($this->verificarRegistros())){
            $sql = "delete categoria where idCategoria=:idCategoria";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":idCategoria", $this->idCategoria);

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

    public function verificarRegistros() {
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from item where idCategoria=:idCategoria";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idCategoria", $this->idCategoria);
        $resultado = $consulta->execute();

        return $resultado;
    }

}