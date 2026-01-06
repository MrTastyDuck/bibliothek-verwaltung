<?php
require_once 'include/db.php';
require_once 'include/statistik.php';
require_once 'include/buch_aktionen.php';
require_once 'include/kunde_aktionen.php';
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Bücherverwaltung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-4">

        <h1 class="mb-4"> Bücherverwaltung</h1>

        <!-- NAVBAR -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link <?= $tab === 'buch' ? 'active' : '' ?>" href="?tab=buch">
                    Bücher
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $tab === 'kunde' ? 'active' : '' ?>" href="?tab=kunde">
                    Kunden
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
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>