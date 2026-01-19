<?php
// SORTIEREN BUCH
$allowed_orders = ['isbn', 'titel', 'autor', 'verlag', 'status', 'buch_nr'];
$order = '';

if (isset($_POST['abschicken'], $_POST['auswahl']) && in_array($_POST['auswahl'], $allowed_orders)) {
    $order = $_POST['auswahl'];
}

$search = $_POST['search_titel'] ?? '';

// SUCHEN BUCH
$sql = "SELECT * FROM t_book";
if ($search) {
    $safe = mysqli_real_escape_string($db, $search);
    $sql .= " WHERE titel LIKE '%$safe%'";
}
if ($order) {
    $sql .= " ORDER BY $order";
}

$result = mysqli_query($db, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>