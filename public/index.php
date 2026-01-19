<?php
require_once 'include/db.php';
require_once 'include/liste_aktionen.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <title>Bibliothek</title>
</head>

<body class="d-flex flex-column min-vh-100">

 <!-- HEADER -->
 <header class="bg-white shadow-sm border-bottom p-4">
  <div class="container d-flex justify-content-between align-items-center">
   <h1 class="h3 mb-0 text-primary fw-bold">Willkommen bei der Schulbibliothek!</h1>
   <a href="anmelden.php" class="btn btn-outline-primary rounded-pill px-4">
    Anmelden
   </a>
  </div>
 </header>

 <?php require_once 'include/liste.php'; ?>

 <!-- FOOTER -->
 <footer class="bg-light py-3 border-top">
  <div class="container d-flex justify-content-end gap-3">
   <a href="contact.php" class="text-decoration-none">Kontakt</a>
   <a href="impressum.php" class="text-decoration-none">Impressum</a>
   <a href="data.php" class="text-decoration-none">Datenschutz</a>
  </div>
 </footer>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>