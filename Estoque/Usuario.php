<?php
require_once "./Classes/Conecta.php";
require_once "Consultar.php";
class Usuario{
    private $nome;
    private $dataNasc;
    private $documento;
    private $idTipo;
    private $login;
    private $senha;
    private $pdo;
    private $idStatus;

    public function __construct($nome, $dataNasc, $documento, $idTipo, $login, $senha, $idStatus){
        $this->nome = $nome;
        $this->dataNasc = $dataNasc;
        $this->documento = $documento;
        $this->idTipo = $idTipo;
        $this->login = $login;
        $this->senha = $senha;
        $this->pdo = $this->conexao();
        $this->idStatus = $idStatus;
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

    public function getDataNasc()
    {
        return $this->dataNasc;
    }

    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;

        return $this;
    }

    public function getDocumento()
    {
        return $this->documento;
    }

    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    public function getIdTipo()
    {
        return $this->idTipo;
    }

    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;

        return $this;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;

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

    public function conexao()
    {
        $conectar = new Conecta();
        $pdo = $conectar->conectar();

        return $pdo;
    }

    public function logar(){
        $consulta = new Consultar($this->login, NULL);
        $dados = $consulta->usuarioPorLogin();
        if (!empty($dados)) {
            if (password_verify($this->senha, $dados->senha)) {
                $resultado = $dados; //sucesso
            } else {
                $resultado = false; //senha inválida
            }
        } else {
            $resultado = false; //login inválido
        }

        return $resultado;
    }

    function encriptador($senha)
    {
        $hash = password_hash($senha, PASSWORD_BCRYPT);

        return $hash;
    }

    public function cadastrarUsuario(){
        $id = null;
        if ($this->validarLogin($id) == "A") {
            $senha = $this->encriptador($this->senha);
            $sql = "insert into usuario values (NULL, :nome, :dataNasc, :documento, :idTipo, :login, :senha, 1)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":dataNasc", $this->dataNasc);
            $consulta->bindParam(":documento", $this->documento);
            $consulta->bindParam(":idTipo", $this->idTipo);
            $consulta->bindParam(":login", $this->login);
            $consulta->bindParam(":senha", $senha);

            if ($consulta->execute()) {
                $resultado = $this->pdo->lastInsertId();//sucesso
            } else {
                $resultado = "E"; //erro
            }
        } else {
            $resultado = "NA"; //não autorizado, pois não pode cadastrar o usuário com um login que já está cadastrado para outro usuário
            
        }
        return $resultado;     
    }

    public function editarUsuario($id){
        if ($this->validarLogin($id) == "A") {
            $sql = "update usuario SET nome=:nome, dataNasc=:dataNasc, documento=:documento, idTipo=:idTipo, login=:login where idUsuario=:idUsuario";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":dataNasc", $this->dataNasc);
            $consulta->bindParam(":documento", $this->documento);
            $consulta->bindParam(":idTipo", $this->idTipo);
            $consulta->bindParam(":login", $this->login);
            $consulta->bindParam(":idUsuario", $id);

            if ($consulta->execute()) {
                $resultado = "S"; //sucesso
            } else {
                $resultado = "E"; //erro
            }
        } else {
            $resultado = "NA"; //não autorizado, pois não pode cadastrar o usuário com um login que já está cadastrado para outro usuário
        }

        return $resultado;
    }

    public function editarSenha($id){
        $senha = $this->encriptador($this->senha);
        $sql = "update usuario SET senha=:senha where idUsuario=:idUsuario";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":idUsuario", $id);

        if ($consulta->execute()) {
            $resultado = "S"; //sucesso
        } else {
            $resultado = "E"; //erro
        }

        return $resultado;
    }

    public function alterarStatusUsuario($idUsuario, $idStatus){
        $sql = "update usuario SET idStatus=:idStatus where idUsuario=:idUsuario";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":idStatus", $idStatus);
        $consulta->bindParam(":idUsuario", $idUsuario);

        if ($consulta->execute()) {
            $resultado = "S"; //sucesso
        } else {
            $resultado = "E"; //erro
        }

        return $resultado;
    }

    public function validarLogin($id){
        if($id == null){
            $sql = "select login from usuario where login=:login or documento=:documento";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":login", $this->login);
            $consulta->bindParam(":documento", $this->documento);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        } else {
            $sql = "select login from usuario where (login=:login or documento=:documento) and not(idUsuario=:idUsuario)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":login", $this->login);
            $consulta->bindParam(":documento", $this->documento);
            $consulta->bindParam(":idUsuario", $id);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        }

        if (empty($resultado)) {
            $resultado = "A"; //autorizado
        } else {
            $resultado = "NA"; //não autorizado
        }

        return $resultado;
    }

}
