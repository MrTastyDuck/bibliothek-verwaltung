<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderner Header & Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <?php
        echo '
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <i class="bi bi-code-slash me-2"></i>Meine Webseite
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Start</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Über uns</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Dienste</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Kontakt</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        ';
    ?>
    
    <main class="container mt-4">
        <?php
            // Die PHP-Variable für den Text
            $willkommens_text = "Hallo Nutzer";

            echo '
            <div class="p-5 mb-4 bg-primary text-white rounded-3 shadow-sm">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">' . $willkommens_text . '</h1>
                    <p class="col-md-8 fs-4">Willkommen zurück auf unserer modernen Plattform!</p>
                    <button class="btn btn-light btn-lg" type="button">Mehr erfahren</button>
                </div>
            </div>
            ';
        ?>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Abschnitt 1</h2>
                    <p>Hier könnte weiterer Inhalt stehen.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Abschnitt 2</h2>
                    <p>Hier könnte weiterer Inhalt stehen.</p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>
</html>