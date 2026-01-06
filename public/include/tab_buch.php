<!-- TAB 1: -->
<div class="tab-pane fade show active" id="tab-buch">

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
 <?php if (!$buch): ?>
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
 <?php endif; ?>

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
       href="?delete=<?= urlencode($r['isbn']) ?>"
       onclick="return confirm('Willst du dieses Buch wirklich löschen?')">
       Löschen
      </a>
     </td>
    </tr>
   <?php endforeach; ?>
  </tbody>
 </table>

</div>