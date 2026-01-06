<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "bibl";

$db = mysqli_connect($server, $user, $pass, $database) or die("Verbindungsprobleme");
