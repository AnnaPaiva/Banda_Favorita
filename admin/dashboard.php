<?php
session_start();
require_once __DIR__ . '/../includes/config.php';
include 'menu.php';


if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}



// total de produtos
$totalProdutos = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();

// total de utilizadores
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

// total de clientes
$totalClientes = $pdo->query(
    "SELECT COUNT(*) FROM users WHERE tipo = 'cliente'"
)->fetchColumn();

// total de admins
$totalAdmins = $pdo->query(
    "SELECT COUNT(*) FROM users WHERE tipo = 'admin'"
)->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #e8e2e2;
        }

        .card-text {
            font-size: 24px;
            font-weight: bold;
            color: #e8e2e2;
        }

        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }

            .card-body {
                height: auto;
            }

            .card-text {
                font-size: 20px;
            }

            .card-title {
                font-size: 16px;
            }

        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">

        <h1 class="mb-4">Painel de Administração</h1>

        <p>Bem-vindo, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>

        <div class="row g-4 mt-4">

            <div class="col-md-3">
                <div class="card text-bg-primary">
                    <div class="card-body">
                        <h5>Produtos</h5>
                        <h2><?= $totalProdutos ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <h5>Utilizadores</h5>
                        <h2><?= $totalUsers ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-info">
                    <div class="card-body">
                        <h5>Clientes</h5>
                        <h2><?= $totalClientes ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-dark">
                    <div class="card-body">
                        <h5>Admins</h5>
                        <h2><?= $totalAdmins ?></h2>
                    </div>
                </div>
            </div>

        </div>

        <hr class="my-4">

        <a href="produtos.php" class="btn btn-primary">Gerir Produtos</a>
        <a href="utilizadores.php" class="btn btn-secondary">Gerir Utilizadores</a>
        <a href="../logout.php" class="btn btn-danger float-end">Logout</a>

    </div>

    </div> <!-- fecha .content -->
</body>

</html>