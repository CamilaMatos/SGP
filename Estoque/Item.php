<?php
require_once "./Classes/Conecta.php";
class Item{
    private $nome;
    private $unidadeMedia;
    private $idCategoria;
    private $idMarca;
    private $idUnidadeMedida;
    private $idStatus;
    private $pdo;

    public function __construct($nome, $unidadeMedia, $idCategoria, $idMarca, $idUnidadeMedida, $idStatus)
    {
        $this->nome = $nome;
        $this->unidadeMedia = $unidadeMedia;
        $this->idCategoria = $idCategoria;
        $this->idMarca = $idMarca;
        $this->idUnidadeMedida = $idUnidadeMedida;
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
 
    public function getunidadeMedia()
    {
        return $this->unidadeMedia;
    }


    public function setunidadeMedia($unidadeMedia)
    {
        $this->unidadeMedia = $unidadeMedia;

        return $this;
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
 
    public function getIdMarca()
    {
        return $this->idMarca;
    }


    public function setIdMarca($idMarca)
    {
        $this->idMarca = $idMarca;

        return $this;
    }
 
    public function getidUnidadeMedida()
    {
        return $this->idUnidadeMedida;
    }


    public function setidUnidadeMedida($idUnidadeMedida)
    {
        $this->idUnidadeMedida = $idUnidadeMedida;

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

    public function cadastrarItem(){
        if(empty($this->itemPorNome())) {
            $sql = "insert into item values (NULL, :nome, :unidadeMedia, :idCategoria, :idMarca, :idUnidadeMedida, :idStatus)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":unidadeMedia", $this->unidadeMedia);
            $consulta->bindParam(":idCategoria", $this->idCategoria);
            $consulta->bindParam(":idMarca", $this->idMarca);
            $consulta->bindParam(":idUnidadeMedida", $this->idUnidadeMedida);
            $consulta->bindParam(":idStatus", $this->idStatus);

            if ($consulta->execute()) {
                $resultado = $this->pdo->lastInsertId();//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro desse item
        }

        return $resultado;
    }

    public function editarItem($id){
        if(empty($this->itemPorNome())) {
            $sql = "update item SET nome=:nome, unidadeMedia=:unidadeMedia, idCategoria=:idCategoria, idMarca=:idMarca, idUnidadeMedida=:idUnidadeMedida, idStatus=:idStatus where idItem=:idItem";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":unidadeMedia", $this->unidadeMedia);
            $consulta->bindParam(":idCategoria", $this->idCategoria);
            $consulta->bindParam(":idMarca", $this->idMarca);
            $consulta->bindParam(":idUnidadeMedida", $this->idUnidadeMedida);
            $consulta->bindParam(":idStatus", $this->idStatus);
            $consulta->bindParam(":idItem", $id);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro desse item
        }

        return $resultado;
    }

    public function excluirItem($id){
        //verificar se não há lotes cadastrados com esse item
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from item where idItem=:idItem";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idItem", $id);

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

    public function alterarStatusItem($id){
        $sql = "update item SET idStatus=:idStatus where idItem=:idItem";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idStatus", $this->idStatus);
        $consulta->bindParam(":idItem", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function verificarRegistros($id) {
        $sql = "select * from lote where idItem=:idItem";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idItem", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function itemPorNome(){
        $sql = "select * from item where nome=:nome";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}