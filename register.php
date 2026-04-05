<?php
require_once __DIR__ . '/includes/config.php';

$success = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome      = trim($_POST['nome']);
    $email     = trim($_POST['email']);
    $username  = trim($_POST['username']);
    $senha = $_POST['senha'];
    $telefone  = trim($_POST['telefone']);
    $endereco  = trim($_POST['endereco']);
    $imagem    = null;
    $tipo      = 'cliente';


    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO users 
        (nome, email, username, senha, telefone, endereco, imagem, tipo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $nome,
        $email,
        $username,
        $senhaHash,
        $telefone,
        $endereco,
        $imagem,
        $tipo
    ]);

    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo de Utilizador</title>
    <style>
    body {
        margin: 0;
        padding: 20px;
        background-color: #161515;
        color: #f9f2f2;
        font-family: "Amatic SC", sans-serif;
    }



    .container {
        max-width: 400px;
        margin: 50px auto;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }

    .error {
        color: red;
        margin-bottom: 15px;
    }

    .success {
        color: green;
        margin-bottom: 15px;
    }
    </style>

</head>

<body>
    <div class="container">
        <h2>Registo de Utilizador</h2>

        <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ($success): ?>
        <div class="success">
            <p><?php echo htmlspecialchars($success); ?></p>
        </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="senha"
                    value="<?php echo isset($_POST['senha']) ? htmlspecialchars($_POST['senha']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Password:</label>
                <input type="password" id="confirm_password" name="confirm_senha" required>
            </div>

            <button type="submit">Registar</button>
        </form>

        <p style="text-align: center; margin-top: 15px;color: #333;">
            Já tem conta? <a style="text-align: center; margin-top: 15px;color: #333;" href="login.php">Faça login
                aqui</a>
        </p>
    </div>
</body>

</html>