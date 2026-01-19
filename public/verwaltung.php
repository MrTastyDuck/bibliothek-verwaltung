<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: anmelden.php");
}

require_once 'include/db.php';
require_once 'include/statistik.php';
require_once 'include/buch_aktionen.php';
require_once 'include/kunde_aktionen.php';
require_once 'include/verleih_aktionen.php';
require_once 'include/admin_aktionen.php';
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Bücherverwaltung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    <div class="container-fluid p-4">

        <div class="d-flex justify-content-center align-items-center mb-4">
            <h1 class="text-primary fw-bold me-3">Bücherverwaltung</h1>
            <a href="logout.php" class="btn btn-outline-danger rounded-pill">Logout</a>
        </div>

        <!-- NAVBAR -->
        <ul class="nav nav-pills justify-content-center mb-4 shadow-sm bg-white rounded-pill p-2">
            <li class="nav-item">
                <a class="nav-link <?= $tab === 'buch' ? 'active bg-primary' : 'text-primary' ?> rounded-pill fw-semibold px-4" href="?tab=buch">
                    Bücher
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $tab === 'kunde' ? 'active bg-primary' : 'text-primary' ?> rounded-pill fw-semibold px-4" href="?tab=kunde">
                    Kunden
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $tab === 'verleih' ? 'active bg-primary' : 'text-primary' ?> rounded-pill fw-semibold px-4" href="?tab=verleih">
                    Verleih
                </a>
            </li>
        </ul>


        <div class="tab-content">
            <?php
            $tab = $_GET['tab'] ?? 'buch';
            if ($tab === 'buch') {
                require_once 'include/tab_buch.php';
            }
            if ($tab === 'kunde') {
                require_once 'include/tab_kunde.php';
            }
            if ($tab === 'verleih') {
                require_once 'include/tab_verleih.php';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>