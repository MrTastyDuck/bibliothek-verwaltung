<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "bibl";

$db = mysqli_connect($server, $user, $pass, $database) or die("Verbindungsprobleme");

// SORTIEREN
$allowed_orders = ['isbn', 'titel', 'autor'];
$order = '';

if (isset($_GET['abschicken']) && isset($_GET['auswahl']) && in_array($_GET['auswahl'], $allowed_orders)) {
    $order = $_GET['auswahl'];
}

$search = $_GET['search_titel'] ?? '';

// HINZUFÜGEN
if (isset($_GET['add'])) {
    $isbn = mysqli_real_escape_string($db, $_GET['add_isbn']);
    $titel = mysqli_real_escape_string($db, $_GET['add_titel']);
    $autor = mysqli_real_escape_string($db, $_GET['add_autor']);
    $beschreibung = mysqli_real_escape_string($db, $_GET['add_beschreibung']);

    if ($isbn !== "" && $titel !== "" && $autor !== "" && $beschreibung !== "") {
        $sql_insert = "INSERT INTO book (isbn, titel, autor, beschreibung)
                   VALUES ('$isbn', '$titel', '$autor', '$beschreibung')";
        mysqli_query($db, $sql_insert);
    }
}

// SUCHEN
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

    <h1>Hinzufügen</h1>
    <form method="get">
        <label for="isbn">ISBN: </label>
        <input type="text" name="add_isbn" placeholder="ISBN" id="isbn"> <br>
        <br>
        <label for="titel">Titel: </label>
        <input type="text" name="add_titel" placeholder="Titel" id="titel"> <br>
        <br>
        <label for="autor">Autor: </label>
        <input type="text" name="add_autor" placeholder="Autor" id="autor"> <br>
        <br>
        <label for="beschreibung">Beschreibung: </label>
        <input type="textarea" name="add_beschreibung" placeholder="Beschreibung" id="beschreibung"> <br>
        <br>
        <button type="submit" name="add">Hizufügen</button>
    </form>

    <h1>Suchen</h1>
    <form method="get">
        <input type="text" name="search_titel" value="<?= htmlspecialchars($search) ?>">
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