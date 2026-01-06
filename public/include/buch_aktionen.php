<?php

// SORTIEREN BUCH
$allowed_orders = ['isbn', 'titel', 'autor', 'verlag', 'status', 'buch_nr'];
$order = '';

if (isset($_GET['abschicken'], $_GET['auswahl']) && in_array($_GET['auswahl'], $allowed_orders)) {
    $order = $_GET['auswahl'];
}

$search = $_GET['search_titel'] ?? '';

// HINZUFÜGEN BUCH
if (isset($_GET['add'])) {
    $nr = mysqli_real_escape_string($db, $_GET['add_nr']);
    $isbn = mysqli_real_escape_string($db, $_GET['add_isbn']);
    $titel = mysqli_real_escape_string($db, $_GET['add_titel']);
    $autor = mysqli_real_escape_string($db, $_GET['add_autor']);
    $verlag = mysqli_real_escape_string($db, $_GET['add_verlag']);
    $genre = mysqli_real_escape_string($db, $_GET['add_genre']);
    $beschreibung = mysqli_real_escape_string($db, $_GET['add_beschreibung']);
    $status = mysqli_real_escape_string($db, $_GET['add_status']);

    if ($nr && $isbn && $titel && $autor && $verlag && $genre && $beschreibung && $status) {
        mysqli_query($db, "INSERT INTO t_book VALUES ('$nr','$isbn','$titel','$autor','$verlag','$genre','$beschreibung','$status')");
    }
}

// UPDATEN BUCH
if (isset($_GET['edit'])) {
    $old_isbn = mysqli_real_escape_string($db, $_GET['old_isbn']);
    $isbn = mysqli_real_escape_string($db, $_GET['edit_isbn']);
    $titel = mysqli_real_escape_string($db, $_GET['edit_titel']);
    $autor = mysqli_real_escape_string($db, $_GET['edit_autor']);
    $verlag = mysqli_real_escape_string($db, $_GET['edit_verlag']);
    $genre = mysqli_real_escape_string($db, $_GET['edit_genre']);
    $beschreibung = mysqli_real_escape_string($db, $_GET['edit_beschreibung']);
    $status = mysqli_real_escape_string($db, $_GET['edit_status']);
    mysqli_query($db, "
        UPDATE t_book SET
            isbn='$isbn',
            titel='$titel',
            autor='$autor',
            verlag= '$verlag',
            genre = '$genre',
            beschreibung='$beschreibung',
            status = '$status'
        WHERE isbn='$old_isbn'
    ");
}

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


// BEARBEITEN BUCH
$buch = null;
if (isset($_GET['edit_form'])) {
    $isbn = mysqli_real_escape_string($db, $_GET['isbn']);
    $res = mysqli_query($db, "SELECT * FROM t_book WHERE isbn='$isbn'");
    $buch = mysqli_fetch_assoc($res);
}

// LÖSCHEN BUCH
if (isset($_GET['delete'])) {
    $isbn = mysqli_real_escape_string($db, $_GET['delete']);

    if ($isbn !== '') {
        mysqli_query($db, "DELETE FROM t_book WHERE isbn='$isbn'");
    }
}
