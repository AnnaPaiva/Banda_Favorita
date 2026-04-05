<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;
    $qtd = $_POST['quantidade'] ?? null;

    if ($id && $qtd && $qtd > 0) {

        $_SESSION['carrinho'][$id] = (int)$qtd;
    }
}

// VOLTA PARA O CARRINHO SEM ERRO
header("Location: carrinho.php");
exit;