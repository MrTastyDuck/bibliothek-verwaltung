<?php

// SORTIEREN KUNDE
$allowed_orders = ['nr', 'vname', 'name', 'email', 'tel'];
$order = '';

if (isset($_GET['sort_kunden'], $_GET['auswahl_sort_kunden']) && in_array($_GET['auswahl_sort_kunden'], $allowed_orders)) {
    $order = $_GET['auswahl_sort_kunden'];
}

$search = $_GET['search_kunde_nr'] ?? '';

// HINZUFÜGEN KUNDE
if (isset($_GET['add_kunde'])) {
    $k_nr = mysqli_real_escape_string($db, $_GET['add_k_nr']);
    $k_vname = mysqli_real_escape_string($db, $_GET['add_k_vname']);
    $k_name = mysqli_real_escape_string($db, $_GET['add_k_name']);
    $k_email = mysqli_real_escape_string($db, $_GET['add_k_email']);
    $k_tel = mysqli_real_escape_string($db, $_GET['add_k_tel']);
    $k_datum = mysqli_real_escape_string($db, $_GET['add_k_datum']);

    if ($k_nr && $k_vname && $k_name && $k_email && $k_tel && $k_datum) {
        mysqli_query($db, "INSERT INTO t_user VALUES ('$k_nr','$k_vname','$k_name','$k_email','$k_tel','$k_datum')");
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
            name='$k_vname',
            vname='$k_name',
            email= '$k_email',
            tel = '$k_tel',
            kunde_seit='$k_datum',
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
if (isset($_GET['k_edit_form'])) {
    $k_nr = mysqli_real_escape_string($db, $_GET['isbn']);
    $res = mysqli_query($db, "SELECT * FROM t_user WHERE kunden_nr='$k_nr'");
    $kunde = mysqli_fetch_assoc($res);
}

// LÖSCHEN KUNDE
if (isset($_GET['delete'])) {
    $k_nr = mysqli_real_escape_string($db, $_GET['k_delete']);

    if ($isbn !== '') {
        mysqli_query($db, "DELETE FROM t_user WHERE kunden_nr='$k_nr'");
    }
}
