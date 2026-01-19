<?php

// SORTIEREN BUCH
$allowed_orders = ['isbn', 'titel', 'autor', 'verlag', 'status', 'buch_nr'];
$order = '';

if (isset($_POST['abschicken'], $_POST['auswahl']) && in_array($_POST['auswahl'], $allowed_orders)) {
    $order = $_POST['auswahl'];
}

$search = $_POST['search_titel'] ?? '';

// HINZUFÜGEN BUCH
if (isset($_POST['add'])) {
    $isbn = mysqli_real_escape_string($db, $_POST['add_isbn']);
    $titel = mysqli_real_escape_string($db, $_POST['add_titel']);
    $autor = mysqli_real_escape_string($db, $_POST['add_autor']);
    $verlag = mysqli_real_escape_string($db, $_POST['add_verlag']);
    $genre = mysqli_real_escape_string($db, $_POST['add_genre']);
    $beschreibung = mysqli_real_escape_string($db, $_POST['add_beschreibung']);
    $status = mysqli_real_escape_string($db, $_POST['add_status']);

    if ($isbn && $titel && $autor && $verlag && $genre && $beschreibung && $status) {
        // Get the next buch_nr
        $result = mysqli_query($db, "SELECT MAX(buch_nr) AS max_nr FROM t_book");
        $row = mysqli_fetch_assoc($result);
        $next_nr = $row['max_nr'] ? $row['max_nr'] + 1 : 1;
        mysqli_query($db, "INSERT INTO t_book VALUES ('$next_nr','$isbn','$titel','$autor','$verlag','$genre','$beschreibung','$status')");
    }
}

// UPDATEN BUCH
if (isset($_POST['edit'])) {
    $old_isbn = mysqli_real_escape_string($db, $_POST['old_isbn']);
    $isbn = mysqli_real_escape_string($db, $_POST['edit_isbn']);
    $titel = mysqli_real_escape_string($db, $_POST['edit_titel']);
    $autor = mysqli_real_escape_string($db, $_POST['edit_autor']);
    $verlag = mysqli_real_escape_string($db, $_POST['edit_verlag']);
    $genre = mysqli_real_escape_string($db, $_POST['edit_genre']);
    $beschreibung = mysqli_real_escape_string($db, $_POST['edit_beschreibung']);
    $status = mysqli_real_escape_string($db, $_POST['edit_status']);
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
if (isset($_POST['edit_form'])) {
    $isbn = mysqli_real_escape_string($db, $_POST['isbn']);
    $res = mysqli_query($db, "SELECT * FROM t_book WHERE isbn='$isbn'");
    $buch = mysqli_fetch_assoc($res);
}

// LÖSCHEN BUCH
if (isset($_POST['delete'])) {
    $isbn = mysqli_real_escape_string($db, $_POST['delete']);

    if ($isbn !== '') {
        mysqli_query($db, "DELETE FROM t_book WHERE isbn='$isbn'");
    }
}
