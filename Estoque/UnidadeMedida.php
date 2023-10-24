<?php
require_once "../Classes/Conecta.php";
class UnidadeMedida {
    private $idUnidadeMedida;
    private $nome;
    private $pdo;
    private $descricao;

    public function __construct($idUnidadeMedida, $nome, $descricao)
    {
        $this->idUnidadeMedida = $idUnidadeMedida;
        $this->nome = $nome;
        $this->pdo = $this->conexao();
        $this->descricao = $descricao;
    }

    public function getIdUnidadeMedida()
    {
        return $this->idUnidadeMedida;
    }

    public function setIdUnidadeMedida($idUnidadeMedida)
    {
        $this->idUnidadeMedida = $idUnidadeMedida;

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

    public function conexao()
    {
        $conectar = new Conecta();
        $pdo = $conectar->conectar();

        return $pdo;
    }

    public function cadastrarUnidadeMedida(){
        $sql = "insert into unidadeMedida values (NULL, :nome, :descricao)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":descricao", $this->descricao);

        if ($consulta->execute()) {
            $resultado = $this->pdo->lastInsertId();//sucesso
        } else {
            $resultado = "E"; //erro
        }

        return $resultado;
    }

    public function editarUnidadeMedida($id){
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

        return $resultado;
    }

    public function excluirUnidadeMedida($id)
    {
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

    public function verificarRegistros($id)
    {
        $sql = "select * from item where idUnidadeMedida=:idUnidadeMedida";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idUnidadeMedida", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}
