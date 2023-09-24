<?php
require_once "Conecta.php";
class Marca {
    private $idMarca;
    private $nome;

    public function __construct($idMarca, $nome)
    {
        $this->idMarca = $idMarca;
        $this->nome = $nome;
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

    public function cadastrarMarca(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "insert into marca values (NULL, :nome)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function editarMarca($id){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "update marca SET nome=:nome where idMarca=:idMarca";
        $consulta = $pdo->prepare($sql);
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
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        //verificar se não há itens cadastrados com essa marca
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from marca where idMarca=:idMarca";
            $consulta = $pdo->prepare($sql);
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
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from item where idMarca=:idMarca";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idMarca", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

}