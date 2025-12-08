<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "bibl";

$db = mysqli_connect($server, $user, $pass, $database) or die("Verbindungsprobleme");

$allowed_orders = ['isbn', 'titel', 'autor'];
$order = '';

if (isset($_GET['abschicken']) && isset($_GET['auswahl']) && in_array($_GET['auswahl'], $allowed_orders)) {
    $order = $_GET['auswahl'];
}

$search = $_GET['titel'] ?? '';

$sql = "SELECT isbn, titel, autor, beschreibung FROM book";
$filter = [];

if ($search !== '') {
    $safe = mysqli_real_escape_string($db, $search);
    $filter[] = "titel LIKE '%$safe%'";
}

if (!empty($filter)) {
    $sql .= " WHERE " . implode(" AND ", $filter);
}

if ($order) {
    $sql .= " ORDER BY $order";
}

$result = mysqli_query($db, $sql);
$rows = [];

while ($zeile = mysqli_fetch_assoc($result)) {
    $rows[] = $zeile;
}

mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid black;
            padding: 4px;
        }

        th {
            font-weight: bold;
        }
    </style>
    <title>Bücher</title>
</head>

<body>

    <h1>Sortieren</h1>
    <form method="get">
        <label><input type="radio" name="auswahl" value="isbn"> ISBN</label><br>
        <label><input type="radio" name="auswahl" value="titel"> Titel</label><br>
        <label><input type="radio" name="auswahl" value="autor"> Autor</label><br>
        <button type="submit" name="abschicken">Sortieren</button>
    </form>

    <h1>Sucehn</h1>
    <form method="get">
        <input type="text" name="titel" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Suchen</button>
    </form>

    <h1>Bücherliste</h1>
    <table>
        <tr>
            <th>ISBN</th>
            <th>Titel</th>
            <th>Autor</th>
            <th>Beschreibung</th>
        </tr>

        <?php foreach ($rows as $zeile): ?>
            <tr>
                <td><?= htmlspecialchars($zeile["isbn"]) ?></td>
                <td><?= htmlspecialchars($zeile["titel"]) ?></td>
                <td><?= htmlspecialchars($zeile["autor"]) ?></td>
                <td><?= htmlspecialchars($zeile["beschreibung"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>