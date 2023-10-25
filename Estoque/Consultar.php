<?php
require_once "./Classes/Conecta.php";
class Consultar {
    private $parametro1;
    private $parametro2;
    private $pdo;


    public function __construct($parametro1, $parametro2)
    {
        $this->parametro1 = $parametro1;
        $this->parametro2 = $parametro2;
        $this->pdo = $this->conexao();
    }

    public function getParametro1()
    {
        return $this->parametro1;
    }

    public function setParametro1($parametro1)
    {
        $this->parametro1 = $parametro1;

        return $this;
    }

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function centroCustoPorId(){
        $sql = "select * from centroCusto where idCentroCusto=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function centroCustoPorNome(){
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from centroCusto where nome like :parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorId(){
        $sql = "select * from usuario where idUsuario=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorNome(){
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from usuario where nome like :parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorNasc(){
        $sql = "select * from usuario where dataNasc between :parametro1 and :parametro2";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->bindParam(":parametro1", $this->parametro2);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorDocumento(){
        $sql = "select * from usuario where documento=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
    

    public function usuarioPorTipo(){
        $sql = "select * from usuario where idTipo=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorLogin(){
        $sql = "select * from usuario where login=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function estoquePorId(){
        $sql = "select * from estoque where idEstoque=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function estoquePorNome(){
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from estoque where nome like :parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function categoriaPorId(){
        $sql = "select * from categoria where idCategoria=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function categoriaPorNome(){
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from categoria where nome like :parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function marcaPorId(){
        $sql = "select * from marca where idMarca=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function marcaPorNome(){
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from marca where nome like :parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function unidadeMedidaPorId(){
        $sql = "select * from unidadeMedida where idUnidadeMedida=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function unidadeMedidaPorNome(){
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from unidadeMedida where nome like :parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function unidadeMedidaPorDescricao(){
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from unidadeMedida where descricao like :parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function itemPorId(){
        $sql = "select * from item where idItem=:parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function itemPorNome(){
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from item where nome like :parametro1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function itemPorCategoria(){
        $sql = "select * from item where idCategoria=:parametro1 and nome like :parametro2";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->bindParam(":parametro2", $this->parametro2);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);


        return $resultado;
    }

    public function quantidadeLote(){
        $sql = "select quantidadeAtual from lote where idLote=:idLote";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idLote", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

}