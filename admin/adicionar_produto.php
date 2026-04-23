<?php
session_start();
require_once __DIR__ . '/../includes/config.php';
include 'menu.php';


// Só admin pode aceder
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = (float) $_POST['preco'];
    $stock = (int) $_POST['stock'];


    // Validações simples
    if (empty($nome) || empty($descricao) || $preco <= 0) {
        $erro = "Preencha todos os campos corretamente.";
    } else {

        // TRATAMENTO DA IMAGEM
        $imagem = $_FILES['imagem'];

        if ($imagem['error'] === 0) {

            $nomeImagem = time() . "_" . basename($imagem['name']);
            $destino = "../photos/" . $nomeImagem;




            if (move_uploaded_file($imagem['tmp_name'], $destino)) {

                // Inserir na base de dados
                $stmt = $pdo->prepare("
                    INSERT INTO produtos 
                    (nome, descricao, preco, imagem, stock)
                    VALUES (?, ?, ?, ?, ?)
                ");

                $stmt->execute([
                    $nome,
                    $descricao,
                    $preco,
                    $nomeImagem,
                    $stock
                ]);

                $sucesso = "Produto adicionado com sucesso!";
            } else {
                $erro = "Erro ao fazer upload da imagem.";
            }
        } else {
            $erro = "Escolha uma imagem válida.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin: 50px auto;
            padding: 30px;
            background-color: #333030;
            border-radius: 10px;
            width: 95%;
            max-width: 1100px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
            color: #e8e2e2;
        }

        h2 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 30px;
            color: #e8e2e2;
        }

        .form-control {
            background-color: #555;
            border: none;
            color: #e8e2e2;
        }

        .form-label {
            color: #e8e2e2;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-secondary {
            background-color: #555;
            border: none;
            color: #e8e2e2;
        }

        .btn-secondary:hover {
            background-color: #777;
            border: none;
            color: #e8e2e2;
        }

        .alert {
            margin-top: 20px;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
        }

        .alert-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .alert-success,
        .alert-danger {
            border: none;
            border-radius: 5px;
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 30px;
            }
        }
    </style>
</head>

<body class="p-4">

    <div class="container">

        <h2>Adicionar Novo Produto</h2>

        <?php if ($erro): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <div class="alert alert-success"><?= $sucesso ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Preço (€)</label>
                <input type="number" step="0.01" name="preco" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>


            <div class="mb-3">
                <label class="form-label">Imagem</label>
                <input type="file" name="imagem" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar Produto</button>
            <a href="produtos.php" class="btn btn-secondary">Voltar</a>

        </form>

    </div>
    </div> <!-- fecha .content -->
</body>

</html>