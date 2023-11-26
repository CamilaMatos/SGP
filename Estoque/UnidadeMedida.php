<?php
require_once "./Classes/Conecta.php";
class UnidadeMedida {
    private $nome;
    private $pdo;
    private $descricao;

    public function __construct($nome, $descricao)
    {
        $this->nome = $nome;
        $this->pdo = $this->conexao();
        $this->descricao = $descricao;
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

    public function conexao()
    {
        $conectar = new Conecta();
        $pdo = $conectar->conectar();

        return $pdo;
    }

    public function cadastrarUnidadeMedida(){
        $id = null;
        if(empty($this->unidadeMedidaPorNome($id))) {
            $sql = "insert into unidadeMedida values (NULL, :nome, :descricao)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":descricao", $this->descricao);

            if ($consulta->execute()) {
                $resultado = $this->pdo->lastInsertId();//sucesso
            } else {
                $resultado = "E"; //erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro dessa unidade de medida
        }

        return $resultado;
    }

    public function editarUnidadeMedida($id){
        if(empty($this->unidadeMedidaPorNome($id))) {
            $sql = "update unidadeMedida SET nome=:nome, descricao=:descricao where idUnidadeMedida=:idUnidadeMedida";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":idUnidadeMedida", $id);
            $consulta->bindParam(":descricao", $descricao);

            if ($consulta->execute()) {
                $resultado = "S"; //sucesso
            } else {
                $resultado = "E"; //erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro dessa unidade de medida
        }

        return $resultado;
    }

    public function excluirUnidadeMedida($id){
        //verificar se não há itens cadastrados com essa unidade de medida
        if (empty($this->verificarRegistros($id))) {
            $sql = "delete from unidadeMedida where idUnidadeMedida=:idUnidadeMedida";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idUnidadeMedida", $id);

            if ($consulta->execute()) {
                $resultado = "S"; //sucesso
            } else {
                $resultado = "E"; //erro
            }
        } else {
            $resultado = "R"; //operação recusada
        }

        return $resultado;
    }

    public function verificarRegistros($id){
        $sql = "select * from item where idUnidadeMedida=:idUnidadeMedida";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idUnidadeMedida", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function unidadeMedidaPorNome($id){
        if($id == null){
            $sql = "select * from unidadeMedida where nome=:nome";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        } else {
            $sql = "select * from unidadeMedida where nome=:nome and not(idUnidadeMedida=:id)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":id", $id);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        }
        return $resultado;
    }
}
