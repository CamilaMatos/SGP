<?php
require_once "./Classes/Conecta.php";
class Marca {
    private $idMarca;
    private $nome;
    private $pdo;

    public function __construct($idMarca, $nome)
    {
        $this->idMarca = $idMarca;
        $this->nome = $nome;
        $this->pdo = $this->conexao();
    }
     
    public function getIdMarca()
    {
        return $this->idMarca;
    }

    public function setIdMarca($idMarca)
    {
        $this->idMarca = $idMarca;

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

    public function cadastrarMarca(){
        $sql = "insert into marca values (NULL, :nome)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);

        if ($consulta->execute()) {
            $resultado = $this->pdo->lastInsertId();//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarMarca($id){
        $sql = "update marca SET nome=:nome where idMarca=:idMarca";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":idMarca", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function excluirMarca($id){
        //verificar se não há itens cadastrados com essa marca
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from marca where idMarca=:idMarca";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idMarca", $id);

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
        $sql = "select * from item where idMarca=:idMarca";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idMarca", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

}