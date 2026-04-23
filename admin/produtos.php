<?php
session_start();
require_once __DIR__ . '/../includes/config.php';
include 'menu.php'; // menu comum a todas as páginas admin
// ligação à BD

// Protege a página: só admin
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Buscar produtos do banco
$stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin: 50px auto;
            padding: 30px;
            background-color: #333030;
            border-radius: 10px;
            width: 95%;
            max-width: 1100px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
            color: #e8e2e2;
            overflow-x: auto;
        }

        .container h2 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 30px;
            color: #e8e2e2;

        }

        .table {
            width: 100%;
            min-width: 600px;
            /* impede esmagar colunas */
            border-collapse: collapse;
            color: #f9f2f2;
            font-size: clamp(14px, 2vw, 22px);
        }


        .table th {
            background-color: #161515;
            padding: 12px;
            border-bottom: 2px solid #eaf20d;
            text-align: center;
        }

        .table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #555;
        }

        .table tr:hover {
            background-color: #444;
        }

        .table img {
            width: 80px;
            height: auto;
            border-radius: 4px;
        }

        .btn-action {
            margin-right: 5px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {

            .table thead {
                display: none;
            }

            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table tr {
                margin-bottom: 15px;
                background: #444;
                padding: 10px;
                border-radius: 8px;
            }

            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table td::before {
                position: absolute;
                left: 15px;
                width: 45%;
                text-align: left;
                font-weight: bold;
                color: #eaf20d;
            }

        }
    </style>
</head>

<body class="p-4">

    <div class="container">

        <div class="header-section">
            <h2>Produtos</h2>

            <a href="adicionar_produto.php" class="btn btn-success">➕ Adicionar Produto</a>
        </div>

        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= $produto['id'] ?></td>
                        <td>
                            <img src="../photos/<?= htmlspecialchars($produto['imagem']) ?>"
                                onerror="this.src='https://placehold.co/80x80?text=Sem+imagem'">
                        </td>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td><?= htmlspecialchars($produto['descricao']) ?></td>
                        <td>€<?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td><?= $produto['stock'] ?></td>
                        <td><?= $produto['categoria_id'] ?></td>
                        <td>
                            <a href="editar_produto.php?id=<?= $produto['id'] ?>"
                                class="btn btn-primary btn-sm btn-action">✏️ Editar</a>
                            <a href="apagar_produto.php?id=<?= $produto['id'] ?>" class="btn btn-danger btn-sm btn-action"
                                onclick="return confirm('Apagar produto?')">🗑️ Apagar</a>
                            <a href="dashboard.php" class="btn btn-secondary btn-sm">← Voltar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    </div> <!-- fecha .content -->
</body>

</html>