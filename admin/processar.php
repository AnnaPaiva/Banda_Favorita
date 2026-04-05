<?php
require_once __DIR__ . '/../includes/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}


$id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE pedidos SET status = 'processado' WHERE id = ?");
$stmt->execute([$id]);

header("Location: encomendas.php");
exit;
