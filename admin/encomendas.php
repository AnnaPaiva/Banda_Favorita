<?php
require_once __DIR__ . '/../includes/config.php';

$stmt = $pdo->query("
    SELECT pedidos.*, users.nome 
    FROM pedidos 
    JOIN users ON pedidos.user_id = users.id
    ORDER BY pedidos.id DESC
");

$pedidos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Encomendas</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">

    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

    <style>
    /* RESET JÁ EXISTE NO SEU PROJETO */

    .admin-container {
        margin: 50px auto;
        padding: 30px;
        background-color: #333030;
        border-radius: 10px;
        max-width: 1100px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
    }

    /* TÍTULO */
    .admin-container h2 {
        text-align: center;
        font-size: 40px;
        margin-bottom: 30px;
        color: #eaf20d;
    }

    /* TABELA */
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        color: #f9f2f2;
        font-size: 22px;
    }

    .admin-table th {
        background-color: #161515;
        padding: 12px;
        border-bottom: 2px solid #eaf20d;
        text-align: center;
    }

    .admin-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #555;
    }

    .admin-table tr:hover {
        background-color: #444;
    }

    /* STATUS */
    .status-pendente {
        color: #eaf20d;
        font-weight: bold;
    }

    .status-processado {
        color: #4CAF50;
        font-weight: bold;
    }

    /* BOTÕES */
    .btn-admin {
        padding: 8px 15px;
        background-color: #161515;
        color: #f9f2f2;
        border: 1px solid #eaf20d;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-admin:hover {
        background-color: #eaf20d;
        color: #161515;
    }

    /* BOTÃO PROCESSAR */
    .btn-processar {
        background-color: #eaf20d;
        color: #161515;
        font-weight: bold;
    }

    .btn-processar:hover {
        background-color: #f9f2f2;
        color: #161515;
    }

    /* RESPONSIVO */
    @media (max-width: 768px) {
        .admin-table {
            font-size: 16px;
        }

        .admin-container h2 {
            font-size: 30px;
        }
    }
    </style>

</head>

<body>

    <div class="admin-container">

        <h2>📦 Encomendas</h2>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>

            <?php foreach ($pedidos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><?= number_format($p['total'], 2, ',', '.') ?> €</td>

                <td>
                    <?php if ($p['status'] == 'pendente'): ?>
                    <span class="status-pendente">Pendente</span>
                    <?php else: ?>
                    <span class="status-processado">Processado</span>
                    <?php endif; ?>
                </td>

                <td>
                    <?php if ($p['status'] == 'pendente'): ?>
                    <a href="processar.php?id=<?= $p['id'] ?>" class="btn-admin btn-processar">
                        Processar
                    </a>
                    <?php else: ?>
                    —
                    <?php endif; ?>
                </td>

            </tr>
            <?php endforeach; ?>

        </table>

        <br>
        <a href="dashboard.php" class="btn-admin">← Voltar</a>

    </div>

</body>

</html>