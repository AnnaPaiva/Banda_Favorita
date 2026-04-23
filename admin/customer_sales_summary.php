<?php
include '../includes/config.php';
include 'menu.php';

$sql = "SELECT * FROM customer_sales_summary";
$result = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Resumo de Compras dos Clientes</title>

    <style>
        body {
            background-color: #1f1d1d;
            font-family: Arial, sans-serif;
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

        h2 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 30px;
            color: #e8e2e2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #4a4646;
            padding: 12px;
            border-bottom: 2px solid #222;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #555;
        }

        tr:hover {
            background-color: #3d3a3a;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Resumo de Compras dos Clientes</h2>

        <table>
            <tr>
                <th>ID Cliente</th>
                <th>Nome</th>
                <th>Bilhetes Comprados</th>
                <th>Total Gasto (€)</th>
            </tr>

            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?= $row['customer_id'] ?></td>
                    <td><?= $row['customer_name'] ?></td>
                    <td><?= $row['number_of_tickets_purchased'] ?></td>
                    <td><?= number_format($row['total_spent'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    </div> <!-- fecha .content -->
</body>

</html>