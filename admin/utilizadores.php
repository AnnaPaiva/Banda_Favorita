<?php
session_start();
require_once __DIR__ . '/../includes/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$stmt = $pdo->query("
    SELECT id, nome, email, username, tipo, criado_em
    FROM users
    ORDER BY id DESC
");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Gerir Utilizadores</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
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
        overflow-x: auto;
    }

    .container h1 {
        text-align: center;
        font-size: 40px;
        margin-bottom: 30px;
        color: #e8e2e2;

    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #333;
        color: #fff;
    }



    a {
        color: #1b7de6;
        text-decoration: none;
        font-weight: bold;
        font-size: 18px;
    }

    a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        th,
        td {
            padding: 8px;
        }

        a {
            font-size: 14px;
        }

    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1>Gerir Utilizadores</h1>
        <a href="dashboard.php">← Voltar ao Dashboard</a>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Tipo</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['nome']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= $user['tipo'] ?></td>
                    <td>
                        <?php if ($user['tipo'] === 'cliente'): ?>
                        <a href="tornar_admin.php?id=<?= $user['id'] ?>">Tornar Admin</a>
                        <?php else: ?>
                        <a href="tornar_cliente.php?id=<?= $user['id'] ?>">Tornar Cliente</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>