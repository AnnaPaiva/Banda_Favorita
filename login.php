<?php


require 'includes/config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($email)) {
        $errors[] = 'Email é obrigatório';
    }

    if (empty($senha)) {
        $errors[] = 'Password é obrigatória';
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                SELECT id, username, email, senha, tipo 
                FROM users 
                WHERE email = ?
            ");
            $stmt->execute([$email]);

            if ($stmt->rowCount() === 1) {

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($senha, $user['senha'])) {

                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['username']  = $user['username'];
                    $_SESSION['email']     = $user['email'];
                    $_SESSION['tipo']      = $user['tipo'];


                    if ($user['tipo'] === 'admin') {
                        header('Location: admin/dashboard.php');
                    } else {
                        header('Location: perfil.php');
                    }
                    exit;
                } else {
                    $errors[] = 'Password incorreta';
                }
            } else {
                $errors[] = 'Utilizador não encontrado';
            }
        } catch (PDOException $e) {
            $errors[] = 'Erro de login. Tente novamente.';
        }
    }
}


?>



<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Utilizador</title>

    <link rel="stylesheet" href="css/meu-ficheiro.css">
    <style>
    body {
        margin: 0;
        padding: 20px;
        background-color: #161515;
        color: #f9f2f2;
        font-family: "Amatic SC", sans-serif;
    }



    .container {
        background-color: #696767ff;
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

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #383737ff;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #218838;
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
        <h2>Login de Utilizador</h2>

        <!-- Verifica se o array $errors NÃO está vazio -->
        <?php if (!empty($errors)): ?>
        <!-- Se houver erros, mostramos os mesmos numa div -->
        <div class="error">
            <!-- percorrer cada erro no array -->
            <?php foreach ($errors as $error): ?>
            <!-- Mostar erro, convertendo caracteres especiais -->
            <p><?php echo htmlspecialchars($error); ?></p>
            <!-- Fim do loop     -->
            <?php endforeach; ?>
        </div>
        <!-- Fim da condição if-->
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 'registered'): ?>
        <div class="success">
            <p>Registo realizado com sucesso! Por favor, faça login.</p>
        </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="senha" required>
            </div>

            <button type="submit">Entrar</button>
        </form>


        <p style="text-align: center; margin-top: 15px;color: #333;">
            Não tem conta? <a style="text-align: center; margin-top: 15px;color: #333;" href="register.php">Registe-se
                aqui</a>
        </p>
    </div>
</body>

</html>