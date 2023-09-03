<?php
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
        /*$sql = "insert into categoria values (NULL, :nome)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->execute();

        if ($consulta->execute()) {
            $resultado = "S";
        } else {
            $resultado = "S";
        }

        return $resultado;*/
    }

    public function editarCategoria($idCategoria, $nome){

    }

    public function excluirCategoria($idCategoria){

    }

}