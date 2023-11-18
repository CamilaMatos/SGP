<?php
require_once "../Classes/Conecta.php";
require_once "../Estoque/Lote.php";
require_once "../Estoque/Solicitacao.php";
require_once "../Estoque/ItensSolicitacao.php";
require_once "../Estoque/Movimentacao.php";
class OrdemServico {
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

    public function __construct($idReceita, $idUsuario, $entrega, $rendimentoEsperado, $rendimentoReal, $observacao, $status, $horarioInicio, $horarioFim){
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

    public function gerarOS($idCentroCusto, $idEstoque){
        $S = new Solicitacao($idEstoque, 2, $idCentroCusto, 3, $this->idUsuario, null, $this->entrega);
        print_r($S);
        $idSolicitacao = $S->solicitarRequisicao();
        $sql = "insert into ordemServico values (null, :idReceita, :idUsuario, :idSolicitacao, :entrega, :rendimentoEsperado, :rendimentoReal, :observacao, :idStatus, :horarioInicio, :horarioFim);";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idReceita", $this->idReceita);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":idSolicitacao", $idSolicitacao);
        $consulta->bindParam(":entrega", $this->entrega);
        $consulta->bindParam(":rendimentoEsperado", $this->rendimentoEsperado);
        $consulta->bindParam(":rendimentoReal", $this->rendimentoReal);
        $consulta->bindParam(":observacao", $this->observacao);
        $consulta->bindParam(":idStatus", $this->status);
        $consulta->bindParam(":horarioInicio", $this->horarioInicio);
        $consulta->bindParam(":horarioFim", $this->horarioFim);
        $consulta->execute();
        $id = $this->pdo->lastInsertId();

        $this->assinar($id, 3, $this->idUsuario);
        $this->buscarOrdem($idSolicitacao, $this->idReceita, $id, $idEstoque);


        return $id;
    }

    public function inserirReceitaOS($id, $idItem, $qtdAjustada) {
        $sql = "insert into receitaServico values (:idOrdemServico, :idItem, :quantidade, :quantidade);";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idOrdemServico", $id);
        $consulta->bindParam(":idItem", $idItem);
        $consulta->bindParam(":quantidade", $qtdAjustada);
        $consulta->execute();
    }

    public function assinar($idOrdem, $idStatus, $idUsuario){
        $data = date('Y-m-d');
        $hora = date('H:i:s');

        $sql = "insert into assinatura values (:idOrdemServico,:idUsuario, :idStatus, :data, :hora);";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idOrdemServico", $idOrdem);
        $consulta->bindParam(":idStatus", $idStatus);
        $consulta->bindParam(":idUsuario", $idUsuario);
        $consulta->bindParam(":data", $data);
        $consulta->bindParam(":hora", $hora);
        $consulta->execute();
    }

    public function concluirOS($idOrdem, $idUsuario, $idSolicitacao, $idEstoque){
        $data = date('Y-m-d');
        $sql = "select * from receitaServico where idOrdemServico=:idOrdem";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idOrdem", $idOrdem);
        $consulta->execute();
        $M = new Movimentacao($idSolicitacao, $idUsuario, 4, $data);
        $M->reverterBaixa(6);
        while($resultado = $consulta->fetch(PDO::FETCH_OBJ)){
            $I = new ItensSolicitacao($idSolicitacao, null, $resultado->quantidadeRealizada, $resultado->idItem, $idEstoque);
            $I->quebrarLotes();
        }

        $M->realizarMovimentacao();
        $this->assinar($idOrdem, 4, $idUsuario);
    }

    public function reservarIngredientes($idOrdem, $idUsuario, $idSolicitacao, $idEstoque){
        $data = date('Y-m-d');
        $sql = "select * from receitaServico where idOrdemServico=:idOrdem";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idOrdem", $idOrdem);
        $consulta->execute();
        
        while($resultado = $consulta->fetch(PDO::FETCH_OBJ)){
            $I = new ItensSolicitacao($idSolicitacao, null, $resultado->quantidadeRealizada, $resultado->idItem, $idEstoque);
            $I->quebrarLotes();
        }

        $M = new Movimentacao($idSolicitacao, $idUsuario, 4, $data);
        $M->realizarMovimentacao();
        $this->assinar($idOrdem, 7, $idUsuario);
    }

    public function buscarOrdem($idSolicitacao, $idReceita, $idOrdem, $idEstoque) {
        $sql = "select * from ordemParametrizacao where idReceita=:idReceita";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idReceita", $idReceita);
        $consulta->execute();
        $rendimentoParametrizado = $this->buscarReceita($this->idReceita)->rendimento;
        while($resultado = $consulta->fetch(PDO::FETCH_OBJ)){
            $qtdAjustada = $this->ajustarQuantidade($resultado->quantidade, $rendimentoParametrizado);
            print($resultado->idItem);
            $this->inserirReceitaOS($idOrdem, $resultado->idItem, $qtdAjustada);
            $I = new ItensSolicitacao($idSolicitacao, null, $qtdAjustada,  $resultado->idItem, $idEstoque);
            $I->inserirItemSolicitacao($qtdAjustada);
        }
        
        return $resultado;
    }

    public function buscarReceita($idReceita) {
        $sql = "select * from receitaParametrizacao where idReceita=:idReceita";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idReceita", $idReceita);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function ajustarQuantidade($quantidade, $rendimento){
        $qtdAjustada = ($this->rendimentoEsperado*$quantidade)/$rendimento;

        return $qtdAjustada;
    }


}

// (rendimentoEsperado * qtdPadronizada) / rendimentoPadrão
?>