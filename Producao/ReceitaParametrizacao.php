<?php
require_once "./Classes/Conecta.php";
require_once "./Estoque/Item.php";
class ReceitaParametrizacao {
    private $nome;
    private $categoria;
    private $tempo;
    private $modo;
    private $rendimento;
    private $pdo;

    public function __construct($nome, $categoria, $tempo, $modo, $rendimento){
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->tempo = $tempo;
        $this->modo = $modo;
        $this->rendimento = $rendimento;
        $this->pdo = $this->conexao();
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
 
    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }
 
    public function getTempo()
    {
        return $this->tempo;
    }

    public function setTempo($tempo)
    {
        $this->tempo = $tempo;

        return $this;
    }
 
    public function getModo()
    {
        return $this->modo;
    }

    public function setModo($modo)
    {
        $this->modo = $modo;

        return $this;
    }
 
    public function getRendimento()
    {
        return $this->rendimento;
    }

    public function setRendimento($rendimento)
    {
        $this->rendimento = $rendimento;

        return $this;
    }

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function cadastrarReceita(){
        $id = null;
        if(empty($this->receitaPorNome($id))) {
            $sql = "insert into receitaParametrizacao values (NULL, :nome, :idCategoria, :tempo, :modo, :rendimento)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":idCategoria", $this->categoria);
            $consulta->bindParam(":tempo", $this->tempo);
            $consulta->bindParam(":modo", $this->modo);
            $consulta->bindParam(":rendimento", $this->rendimento);

            if ($consulta->execute()) {
                $resultado = $this->pdo->lastInsertId();//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro dessa receita
        }

        return $resultado;
    }

    public function editarReceita($id){
        if(empty($this->receitaPorNome($id))) {
            $sql = "update receitaParametrizacao SET nome=:nome, idCategoria=:idCategoria, tempo=:tempo, modo=:modo, rendimento=:rendimento where idReceita=:idReceita";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":idCategoria", $this->categoria);
            $consulta->bindParam(":tempo", $this->tempo);
            $consulta->bindParam(":modo", $this->modo);
            $consulta->bindParam(":rendimento", $this->rendimento);
            $consulta->bindParam(":idReceita", $id);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso

                $sql2 = "select i.idItem from item i
                inner join receitaParametrizacao r on (r.nome = i.nome)
                where r.idReceita=:id";
                $consulta2 = $this->conexao()->prepare($sql2);
                $consulta2->bindParam(":id", $id);
                $consulta2->execute();
                $idItem = $consulta2->fetch(PDO::FETCH_OBJ);
                $R = new Item($this->nome, 1, $this->categoria, 5, 1, 1);
                $R->editarItem($idItem);
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro dessa receita
        }

        return $resultado;
    }

    public function finalizarCadastroReceita($id){
        if(empty($this->receitaPorNome($id))) {
            $sql = "update receitaParametrizacao SET nome=:nome, idCategoria=:idCategoria, tempo=:tempo, modo=:modo, rendimento=:rendimento where idReceita=:idReceita";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":idCategoria", $this->categoria);
            $consulta->bindParam(":tempo", $this->tempo);
            $consulta->bindParam(":modo", $this->modo);
            $consulta->bindParam(":rendimento", $this->rendimento);
            $consulta->bindParam(":idReceita", $id);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso

                $I = new Item($this->nome, 1, $this->categoria, 5, 1, 1);
                $I->cadastrarItem();
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "R";//recusado pois já existe cadastro dessa receita
        }

        return $resultado;
    }

    public function excluirReceita($id){
        //verificar se não há OSs cadastradas com essa receita
        if(empty($this->verificarRegistros($id))){
            $sql = "delete from ordemParametrizacao where idReceita=:idReceita";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idReceita", $id);
            $consulta->execute();

            $sql = "delete from receitaParametrizacao where idReceita=:idReceita";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":idReceita", $id);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }

        } else {
            $resultado = "R";//operação recusada
        }

        return $resultado;
    }

    public function verificarRegistros($id) {
        $sql = "select * from ordemServico where idReceita=:idReceita";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idReceita", $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function receitaPorNome($id){
        if($id == null){
            $sql = "select * from receitaParametrizacao where nome=:nome";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        } else {
            $sql = "select * from receitaParametrizacao where nome=:nome and not(idReceita=:id)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":id", $id);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        }
        

        return $resultado;
    }
}
?>