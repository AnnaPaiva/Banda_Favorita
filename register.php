<?php
require 'includes/config.php';

//Variáveis de erro e de sucesso
$errors = [];
$success = "";

//Tratamento do formulário
//Verificar se o formulário foi submetido, via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Recolher dados
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    //Validações - fazer as verificações do formulário (todos os campis são de preenchimento obrigatório)

    //username - deve conter pelo menos 3 caracteres
    if (empty($username)) {
        $errors[] = 'Username é obrigatório';
    } elseif (strlen($username) < 3) {
        $errors[] = 'Username deve ter pelo menos 3 caracteres';
    }

    //Email - verificar se email segue o tipo xxxx@xxxxx.xxx
    if (empty($email)) {
        $errors[] = 'Email é obrigatório';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email inválido';
    }

    //password  - tenha pelo menos 6 caracteres
    if (empty($password)) {
        $errors[] = 'Password é obrigatória';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password deve conter pelo menos 6 caracteres';
    }

    //Confirmar passowrd - as passwords têm de coincidir
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords não coincidem';
    }

    if (empty($errors)) {
        try {

            //verificar se já existe registo com o email - estamos averificar se na tabela users já existe alguem com o mesmo email e se sim, adicionamos erro

            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $errors[] = 'Este email já está registado';
            } else {
                //inserir novo utilizador
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT into users (username, email, senha) VALUES (?, ?, ?)");
                $stmt->execute([$username, $email, $hashed_password]);

                //verificzar sucesso do registo e limpar o formulário
                $success = "Registo realizado com sucesso!";
                $_POST = [];
            }
        } catch (PDOException $e) {
            $errors[] = 'Erro no registo: ' . $e->getMessage();
        }
    }
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
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
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
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit">Registar</button>
        </form>

        <p style="text-align: center; margin-top: 15px;">
            Já tem conta? <a href="login.php">Faça login aqui</a>
        </p>
    </div>
</body>

</html>