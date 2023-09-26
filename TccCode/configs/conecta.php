<?php

$server = "localhost";
$dbname = "sgp";
$user = "root";
$password = "";

$base = "http://localhost/TccCode/";

try {
    $pdo = new PDO("mysql:host={$server};dbname={$dbname};charset=utf8;", $user, $password);
} catch (Exception $e) {
    echo "Erro ao conectar no banco de dados {$e->getMessage()}";
    exit;
}
