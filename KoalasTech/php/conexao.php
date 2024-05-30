<?php

$usuario = 'root'; // alterar se necessário
$senha = 'root'; // alterar se necessário
$database = 'KoalasTech'; // nome do banco de dados
$host = 'localhost:3306'; // alterar se necessário

$conn = new mysqli($host, $usuario, $senha, $database);

if ($conn->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $conn->connect_error);
}

?>
