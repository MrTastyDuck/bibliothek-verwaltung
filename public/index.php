<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "bibl";

$db = mysqli_connect($server, $user, $pass, $database) or die("Verbindungsprobleme");

// STATISTIK
$gesamtzahl_buecher_sql = mysqli_query($db, "SELECT COUNT(*) FROM t_book");
$gesamtzahl_buecher = mysqli_fetch_row($gesamtzahl_buecher_sql)[0];

$gesamtzahl_kunden_sql = mysqli_query($db, "SELECT COUNT(*) FROM t_user");
$gesamtzahl_kunden = mysqli_fetch_row($gesamtzahl_kunden_sql)[0];


// SORTIEREN
$allowed_orders = ['isbn', 'titel', 'autor', 'verlag', 'status', 'buch_nr'];
$order = '';

if (isset($_GET['abschicken'], $_GET['auswahl']) && in_array($_GET['auswahl'], $allowed_orders)) {
    $order = $_GET['auswahl'];
}

$search = $_GET['search_titel'] ?? '';

// HINZUFÜGEN BUCH
if (isset($_GET['add'])) {
    $nr = mysqli_real_escape_string($db, $_GET['add_nr']);
    $isbn = mysqli_real_escape_string($db, $_GET['add_isbn']);
    $titel = mysqli_real_escape_string($db, $_GET['add_titel']);
    $autor = mysqli_real_escape_string($db, $_GET['add_autor']);
    $verlag = mysqli_real_escape_string($db, $_GET['add_verlag']);
    $genre = mysqli_real_escape_string($db, $_GET['add_genre']);
    $beschreibung = mysqli_real_escape_string($db, $_GET['add_beschreibung']);
    $status = mysqli_real_escape_string($db, $_GET['add_status']);

    if ($nr && $isbn && $titel && $autor && $verlag && $genre && $beschreibung && $status) {
        mysqli_query($db, "INSERT INTO t_book VALUES ('$nr','$isbn','$titel','$autor','$verlag','$genre','$beschreibung','$status')");
    }
}

// UPDATEN
if (isset($_GET['edit'])) {
    $old_isbn = mysqli_real_escape_string($db, $_GET['old_isbn']);
    $isbn = mysqli_real_escape_string($db, $_GET['edit_isbn']);
    $titel = mysqli_real_escape_string($db, $_GET['edit_titel']);
    $autor = mysqli_real_escape_string($db, $_GET['edit_autor']);
    $verlag = mysqli_real_escape_string($db, $_GET['edit_verlag']);
    $genre = mysqli_real_escape_string($db, $_GET['edit_genre']);
    $beschreibung = mysqli_real_escape_string($db, $_GET['edit_beschreibung']);
    $status = mysqli_real_escape_string($db, $_GET['edit_status']);
    mysqli_query($db, "
        UPDATE t_book SET
            isbn='$isbn',
            titel='$titel',
            autor='$autor',
            verlag= '$verlag',
            genre = '$genre',
            beschreibung='$beschreibung',
            status = '$status'
        WHERE isbn='$old_isbn'
    ");
}

// SUCHEN
$sql = "SELECT * FROM t_book";
if ($search) {
    $safe = mysqli_real_escape_string($db, $search);
    $sql .= " WHERE titel LIKE '%$safe%'";
}
if ($order) {
    $sql .= " ORDER BY $order";
}

$result = mysqli_query($db, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// BEARBEITEN
$buch = null;
if (isset($_GET['edit_form'])) {
    $isbn = mysqli_real_escape_string($db, $_GET['isbn']);
    $res = mysqli_query($db, "SELECT * FROM t_book WHERE isbn='$isbn'");
    $buch = mysqli_fetch_assoc($res);
}

// LÖSCHEN
if (isset($_GET['delete'])) {
    $isbn = mysqli_real_escape_string($db, $_GET['delete']);

    if ($isbn !== '') {
        mysqli_query($db, "DELETE FROM t_book WHERE isbn='$isbn'");
    }
}
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-books">
                    Bücher
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-customers">
                    Kunden
                </button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- TAB 1: -->
            <div class="tab-pane fade show active" id="tab-books">

                <!-- STATISTIK -->
                <div class="card mb-3">
                    <div class="card-header">Statistik</div>
                    <div class="card-body">
                        <div>
                            <p>Gesamtzahl Bücher:</p>
                            <b><?= $gesamtzahl_buecher ?></b>
                        </div>
                        <div>
                            <p>Gesamtzahl Kunden:</p>
                            <b><?= $gesamtzahl_kunden ?></b>
                        </div>
                    </div>
                </div>

                <!-- SORTIEREN -->
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="get" class="d-flex gap-3">
                            <select name="auswahl" class="form-select w-auto">
                                <option value="buch_nr">Nr</option>
                                <option value="isbn">ISBN</option>
                                <option value="titel">Titel</option>
                                <option value="autor">Autor</option>
                                <option value="verlag">verlag</option>
                                <option value="status">Status</option>
                            </select>
                            <button class="btn btn-primary" name="abschicken">Sortieren</button>
                        </form>
                    </div>
                </div>

                <!-- HINZUFÜGEN BUCH-->
                <div class="card mb-3">
                    <div class="card-header">Buch hinzufügen</div>
                    <div class="card-body">
                        <form method="get" class="row g-3">
                            <input class="form-control" name="add_nr" placeholder="Nr">
                            <input class="form-control" name="add_isbn" placeholder="ISBN">
                            <input class="form-control" name="add_titel" placeholder="Titel">
                            <input class="form-control" name="add_autor" placeholder="Autor">
                            <input class="form-control" name="add_verlag" placeholder="Verlag">
                            <input class="form-control" name="add_genre" placeholder="Genre">
                            <textarea class="form-control" name="add_beschreibung" placeholder="Beschreibung"></textarea>
                            <select name="add_status" class="form-select">
                                <option value="verfügbar">Verfügbar</option>
                                <option value="ausgeliehen">Ausgeliehen</option>
                                <option value="reserviert">Reserviert</option>
                            </select>
                            <button class="btn btn-success" name="add">Hinzufügen</button>
                        </form>
                    </div>
                </div>

                <!-- SUCHEN -->
                <form method="get" class="input-group mb-3">
                    <input class="form-control" name="search_titel" value="<?= htmlspecialchars($search) ?>" placeholder="Titel suchen">
                    <button class="btn btn-outline-secondary">Suchen</button>
                </form>

                <!-- TABELLE -->
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nr</th>
                            <th>ISBN</th>
                            <th>Titel</th>
                            <th>Autor</th>
                            <th>Verlag</th>
                            <th>Genre</th>
                            <th>Beschreibung</th>
                            <th>Status</th>
                            <th>Aktion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td><?= htmlspecialchars($r['buch_nr']) ?></td>
                                <td><?= htmlspecialchars($r['isbn']) ?></td>
                                <td><?= htmlspecialchars($r['titel']) ?></td>
                                <td><?= htmlspecialchars($r['autor']) ?></td>
                                <td><?= htmlspecialchars($r['verlag']) ?></td>
                                <td><?= htmlspecialchars($r['genre']) ?></td>
                                <td><?= htmlspecialchars($r['beschreibung']) ?></td>
                                <td><?= htmlspecialchars($r['status']) ?></td>
                                <td class="d-flex gap-2">
                                    <a class="btn btn-sm btn-warning"
                                        href="?edit_form=1&isbn=<?= urlencode($r['isbn']) ?>">
                                        Bearbeiten
                                    </a>
                                    <a class="btn btn-sm btn-danger"
                                        href="?delete=<?= urlencode($r['isbn']) ?>">
                                        Löschen
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- BEARBEITEN -->
                <?php if ($buch): ?>
                    <div class="card mt-4">
                        <div class="card-header">Buch bearbeiten</div>
                        <div class="card-body">
                            <form method="get">
                                <input type="hidden" name="old_isbn" value="<?= $buch['isbn'] ?>">
                                <input class="form-control mb-2" name="edit_isbn" value="<?= $buch['isbn'] ?>">
                                <input class="form-control mb-2" name="edit_titel" value="<?= $buch['titel'] ?>">
                                <input class="form-control mb-2" name="edit_autor" value="<?= $buch['autor'] ?>">
                                <input class="form-control mb-2" name="edit_verlag" value="<?= $buch['verlag'] ?>">
                                <input class="form-control mb-2" name="edit_genre" value="<?= $buch['genre'] ?>">
                                <textarea class="form-control mb-2" name="edit_beschreibung"><?= $buch['beschreibung'] ?></textarea>
                                <input class="form-control mb-2" name="edit_status" value="<?= $buch['status'] ?>">
                                <button class="btn btn-primary" name="edit">Speichern</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <!--  TAB 2  -->
            <div class="tab-pane fade" id="tab-customers">

                <!-- HINZUFÜGEN KUNDE-->
                <div class="card mb-3">
                    <div class="card-header">Kunde hinzufügen</div>
                    <div class="card-body">
                        <form method="get" class="row g-3">
                            <input class="form-control" name="add_k_nr" placeholder="Nr">
                            <input class="form-control" name="add_k_name" placeholder="Name">
                            <input class="form-control" name="add_k_vname" placeholder="Vorname">
                            <input class="form-control" name="add_k_email" placeholder="E-Mail">
                            <input class="form-control" name="add_k_tel" placeholder="Telefonnummer">
                            <input class="form-control" name="add_k_datum" placeholder="Eintragungsdatum">
                            <button class="btn btn-success" name="add_k">Kunde Hinzufügen</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>