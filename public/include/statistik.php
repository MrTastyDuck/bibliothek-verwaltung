<?php
$gesamtzahl_buecher_sql = mysqli_query($db, "SELECT COUNT(*) FROM t_book");
$gesamtzahl_buecher = mysqli_fetch_row($gesamtzahl_buecher_sql)[0];

$gesamtzahl_kunden_sql = mysqli_query($db, "SELECT COUNT(*) FROM t_user");
$gesamtzahl_kunden = mysqli_fetch_row($gesamtzahl_kunden_sql)[0];

$gesamtzahl_ausleihe_sql = mysqli_query($db, "SELECT COUNT(*) FROM t_ausleihe");
$gesamtzahl_ausleihe = mysqli_fetch_row($gesamtzahl_ausleihe_sql)[0];

$gesamtzahl_ausleihe_aktiv_sql = mysqli_query($db, "SELECT COUNT(*) FROM t_ausleihe WHERE status = 'ausgeliehen'");
$gesamtzahl_ausleihe_aktiv = mysqli_fetch_row($gesamtzahl_ausleihe_aktiv_sql)[0];