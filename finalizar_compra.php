<?php
require_once __DIR__ . '/includes/config.php';

$mensagem_sucesso = null;

// Só finaliza a compra se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    if (empty($_SESSION['carrinho'])) {
        header("Location: carrinho.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $carrinho = $_SESSION['carrinho'];

    $total = 0;

    foreach ($carrinho as $produto_id => $quantidade) {
        $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
        $stmt->execute([$produto_id]);
        $produto = $stmt->fetch();

        $total += $produto['preco'] * $quantidade;
    }

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO pedidos (user_id, total, status) VALUES (?, ?, 'pendente')");
    $stmt->execute([$user_id, $total]);

    $pedido_id = $pdo->lastInsertId();

    foreach ($carrinho as $produto_id => $quantidade) {

        $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
        $stmt->execute([$produto_id]);
        $produto = $stmt->fetch();

        $stmt = $pdo->prepare("INSERT INTO orders_itens (pedido_id, produto_id, quantidade, preco_uni)
                               VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $pedido_id,
            $produto_id,
            $quantidade,
            $produto['preco']
        ]);
    }

    $pdo->commit();

    unset($_SESSION['carrinho']);

    $mensagem_sucesso = "Compra finalizada com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Finalizar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container mt-5">
        <h2>Finalizar compra</h2>

        <?php if ($mensagem_sucesso): ?>

        <div class="alert alert-success">
            <?php echo $mensagem_sucesso; ?>
        </div>
        <a href="loja.php" class="btn btn-primary">Voltar ao catálogo</a>

        <?php else: ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required />
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço de Entrega</label>
                <textarea class="form-control" id="endereco" name="endereco" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>

            <button type="submit" class="btn btn-success">Confirmar compra</button>

        </form>

        <?php endif; ?>
    </div>

</body>

</html>