<?php

// SORTIEREN KUNDE
$allowed_orders = ['kunden_nr', 'vname', 'name', 'email', 'tel'];
$order = '';

if (isset($_GET['sort_kunden'], $_GET['auswahl_sort_kunden']) && in_array($_GET['auswahl_sort_kunden'], $allowed_orders)) {
    $order = $_GET['auswahl_sort_kunden'];
}

$search = $_GET['search_kunde_nr'] ?? '';


// HINZUFÜGEN KUNDE
if (isset($_GET['add_kunde'])) {
    $k_vname = mysqli_real_escape_string($db, $_GET['add_k_vname']);
    $k_name = mysqli_real_escape_string($db, $_GET['add_k_name']);
    $k_email = mysqli_real_escape_string($db, $_GET['add_k_email']);
    $k_tel = mysqli_real_escape_string($db, $_GET['add_k_tel']);
    $k_datum = mysqli_real_escape_string($db, $_GET['add_k_datum']);

    if ($k_vname && $k_name && $k_email && $k_tel && $k_datum) {
        // Get the next kunden_nr
        $result = mysqli_query($db, "SELECT MAX(kunden_nr) AS max_nr FROM t_user");
        $row = mysqli_fetch_assoc($result);
        $next_nr = $row['max_nr'] ? $row['max_nr'] + 1 : 1;
        mysqli_query($db, "
            INSERT INTO t_user (kunden_nr, vname, name, email, tel, kunde_seit)
            VALUES ('$next_nr','$k_vname','$k_name','$k_email','$k_tel','$k_datum')
        ");
    }
}


// UPDATEN KUNDE
if (isset($_GET['k_edit_form'])) {
    $old_k_nr = mysqli_real_escape_string($db, $_GET['old_k_nr']);
    $k_nr = mysqli_real_escape_string($db, $_GET['edit_k_nr']);
    $k_vname = mysqli_real_escape_string($db, $_GET['edit_k_vname']);
    $k_name = mysqli_real_escape_string($db, $_GET['edit_k_name']);
    $k_email = mysqli_real_escape_string($db, $_GET['edit_k_email']);
    $k_tel = mysqli_real_escape_string($db, $_GET['edit_k_tel']);
    $k_datum = mysqli_real_escape_string($db, $_GET['edit_k_datum']);

    mysqli_query($db, "
        UPDATE t_user SET
            kunden_nr='$k_nr',
            vname='$k_vname',
            name='$k_name',
            email='$k_email',
            tel='$k_tel',
            kunde_seit='$k_datum'
        WHERE kunden_nr='$old_k_nr'
    ");
}


// SUCHEN KUNDE
$sql = "SELECT * FROM t_user";
if ($search) {
    $safe = mysqli_real_escape_string($db, $search);
    $sql .= " WHERE kunden_nr LIKE '%$safe%'";
}
if ($order) {
    $sql .= " ORDER BY $order";
}

$result = mysqli_query($db, $sql);
$rows_k = mysqli_fetch_all($result, MYSQLI_ASSOC);


// BEARBEITEN KUNDE
$kunde = null;
if (isset($_GET['k_edit'])) {
    $k_nr = mysqli_real_escape_string($db, $_GET['kunden_nr']);
    $res = mysqli_query($db, "SELECT * FROM t_user WHERE kunden_nr='$k_nr'");
    $kunde = mysqli_fetch_assoc($res);
}


// LÖSCHEN KUNDE
if (isset($_GET['k_delete'])) {
    $k_nr = mysqli_real_escape_string($db, $_GET['k_delete']);

    if ($k_nr !== '') {
        mysqli_query($db, "DELETE FROM t_user WHERE kunden_nr='$k_nr'");
    }
}
