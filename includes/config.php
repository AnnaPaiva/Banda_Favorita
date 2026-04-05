<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$host = "localhost";
$dbname = "banda_favorita";
$username = "root";
$senha = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Erro na ligação ao banco de dados: " . $e->getMessage());
}
