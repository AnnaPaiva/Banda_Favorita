<?php
require_once __DIR__ . '/../includes/config.php';


if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: produtos.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch();

if (!$produto) {
    header("Location: produtos.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $sql = "UPDATE produtos 
            SET nome = ?, descricao = ?, preco = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $preco, $id]);

    header("Location: produtos.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
            max-width: 600px;
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

        .form-control:focus {
            background-color: #555;
            color: #e8e2e2;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #eaf20d;
            border: none;
            color: #333030;
        }

        .btn-primary:hover {
            background-color: #d4c80e;
            color: #333030;
        }

        .btn-secondary {
            background-color: #555;
            border: none;
            color: #e8e2e2;
        }

        .btn-secondary:hover {
            background-color: #333030;
            color: #e8e2e2;
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

<body class="container mt-5">

    <h2>Editar Produto</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>"
                required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control"
                required><?= htmlspecialchars($produto['descricao']) ?></textarea>
        </div>

        <div class="mb-3">
            <label>Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="<?= $produto['preco'] ?>"
                required>
        </div>

        <button class="btn btn-primary">Atualizar</button>
        <a href="produtos.php" class="btn btn-secondary">Cancelar</a>

    </form>

</body>

</html>