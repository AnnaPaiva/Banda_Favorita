<?php

session_start();

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    $mensagem = "O seu carrinho está vazio.";
} else {
    $produtos = $_SESSION['carrinho'];
}

?>

<!Doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Carrinho de Compras</h2>

        <?php if (isset($mensagem)): ?>
            <p> <?php echo $mensagem; ?> </p>
        <?php else: ?>

            <table class="table table-striped">
                <thead>
                    <tr>
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
                    foreach ($produtos as $produto):
                        $preco = (float) $produto['preco'];
                        $quantidade = (int) $produto['quantidade'];
                        $subtotal = $preco * $quantidade;
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                            <td>€<?php echo number_format($preco, 2, ',', '.'); ?></td>
                            <td><?php echo $quantidade; ?></td>
                            <td>€<?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                            <td>
                                <a href="remover_do_carrinho.php?id=<?php echo $produto['id']; ?>"
                                    class="btn btn-danger btn-sm">Remover</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total: €<?php echo number_format($total, 2, ',', '.'); ?> </h3>


            <!-- codigo para botes continuar e finalizar -->

            <div class="mt-4">

                <a href="index.php" class="btn btn-primary me-2">Continuar a comprar</a>
                <a href="finalizar_compra.php" class="btn btn-success">Finalizar a comprar</a>


            </div>

        <?php endif; ?>
    </div>

</body>

</html>