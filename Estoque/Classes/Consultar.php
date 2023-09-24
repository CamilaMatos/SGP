<?php
require_once "Conecta.php";
class Consultar {
    private $parametro1;
    private $parametro2;


    public function __construct($parametro1, $parametro2)
    {
        $this->parametro1 = $parametro1;
        $this->parametro2 = $parametro2;
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

    public function centroCustoPorId(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from centroCusto where idCentroCusto=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function centroCustoPorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from centroCusto where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorId(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from usuario where idUsuario=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from usuario where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorNasc(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from usuario where dataNasc between :parametro1 and :parametro2";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->bindParam(":parametro1", $this->parametro2);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorDocumento(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from usuario where documento=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
    

    public function usuarioPorTipo(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from usuario where idTipo=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function usuarioPorLogin(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from usuario where login=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function estoquePorId(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from estoque where idEstoque=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function estoquePorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from estoque where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function categoriaPorId(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from categoria where idCategoria=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function categoriaPorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from categoria where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function marcaPorId(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from marca where idMarca=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function marcaPorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from marca where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function unidadeMedidaPorId(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from unidadeMedida where idUnidadeMedida=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function unidadeMedidaPorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from unidadeMedida where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function unidadeMedidaPorDescricao(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from unidadeMedida where descricao like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function itemPorId(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from item where idItem=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function itemPorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from item where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function itemPorCategoria(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from item where idCategoria=:parametro1 and nome like :parametro2";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $consulta->bindParam(":parametro2", $this->parametro2);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);


        return $resultado;
    }

    public function itemPorMarca()
    {
        
    }
    public function itemPorUnidadeMedida()
    {
        
    }
    public function itemPorStatus()
    {
        
    }

    public function consultarSolicitacao()
    {
        
    }

    public function consultarMovimentacao()
    {
        
    }

    public function consultarItemSolicitacao($idSolicitacao, $idLote)
    {
        
    }

    public function quantidadeLote(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select quantidadeAtual from lote where idLote=:idLote";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idLote", $this->parametro1);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

}