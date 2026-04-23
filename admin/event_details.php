<?php
include '../includes/config.php';
include 'menu.php'; // conexão correta

$sql = "SELECT * FROM event_details";
$result = $pdo->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detalhes dos Eventos</title>

    <style>
        body {
            background-color: #1f1d1d;
            font-family: Arial, sans-serif;
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

        h2 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 30px;
            color: #e8e2e2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background-color: #4a4646;
            padding: 12px;
            font-size: 16px;
            color: #e8e2e2;
            border-bottom: 2px solid #222;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #555;
            color: #e8e2e2;
        }

        tr:hover {
            background-color: #3d3a3a;
        }
    </style>
</head>

<body>

    <h1>Detalhes dos Eventos</h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Evento</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Local</th>
            <th>Capacidade</th>
            <th>Total Bilhetes</th>
            <th>Vendidos</th>
            <th>Disponíveis</th>
        </tr>

        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?= $row['event_id'] ?></td>
                <td><?= $row['event_name'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['time'] ?></td>
                <td><?= $row['venue'] ?></td>
                <td><?= $row['capacity'] ?></td>
                <td><?= $row['total_tickets'] ?></td>
                <td><?= $row['sold_tickets'] ?></td>
                <td><?= $row['available_tickets'] ?></td>
            </tr>
        <?php } ?>

    </table>
    </div> <!-- fecha .content -->
</body>

</html>