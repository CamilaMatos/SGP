<?php
require_once "../Classes/Conecta.php";
class ReceitaServico {
    private $idOrdem;
    private $idItem;
    private $quantidade;
    private $pdo;

    public function __construct($idOrdem, $idItem, $quantidade)
    {
        $this->idOrdem = $idOrdem;
        $this->idItem = $idItem;
        $this->quantidade = $quantidade;
        $this->pdo = $this->conexao();
    }

    public function getIdOrdem()
    {
        return $this->idOrdem;
    }

    public function setIdOrdem($idOrdem)
    {
        $this->idOrdem = $idOrdem;

        return $this;
    }
 
    public function getIdItem()
    {
        return $this->idItem;
    }

    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;

        return $this;
    }
 
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }
    
    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function editarIngrediente(){
        $sql = "update receitaServico SET quantidadeRealizada=:quantidadeRealizada where idOrdem=:idOrdem and idItem=:idItem";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":quantidadeRealizada", $this->quantidade);
        $consulta->bindParam(":idOrdem", $this->idOrdem);
        $consulta->bindParam(":idItem", $this->idItem);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }
}
?>