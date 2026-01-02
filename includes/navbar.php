<?php
$carrinho_total = 0;
if (isset($_SESSION['carrinho'])) {

    foreach ($_SESSION['carrinho'] as $item) {
        $carrinho_total += $item['quantidade'];
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index.php">Loja</a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="../carrinho.php">
                    🛒 Carrinho
                    <span class="badge bg-success" id="carrinho-contador"><?= $carrinho_total ?></span>

                </a>
            </li>
        </ul>
    </div>
</nav>