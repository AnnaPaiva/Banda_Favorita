<?php
include '../config.php'; // conexão correta

$sql = "SELECT * FROM event_details";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detalhes dos Eventos</title>
</head>

<body>

    <h1>Detalhes dos Eventos</h1>

    <table border="1">
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

        <?php while ($row = $result->fetch_assoc()) { ?>
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

</body>

</html>