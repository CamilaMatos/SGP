<?php
class Conecta {
    private $server = "localhost";
    private $banco = "sgp";
    private $usuario = "root";
    private $senha = "";
    private $base = "http://localhost/SGP/";

    public function conectar(){
        try {
            $pdo = new PDO ("mysql:host={$this->server};dbname={$this->banco};charset=utf8;",
            $this->usuario,$this->senha);
        } catch (Exception $e){
            echo "Erro ao conectar ao banco: ". $e->getMessage();
        }
        return $pdo;
    }

}