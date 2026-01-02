<?php
session_start();

//Se o carrinho estiver vazio, redireciona para o catálogo
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Aqui vamos processa os dados do formulário, para que sejam guardados em base de dados


    //para já, limpamos o carrinho e mostramos uma mensagem
    unset($_SESSION['carrinho']); //esvazia o carrinho
    $mensagem_sucesso = "Obrigada pela sua compra! O seu pedido foi registado.";
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

        <?php if (isset($mensagem_sucesso)): ?>

            <div class="alert alert-success">
                <?php echo $mensagem_sucesso; ?>
            </div>
            <a href="index.php" class="btn btn-primary">Voltar ao catálogo</a>

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