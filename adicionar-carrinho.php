<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: loja.php");
    exit;
}

$produto_id = (int) ($_POST["produto_id"] ?? 0);
$quantidade = (int) ($_POST["quantidade"] ?? 1);

if ($produto_id <= 0) {
    header("Location: loja.php");
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_SESSION['carrinho'][$produto_id])) {
    $_SESSION['carrinho'][$produto_id] += $quantidade;
} else {
    $_SESSION['carrinho'][$produto_id] = $quantidade;
}

header("Location: carrinho.php");
exit;