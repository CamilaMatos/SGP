<?php
require_once "Conecta.php";
require_once "Consultar.php";
class Usuario {
    private $idUsuario;
    private $nome;
    private $dataNasc;
    private $documento;
    private $idTipo;
    private $login;
    private $senha;

    public function __construct($idUsuario, $nome, $dataNasc, $documento, $idTipo, $login, $senha)
    {
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->dataNasc = $dataNasc;
        $this->documento = $documento;
        $this->idTipo = $idTipo;
        $this->login = $login;
        $this->senha = $senha;
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

    public function conexao(){
        $conectar= new Conecta();
        $pdo= $conectar->conectar();

        return $pdo;
    }

    public function logar(){
        $consulta= new Consultar($this->login, NULL);
        $dados = $consulta->usuarioPorLogin();
        if(!empty($dados)){
            if(password_verify($dados->senha, $this->encriptador($this->senha))){
                $resultado= true;//sucesso
            } else {
                $resultado= false;//senha inválida
            }
        } else{
            $resultado= false;//login inválido
        }

        return $resultado;
    }

    function encriptador($senha){
		$hash = password_hash($senha, PASSWORD_BCRYPT);

		return $hash;
	}

    public function cadastrarUsuario(){
        if($this->validarLogin()=="A"){
            $senha = $this->encriptador($this->senha);
            $sql = "insert into usuario values (NULL, :nome, :dataNasc, :documento, :idTipo, :login, :senha)";
            $consulta = $this->conexao()->prepare($sql);
            $consulta->bindParam(":nome", $this->nome);
            $consulta->bindParam(":dataNasc", $this->dataNasc);
            $consulta->bindParam(":documento", $this->documento);
            $consulta->bindParam(":idTipo", $this->idTipo);
            $consulta->bindParam(":login", $this->login);
            $consulta->bindParam(":senha", $senha);

            if ($consulta->execute()) {
                $resultado = "S";//sucesso
            } else {
                $resultado = "E";//erro
            }
        } else {
            $resultado = "NA";//não autorizado, pois não pode cadastrar o usuário com um login que já está cadastrado para outro usuário
        }

        

        return $resultado;
    }

    public function editarUsuario($id){
        $sql = "update usuario SET nome=:nome, dataNasc=:dataNasc, documento=:documento, idTipo=:idTipo, login=:login, senha=:senha where idUsuario=:idUsuario";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":nome", $this->nome);
        $consulta->bindParam(":dataNasc", $this->dataNasc);
        $consulta->bindParam(":documento", $this->documento);
        $consulta->bindParam(":idTipo", $this->idTipo);
        $consulta->bindParam(":login", $this->login);
        $consulta->bindParam(":senha", $this->senha);
        $consulta->bindParam(":idUsuario", $id);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function alterarTipoUsuario($idUsuario){
        $sql = "update usuario SET idTipo=:idTipo where idUsuario=:idUsuario";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":idTipo", $this->idTipo);
        $consulta->bindParam(":idUsuario", $idUsuario);

        if ($consulta->execute()) {
            $resultado = "S";//sucesso
        } else {
            $resultado = "E";//erro
        }

        return $resultado;
    }

    public function validarLogin(){
        $sql = "select login from usuario where login=:login";
        $consulta = $this->conexao()->prepare($sql);
        $consulta->bindParam(":login", $this->login);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        if(empty($resultado)){
            $resultado = "A"; //autorizado
        } else {
            $resultado = "NA"; //não autorizado
        }

        return $resultado;
    }

}
