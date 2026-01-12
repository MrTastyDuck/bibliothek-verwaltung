<!-- TAB 2: -->
<div class="tab-pane fade show active" id="tab-kunde">

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
    <select name="auswahl_sort_kunden" class="form-select w-auto">
     <option value="kunden_nr">Nr</option>
     <option value="vname">Vorname</option>
     <option value="name">Name</option>
     <option value="email">E-Mail</option>
     <option value="tel">Telefonnummer</option>
    </select>
    <button class="btn btn-primary" name="sort_kunden">Sortieren</button>
   </form>
  </div>
 </div>

 <!-- HINZUFÜGEN -->
 <?php if (!$kunde): ?>
  <div class="card mb-3">
   <div class="card-header">Kunde hinzufügen</div>
   <div class="card-body">
    <form method="get" class="row g-3">
     <input class="form-control" name="add_k_nr" placeholder="Nr">
     <input class="form-control" name="add_k_vname" placeholder="Vorname">
     <input class="form-control" name="add_k_name" placeholder="Name">
     <input class="form-control" name="add_k_email" placeholder="E-Mail">
     <input class="form-control" name="add_k_tel" placeholder="Telefonnummer">
     <input class="form-control" name="add_k_datum" placeholder="Datum der Eintragung">
     <button class="btn btn-success" name="add_kunde">Hinzufügen</button>
    </form>
   </div>
  </div>
 <?php endif; ?>

 <!-- BEARBEITEN -->
 <?php if ($kunde): ?>
  <div class="card mt-4">
   <div class="card-header">Kunde bearbeiten</div>
   <div class="card-body">
    <form method="get">
     <input type="hidden" name="old_k_nr" value="<?= $kunde['kunden_nr'] ?>">
     <input class="form-control mb-2" name="edit_k_nr" value="<?= $kunde['kunden_nr'] ?>">
     <input class="form-control mb-2" name="edit_k_vname" value="<?= $kunde['vname'] ?>">
     <input class="form-control mb-2" name="edit_k_name" value="<?= $kunde['name'] ?>">
     <input class="form-control mb-2" name="edit_k_email" value="<?= $kunde['email'] ?>">
     <input class="form-control mb-2" name="edit_k_tel" value="<?= $kunde['tel'] ?>">
     <textarea class="form-control mb-2" name="edit_k_datum"><?= $kunde['kunde_seit'] ?></textarea>
     <button class="btn btn-primary" name="k_edit_form">Speichern</button>
    </form>
   </div>
  </div>
 <?php endif; ?>

 <!-- SUCHEN -->
 <form method="get" class="input-group mb-3">
  <input class="form-control" name="search_kunde_nr" value="<?= htmlspecialchars($search) ?>" placeholder="Kunde suchen">
  <button class="btn btn-outline-secondary">Suchen</button>
 </form>

 <!-- TABELLE -->
 <table class="table table-striped table-bordered">
  <thead class="table-dark">
   <tr>
    <th>Nr</th>
    <th>Vorname</th>
    <th>Name</th>
    <th>E-Mail</th>
    <th>Telefonnummer</th>
    <th>Datum der Eintragung</th>
    <th>Aktion</th>
   </tr>
  </thead>
  <tbody>
   <?php foreach ($rows_k as $r): ?>
    <tr>
     <td><?= htmlspecialchars($r['kunden_nr']) ?></td>
     <td><?= htmlspecialchars($r['vname']) ?></td>
     <td><?= htmlspecialchars($r['name']) ?></td>
     <td><?= htmlspecialchars($r['email']) ?></td>
     <td><?= htmlspecialchars($r['tel']) ?></td>
     <td><?= htmlspecialchars($r['kunde_seit']) ?></td>
     <td class="d-flex gap-2">
      <a class="btn btn-sm btn-warning"
         href="?tab=kunde&k_edit=1&kunden_nr=<?= urlencode($r['kunden_nr']) ?>">
         Bearbeiten
      </a>
      <a class="btn btn-sm btn-danger"
         href="?tab=kunde&k_delete=1&k_delete=<?= urlencode($r['kunden_nr']) ?>"
         onclick="return confirm('Willst du diesen Kunden wirklich löschen?')">
         Löschen
      </a>
     </td>
    </tr>
   <?php endforeach; ?>
  </tbody>
 </table>

</div>
