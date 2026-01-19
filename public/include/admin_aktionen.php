<?php

// HINZUFÜGEN ADMINISTRATOR
if (isset($_GET['add_admin'])) {
    $a_vname = mysqli_real_escape_string($db, $_GET['add_a_vname']);
    $a_name = mysqli_real_escape_string($db, $_GET['add_a_name']);
    $a_email = mysqli_real_escape_string($db, $_GET['add_a_email']);
    $a_tel = mysqli_real_escape_string($db, $_GET['add_a_tel']);
    $a_username = mysqli_real_escape_string($db, $_GET['add_a_username']);
    $a_password = mysqli_real_escape_string($db, $_GET['add_a_password']);
    $a_password_hashed = password_hash($a_password, PASSWORD_DEFAULT);

    if ($a_vname && $a_name && $a_email && $a_tel && $a_username && $a_password) {
        mysqli_query($db, "
            INSERT INTO t_bibliothekar (vname, name, email, tel, benutzername, passwort)
            VALUES ('$a_vname','$a_name','$a_email','$a_tel','$a_username','$a_password_hashed')
        ");
    }
}

?>
