<?php
// SUCHEN AUSLEIHE
$sql = "SELECT * FROM t_ausleihe";
if ($search) {
    $safe = mysqli_real_escape_string($db, $search);
    $sql .= " WHERE kunden_nr LIKE '%$safe%'";
}

// HINZUFÜGEN AUSLEIHE
if (isset($_POST['add_verleih'])) {
    $v_knr = mysqli_real_escape_string($db, $_POST['add_knr']);
    $v_bisbn = mysqli_real_escape_string($db, $_POST['add_bisbn']);
    $v_bibnr = mysqli_real_escape_string($db, $_POST['add_bibnr']);
    $v_date = mysqli_real_escape_string($db, $_POST['add_date']);
    $v_status = mysqli_real_escape_string($db, $_POST['add_status']);

    if ($v_knr && $v_bisbn && $v_bibnr && $v_date && $v_status) {
        $result = mysqli_query($db, "SELECT MAX(ausleihe_nr) AS max_nr FROM t_ausleihe");
        $row = mysqli_fetch_assoc($result);
        $next_nr = $row['max_nr'] ? $row['max_nr'] + 1 : 1;
        mysqli_query($db, "
            INSERT INTO t_ausleihe (ausleihe_nr, kunden_nr, buch_isbn, bibliothekar_nr, datum, status)
            VALUES ('$next_nr','$v_knr','$v_bisbn','$v_bibnr','$v_date','$v_status')
        ");
        mysqli_query($db, "
            UPDATE t_book SET
                status='ausgeliehen'
            WHERE isbn='$v_bisbn'
        ");
    }
}


// UPDATEN AUSLEIHE
if (isset($_POST['v_edit_form'])) {
    $old_v_nr = mysqli_real_escape_string($db, $_POST['v_old_nr']);
    $v_knr = mysqli_real_escape_string($db, $_POST['v_edit_knr']);
    $v_bisbn = mysqli_real_escape_string($db, $_POST['v_edit_bisbn']);
    $v_bibnr = mysqli_real_escape_string($db, $_POST['v_edit_bibnr']);
    $v_date = mysqli_real_escape_string($db, $_POST['v_edit_date']);
    $v_status = mysqli_real_escape_string($db, $_POST['v_edit_status']);

    mysqli_query($db, "
        UPDATE t_ausleihe SET
            kunden_nr='$v_knr',
            buch_isbn='$v_bisbn',
            bibliothekar_nr='$v_bibnr',
            datum='$v_date',
            status='$v_status'
        WHERE ausleihe_nr='$old_v_nr'
    ");
}

$result = mysqli_query($db, $sql);
$rows_v = mysqli_fetch_all($result, MYSQLI_ASSOC);

// BEARBEITEN AUSLEIHE
$ausleihe = null;
if (isset($_POST['v_edit'])) {
    $v_nr = mysqli_real_escape_string($db, $_POST['ausleihe_nr']);
    $res = mysqli_query($db, "SELECT * FROM t_ausleihe WHERE ausleihe_nr='$v_nr'");
    $ausleihe = mysqli_fetch_assoc($res);
}


// RETURN AUSLEIHE
if (isset($_POST['v_return'])) {
    $v_nr = mysqli_real_escape_string($db, $_POST['v_return']);

    if ($v_nr !== '') {

        $res = mysqli_query($db, "SELECT buch_isbn FROM t_ausleihe WHERE ausleihe_nr='$v_nr'");
        $row = mysqli_fetch_assoc($res);
        $buch_isbn = $row['buch_isbn'];

        mysqli_query($db, "
            UPDATE t_book SET
                status='verfügbar'
            WHERE isbn='$buch_isbn'
        ");

        mysqli_query($db, "
            UPDATE t_ausleihe SET
                status='abgeschlossen'
            WHERE ausleihe_nr='$v_nr'
        ");
    }
}
?>