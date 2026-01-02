<?php
// Incluir o ficgeiro de configuração que contem a ligação à base de dados
require 'includes/config.php';
// Iniciar a sessão - necessário para usar variáveis de sessão
session_start();
// Iniciar um array vazio para atmazenar as mensagens de erro
$errors = [];
//veriricar se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Remove espaços em branco do inicio e do fim do email e da password e guarda na variavel
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //validações - verificar se o email e/ou a password estão vazios
    if (empty($email)) {
        $errors[] = 'Email é obrigatório';
    }
    if (empty($password)) {
        $errors[] = 'Password é obrigatória';
    }
    //se não houver erros de validação ())array $errors vazio) prossegue
    if (empty($erros)) {
        try {

            //preparar a consulta SQL para procurar o utilizador por email
            $stmt = $pdo->prepare("SELECT id, username, email, senha FROM users WHERE email = ?");
            //executa a consulta substituindo o ? pelo valor do email
            $stmt->execute([$email]);
            //Verificar se encontrou exatamente 1 utilizador com o email inserido
            if ($stmt->rowCount() === 1) {
                //Buscar os dados do utilizador a guardar num array associativo
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                //verirficar a password
                //verificar se a pass fornecida correponde ao hash guardado na BD
                //password_verify() que compara a password em texto com o hash de uma forma segura
                if (password_verify($password, $user['senha'])) {
                    //login bem-sucedido - cria as variáveis de sessão
                    $_SESSION['user_id'] = $user['id']; // guarda o id do utilizador
                    $_SESSION['username'] = $user['username']; // guarda o username do utilizador
                    $_SESSION['email'] = $user['email']; // guarda o email do utilizador
                    $_SESSION['logged_in'] = true; //marca o user como logado

                    //redirecionar para a página de perfil do utilizador
                    header('Location: perfil.php');
                    //terminar a execução do script exatamente depois de redirecionar
                    exit;
                } else {
                    //se password_verify() retornar false - password está incorreta 
                    $errors[] = 'Password incorreta';
                }
                //Se rowCount não for 1- não encontrou utilizador com email    
            } else {
                $errors[] = 'Utilizador não encontrado';
            }
        } catch (PDOException $e) {
            //capturar qualquer exceção/erro da base de dados
            //adicionar mensagem de erro genérica com detalhes da exceção
            $errors = 'Erro de login: ' . $e->getMessage();
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
            <div class="form-group">
                <label for="email">Email:</label>
                <!-- Verifica se o campo de email foi submetido; Se sim, mostra o valor; Se não, mostra Sting vazia -->
                <input type="email" id="email" name="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <p style="text-align: center; margin-top: 15px;">
            Não tem conta? <a href="register.php">Registe-se aqui</a>
        </p>
    </div>
</body>

</html>