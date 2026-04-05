<?php
session_start();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: carrinho.php");
    exit;
}

if (isset($_SESSION['carrinho'][$id])) {
    unset($_SESSION['carrinho'][$id]);
}

// Se o carrinho ficou vazio, limpa tudo
if (empty($_SESSION['carrinho'])) {
    unset($_SESSION['carrinho']);
}

header("Location: carrinho.php");
exit;