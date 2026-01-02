<?php
session_start(); // inicia ou continua a sessão existente
header('Content-Type: application/json'); // Indica que a resposta será JSON

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'error' => 'ID do produto não especificado.']);
    exit();
}

$produto_id = (int) $_GET['id'];

if ($produto_id <= 0) {
    echo json_encode(['success' => false, 'error' => 'ID inválido.']);
    exit();
}

//ligação com a base de dados
include 'includes/config.php';

// Consulta o produto na base de dados
$query = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$query->execute(['id' => $produto_id]);
$produto = $query->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    echo json_encode(['success' => false, 'error' => 'Produto não encontrado.']);
    exit();
}

// Inicializa o carrinho se necessário
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Se já existir no carrinho, incrementa
if (isset($_SESSION['carrinho'][$produto_id])) {
    $_SESSION['carrinho'][$produto_id]['quantidade']++;
} else {
    $_SESSION['carrinho'][$produto_id] = [
        'id' => $produto['id'],
        'nome' => $produto['nome'],
        'preco' => $produto['preco'],
        'quantidade' => 1
    ];
}

header('Location: carrinho.php');
exit(); // redireciona para a página do carrinho

// Calcula o total de itens no carrinho
$carrinho_total = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $carrinho_total += $item['quantidade'];
}

// Responde com JSON
echo json_encode([
    'success' => true,
    'mensagem' => 'Produto adicionado com sucesso!',
    'total' => $carrinho_total
]);
