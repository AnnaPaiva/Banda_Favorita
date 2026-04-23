<?php
require_once __DIR__ . '/includes/config.php';

$mensagem_sucesso = null;

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

    // Calcular total
    foreach ($carrinho as $produto_id => $quantidade) {
        $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
        $stmt->execute([$produto_id]);
        $produto = $stmt->fetch();

        $total += $produto['preco'] * $quantidade;
    }

    $pdo->beginTransaction();

    // Criar pedido
    $stmt = $pdo->prepare("INSERT INTO pedidos (user_id, total, status) VALUES (?, ?, 'pendente')");
    $stmt->execute([$user_id, $total]);

    $pedido_id = $pdo->lastInsertId();

    // Processar itens
    foreach ($carrinho as $produto_id => $quantidade) {

        // Buscar dados do produto
        $stmt = $pdo->prepare("SELECT preco, is_ticket, event_id FROM produtos WHERE id = ?");
        $stmt->execute([$produto_id]);
        $produto = $stmt->fetch();

        // Registrar item normal
        $stmt = $pdo->prepare("INSERT INTO orders_itens (pedido_id, produto_id, quantidade, preco_uni)
                               VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $pedido_id,
            $produto_id,
            $quantidade,
            $produto['preco']
        ]);

        // Se for bilhete
        if ($produto['is_ticket'] == 1 && !empty($produto['event_id'])) {

            for ($i = 0; $i < $quantidade; $i++) {

                // Buscar ticket disponível
                $stmt = $pdo->prepare("
    SELECT t.id
    FROM tickets t
    LEFT JOIN sales s ON s.ticket_id = t.id
    WHERE t.event_id = ?
      AND s.ticket_id IS NULL
    LIMIT 1
");
                $stmt->execute([$produto['event_id']]);
                $ticket = $stmt->fetch();

                if ($ticket) {
                    // Registrar venda
                    $stmt = $pdo->prepare("
        INSERT INTO sales (customer_id, ticket_id, sale_date)
        VALUES (?, ?, NOW())
    ");
                    $stmt->execute([$user_id, $ticket['id']]);
                }
            }
        }
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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #333030;
            border-radius: 10px;
            width: 100%;
            max-width: 1100px;
            color: #e8e2e2;

        }

        /* container central */
        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        /* cartão do perfil */
        .profile-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* imagem */
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #ddd;
        }

        /* título */
        .profile-card h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* infos */
        .profile-info p {
            text-align: left;
            margin-bottom: 10px;
            color: #555;
            font-size: 14px;
        }

        .profile-info strong {
            color: #222;
        }

        /* botão logout */
        .logout-btn {
            display: inline-block;
            font-size: 14px;
            margin-top: 20px;
            padding: 10px 20px;
            background: #4b494a;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;

        }

        .logout-btn a {
            color: #fff;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: #3f0b31;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Finalizar compra</h2>

        <?php if ($mensagem_sucesso): ?>

            <div class="alert alert-success">
                <?php echo $mensagem_sucesso; ?>
            </div>
            <a href="loja.php" class="logout-btn">Voltar ao catálogo</a>

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

                <button type="submit" class="logout-btn ">Confirmar compra</button>

            </form>

        <?php endif; ?>
    </div>

</body>

</html>