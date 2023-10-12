<?php
require_once "../Classes/Conecta.php";
class OrdemServico {
    private $idOrdem;
    private $idReceita;
    private $idUsuario;
    private $entrega;
    private $rendimentoEsperado;
    private $rendimentoReal;
    private $observacao;
    private $status;
    private $horarioInicio;
    private $horarioFim;
    private $pdo;

    public function __construct($idOrdem, $idReceita, $idUsuario, $entrega, $rendimentoEsperado, $rendimentoReal, $observacao, $status, $horarioInicio, $horarioFim, )
    {
        $this->idOrdem = $idOrdem;
        $this->idReceita = $idReceita;
        $this->idUsuario = $idUsuario;
        $this->entrega = $entrega;
        $this->rendimentoEsperado = $rendimentoEsperado;
        $this->rendimentoReal = $rendimentoReal;
        $this->observacao = $observacao;
        $this->status = $status;
        $this->horarioInicio = $horarioInicio;
        $this->horarioFim = $horarioFim;
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
 
    public function getIdReceita()
    {
        return $this->idReceita;
    }

    public function setIdReceita($idReceita)
    {
        $this->idReceita = $idReceita;

        return $this;
    }
 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }
 
    public function getEntrega()
    {
        return $this->entrega;
    }

    public function setEntrega($entrega)
    {
        $this->entrega = $entrega;

        return $this;
    }
 
    public function getRendimentoEsperado()
    {
        return $this->rendimentoEsperado;
    }

    public function setRendimentoEsperado($rendimentoEsperado)
    {
        $this->rendimentoEsperado = $rendimentoEsperado;

        return $this;
    }
 
    public function getRendimentoReal()
    {
        return $this->rendimentoReal;
    }

    public function setRendimentoReal($rendimentoReal)
    {
        $this->rendimentoReal = $rendimentoReal;

        return $this;
    }
 
    public function getObservacao()
    {
        return $this->observacao;
    }

    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }
 
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
 
    public function getHorarioInicio()
    {
        return $this->horarioInicio;
    }

    public function setHorarioInicio($horarioInicio)
    {
        $this->horarioInicio = $horarioInicio;

        return $this;
    }
 
    public function getHorarioFim()
    {
        return $this->horarioFim;
    }

    public function setHorarioFim($horarioFim)
    {
        $this->horarioFim = $horarioFim;

        return $this;
    }

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function gerarOS(){
        $sql = "insert into ordemServico values (null, :idReceita, :idUsuario, :entrega, :rendimentoEsperado, :rendimentoReal, :observacao, :idStatus, :horarioInicio, :horarioFim);";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idReceita", $this->idReceita);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":entrega", $this->entrega);
        $consulta->bindParam(":rendimentoEsperado", $this->rendimentoEsperado);
        $consulta->bindParam(":rendimentoReal", $this->rendimentoReal);
        $consulta->bindParam(":observacao", $this->observacao);
        $consulta->bindParam(":idStatus", $this->status);
        $consulta->bindParam(":horarioInicio", $this->horarioInicio);
        $consulta->bindParam(":horarioFim", $this->horarioFim);
        $consulta->execute();
        $id = $this->pdo->lastInsertId();
    
        return $id;
    }

    public function editarOS(){

    }

    public function excluirOS(){

    }

    public function assinar($idStatus, $data, $idUsuario){

    }

    public function concluirOS(){

    }

    public function reservarIngredientes(){
        
    }

    public function buscarReceita($idReceita) {
        $sql = "select * from ordemParametrizacao where idReceita=:idReceita";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idReceita", $idReceita);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}
?>