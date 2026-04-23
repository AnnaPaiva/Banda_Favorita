<?php
session_start();
require_once __DIR__ . '/includes/config.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("
    SELECT nome, email, username, telefone, endereco, imagem, tipo
    FROM users
    WHERE id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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

    <div class="profile-container">

        <div class="profile-card">

            <?php if (!empty($user['imagem'])): ?>
                <img src="uploads/<?= htmlspecialchars($user['imagem']) ?>" class="profile-img">
            <?php endif; ?>

            <h2>Perfil do Utilizador</h2>

            <div class="profile-info">
                <p><strong>Nome:</strong> <?= htmlspecialchars($user['nome']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($user['telefone']) ?></p>
                <p><strong>Endereço:</strong> <?= htmlspecialchars($user['endereco']) ?></p>
                <p><strong>Tipo:</strong> <?= htmlspecialchars($user['tipo']) ?></p>
            </div>

            <button class="logout-btn"><a href="loja.php">Ir para a loja</a><br></button>

            <?php if ($_SESSION['tipo'] === 'admin'): ?>
                <a href="/admin/dashboard.php">Área Admin</a><br>
            <?php endif; ?>

            <button class="logout-btn"><a href="logout.php">Logout</a></button>

        </div>

    </div>

</body>



</html>