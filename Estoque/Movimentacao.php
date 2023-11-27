<?php
require_once "../Classes/Conecta.php";
require_once "Consultar.php";
require_once "Solicitacao.php";
require_once "Lote.php";
require_once "Solicitacao.php";
require_once "ItensSolicitacao.php";
class Movimentacao {
    private $idSolicitacao;
    private $idUsuario;
    private $idStatus;
    private $data;
    private $pdo;

    public function __construct($idSolicitacao, $idUsuario, $idStatus, $data)
    {
        $this->idSolicitacao = $idSolicitacao;
        $this->idUsuario = $idUsuario;
        $this->idStatus = $idStatus;
        $this->data = date('Y-m-d');
        $this->pdo = $this->conexao();
    }
 
    public function getIdSolicitacao()
    {
        return $this->idSolicitacao;
    }

    public function setIdSolicitacao($idSolicitacao)
    {
        $this->idSolicitacao = $idSolicitacao;

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
 
    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;

        return $this;
    }
 
    public function getdata()
    {
        return $this->data;
    }

    public function setdata($data)
    {
        $this->data = $data;

        return $this;
    }

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function realizarMovimentacao(){
        $sql = "insert into movimentacao values (NULL, :idSolicitacao, :idUsuario, 10, :data)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":data", $this->data);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso

            $sql = "select i.*, s.origem origem from itensSolicitacao i
            inner join solicitacao s on (s.idSolicitacao = i.idSolicitacao) 
            where i.idSolicitacao=:idSolicitacao";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
            $consulta->execute();
            
            while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                $I = new ItensSolicitacao($this->idSolicitacao, null, $dados->quantidade, $dados->idItem, $dados->origem);
                $I->quebrarLotes();
            };

            $sql2 = "select * from itensMovimentacao where idSolicitacao=:idSolicitacao";
            $consulta2 = $this->pdo->prepare($sql2);
            $consulta2->bindParam(":idSolicitacao", $this->idSolicitacao);
            $consulta2->execute();
            
            while($dados2 = $consulta2->fetch(PDO::FETCH_OBJ)) {
                $this->baixarItem($dados2->idLote);
            };

            $S = new Solicitacao(null, null, null, null, null, null, null);
            $S->alterarStatusSolicitacao($this->idSolicitacao, 10);
        } else {
            $resultado = "E";//erro
        }
        
        return $resultado;
    }

    public function realizarTransferencia(){
        $sql = "insert into movimentacao values (NULL, :idSolicitacao, :idUsuario, 10, :data)";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idUsuario", $this->idUsuario);
        $consulta->bindParam(":data", $this->data);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso

            $sql = "select i.*, s.origem origem from itensSolicitacao i
            inner join solicitacao s on (s.idSolicitacao = i.idSolicitacao) 
            where i.idSolicitacao=:idSolicitacao";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
            $consulta->execute();
            
            while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                $I = new ItensSolicitacao($this->idSolicitacao, null, $dados->quantidade, $dados->idItem, $dados->origem);
                $I->quebrarLotes();
            };

            $sql2 = "select * from itensMovimentacao where idSolicitacao=:idSolicitacao";
            $consulta2 = $this->pdo->prepare($sql2);
            $consulta2->bindParam(":idSolicitacao", $this->idSolicitacao);
            $consulta2->execute();
            
            while($dados2 = $consulta2->fetch(PDO::FETCH_OBJ)) {
                $lote = $this->buscarLote($dados2->idLote);
                $solicitacao = $this->buscarSolicitacao($this->idSolicitacao);
                $loteNovo = new Lote($lote->idItem, $solicitacao->idEstoque, $dados2->quantidade, $dados2->quantidade, $lote->validade, $lote->valorUnitario, $dados2->idLote);
                $loteNovo->inserirLote($solicitacao->idSolicitante);
                $this->baixarItem($dados2->idLote);
            };

            $S = new Solicitacao(null, null, null, null, null, null, null);
            $S->alterarStatusSolicitacao($this->idSolicitacao, 10);
        } else {
            $resultado = "E";//erro
        }

        return $resultado;

    }

    public function baixarItem($idLote) {
        $qtdSolicitada = $this->verificarQuantidade($idLote);
        $consultar = new Consultar($idLote, NULL);
        $qtdLote = $consultar->quantidadeLote();
        if($qtdLote->quantidadeAtual>=$qtdSolicitada->quantidade){
            $quantidade = $qtdLote->quantidadeAtual - $qtdSolicitada->quantidade;
            $sql = "update lote SET quantidadeAtual=:quantidadeAtual where idLote=:idLote";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":quantidadeAtual", $quantidade);
            $consulta->bindParam(":idLote", $idLote);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "I";//saldo Insuficiente
        }

        return $resultado;
    }

    public function reverterBaixaPorItem($idItem, $idTipoMovimentacao){
        $I = new ItensSolicitacao(null, null, null, null, null);
        $S = new Solicitacao(null, null, null, null, null, null, null);

        $sql = "select i.idLote, l.quantidadeAtual, i.quantidade from itensMovimentacao i 
        inner join lote l on (i.idLote = l.idLote)
        where i.idSolicitacao=:idSolicitacao and l.idItem=:idItem";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idItem", $idItem);
        $consulta->execute();
        
        while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            $quantidadeNova = $dados->quantidadeAtual + $dados->quantidade;
            $sqlUpdate = "update lote SET quantidadeAtual=:quantidadeAtual where idLote=:idLote";
            $consultaUpdate = $this->pdo->prepare($sqlUpdate);
            $consultaUpdate->bindParam(":quantidadeAtual", $quantidadeNova);
            $consultaUpdate->bindParam(":idLote", $dados->idLote);

            if ($consultaUpdate->execute()) {
                $resultado = "S";//sucesso

                $I->excluirItemMovimentacao($this->idSolicitacao, $idItem);
                $S->alterarStatusSolicitacao($this->idSolicitacao, 5);

                if($idTipoMovimentacao == 3) {
                    $sql2 = "select e.idLote from entrada e 
                    inner join lote l on (e.idLoteOrigem = l.idLote)
                    where e.idLoteOrigem=:idLote";
                    $consulta2 = $this->pdo->prepare($sql2);
                    $consulta2->bindParam(":idLote", $dados->idLote);
                    $consulta2->execute();
                    $dados2 = $consulta2->fetch(PDO::FETCH_OBJ);
                    $L = new Lote(null, null, null, null, null, null, null);
                    $L->excluirEntrada($dados2->idLote);
                    $L->excluirLote($dados2->idLote);
                }
            } else {
                $resultado = "E";//erro
            }
        } 
        
        return $resultado;
    }

    public function reverterBaixa($idTipoMovimentacao){
        $sql = "select idItem from itensSolicitacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->execute();
        while($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            $this->reverterBaixaPorItem($dados->idItem, $idTipoMovimentacao);
        }
    }

    public function verificarQuantidade($id) {
        $sql = "select quantidade from itensMovimentacao where idSolicitacao=:idSolicitacao and idLote=:idLote";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $this->idSolicitacao);
        $consulta->bindParam(":idLote", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function buscarLote($idLote) {
        $sql = "select * from lote where idLote=:idLote";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idLote", $idLote);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function buscarSolicitacao($idSolicitacao) {
        $sql = "select * from solicitacao where idSolicitacao=:idSolicitacao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idSolicitacao", $idSolicitacao);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function consultarEstoqueItem($idItem, $idEstoque){
        $sql = "select SUM(quantidadeAtual) from lote where idItem=:idItem and idEstoque=:idEstoque";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idItem", $idItem);
        $consulta->bindParam(":idEstoque", $idEstoque);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }    
}