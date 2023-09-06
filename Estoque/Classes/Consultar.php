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
        $resultado = $consulta->execute();

        return $resultado;
    }

    public function centroCustoPorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from centroCusto where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $resultado = $consulta->execute();

        return $resultado;
    }

    public function usuarioPorId(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from usuario where idUsuario=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1);
        $resultado = $consulta->execute();

        return $resultado;
    }

    public function usuarioPorNome(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $parametro1 = "%{$this->parametro1}%";
        $sql = "select * from usuario where nome like :parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $parametro1);
        $resultado = $consulta->execute();

        return $resultado;
    }

    public function usuarioPorNasc(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from usuario where dataNasc between :parametro1 and :parametro2";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $consulta->bindParam(":parametro1", $this->parametro2);
        $resultado = $consulta->execute();

        return $resultado;
    }

    public function usuarioPorDocumento(){
        $conectar = new Conecta();
        $pdo = $conectar->conectar();
        $sql = "select * from usuario where documento=:parametro1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":parametro1", $this->parametro1); 
        $resultado = $consulta->execute();

        return $resultado;
    }
    

    public function usuarioPorTipo()
    {
        
    }

    public function usuarioPorLogin()
    {
        
    }

    public function consultarEstoque()
    {
        
    }

    public function consultarCategoria()
    {
        
    }

    public function consultarMarca()
    {
      
    }

    public function consultarUnidadeMedida()
    {
        
    }

    public function consultarItem()
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

    public function consultarLote(){
        
    }

}