<?php
require_once __DIR__ . '/includes/config.php';



// carrinho na sessão
$carrinho = isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])
    ? $_SESSION['carrinho']
    : [];

// buscar produtos do BD apenas se houver itens no carrinho
$listaProdutos = [];

if (!empty($carrinho)) {
    $ids = array_keys($carrinho);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $stmt = $pdo->prepare("SELECT id, nome, preco, imagem FROM produtos WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $listaProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// verificar login
$logado = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: #353535;
        font-family: Arial, sans-serif;

    }

    .container {
        background: #dfdcdc;
        color: #272525;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    th {
        background: #0d6efd;
        color: white;
    }

    .produto-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }
    </style>
</head>

<body>

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center">
            <h2>🛒 Meu Carrinho</h2>

            <?php if ($logado): ?>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Sair</a>
            <?php else: ?>
            <a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
            <?php endif; ?>
        </div>

        <hr>

        <?php if (empty($carrinho)): ?>

        <div class="alert alert-warning">
            O carrinho está vazio.
        </div>

        <a href="loja.php" class="btn btn-secondary">← Voltar à Loja</a>

        <?php else: ?>

        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $total = 0;

                    foreach ($carrinho as $id => $qtd):
                        $produto = null;
                        foreach ($listaProdutos as $p) {
                            if ($p['id'] == $id) {
                                $produto = $p;
                                break;
                            }
                        }
                        if (!$produto) continue;
                        $subtotal = $produto['preco'] * $qtd;
                        $total += $subtotal;
                    ?>
                <tr>
                    <td>
                        <img src="photos/<?= htmlspecialchars($produto['imagem']) ?>" class="produto-img"
                            onerror="this.src='https://placehold.co/60x60?text=Sem+imagem'">
                    </td>

                    <td><?= htmlspecialchars($produto['nome']) ?></td>

                    <td>€<?= number_format($produto['preco'], 2, ',', '.') ?></td>

                    <td>
                        <form method="post" action="atualizar_carrinho.php" class="d-flex">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <input type="number" name="quantidade" value="<?= $qtd ?>" min="1"
                                class="form-control w-50 me-2">
                            <button class="btn btn-primary btn-sm">Atualizar</button>
                        </form>
                    </td>

                    <td>€<?= number_format($subtotal, 2, ',', '.') ?></td>

                    <td>
                        <a href="remover-do-carrinho.php?id=<?= $produto['id'] ?>" class="btn btn-danger btn-sm">
                            Remover
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Total: €<?= number_format($total, 2, ',', '.') ?></h4>

        <hr>

        <a href="loja.php" class="btn btn-secondary">← Continuar a comprar</a>

        <?php if ($logado): ?>
        <a href="finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>
        <?php else: ?>
        <a href="login.php" class="btn btn-primary">Fazer login para comprar</a>
        <?php endif; ?>

        <?php endif; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>