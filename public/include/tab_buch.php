<!-- TAB 1: -->
<div class="tab-pane fade show active" id="tab-buch">

 <!-- STATISTIK -->
 <div class="card shadow-sm mb-4 rounded-3 border-0">
  <div class="card-header bg-primary text-white rounded-top-3 fw-semibold">Statistik</div>
  <div class="card-body p-4">
   <div class="row text-center">
    <div class="col-md-6 mb-3">
     <div class="p-3 bg-light rounded-3">
      <p class="mb-1 text-muted fw-semibold fs-5">Gesamtzahl Bücher</p>
      <h2 class="text-primary mb-0 display-3 fw-bold"><?= $gesamtzahl_buecher ?></h2>
     </div>
    </div>
    <div class="col-md-6 mb-3">
     <div class="p-3 bg-light rounded-3">
      <p class="mb-1 text-muted fw-semibold fs-5">Gesamtzahl Kunden</p>
      <h2 class="text-primary mb-0 display-3 fw-bold"><?= $gesamtzahl_kunden ?></h2>
     </div>
    </div>
    <div class="col-md-6 mb-3">
     <div class="p-3 bg-light rounded-3">
      <p class="mb-1 text-muted fw-semibold fs-5">Gesamtzahl Ausleihen</p>
      <h2 class="text-primary mb-0 display-3 fw-bold"><?= $gesamtzahl_ausleihe ?></h2>
     </div>
    </div>
    <div class="col-md-6 mb-3">
     <div class="p-3 bg-light rounded-3">
      <p class="mb-1 text-muted fw-semibold fs-5">Aktive Ausleihen</p>
      <h2 class="text-primary mb-0 display-3 fw-bold"><?= $gesamtzahl_ausleihe_aktiv ?></h2>
     </div>
    </div>
   </div>
  </div>
 </div>

 <!-- HINZUFÜGEN BUCH-->
 <?php if (!$buch): ?>
  <div class="card mb-3">
   <div class="card-header">Buch hinzufügen</div>
   <div class="card-body">
    <form method="post" class="row g-3">
     <input type="hidden" name="tab" value="buch">
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
     <button class="btn btn-primary rounded-pill px-4 fw-semibold" name="add">Hinzufügen</button>
    </form>
   </div>
  </div>
 <?php endif; ?>

 <!-- BEARBEITEN -->
 <?php if ($buch): ?>
  <div class="card mt-4">
   <div class="card-header">Buch bearbeiten</div>
   <div class="card-body">
    <form method="post">
     <input type="hidden" name="tab" value="buch">
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

 <!-- SORTIEREN -->
 <div class="card shadow-sm mb-4 rounded-3 border-0">
  <div class="card-body p-4">
   <form method="post" class="d-flex gap-3 align-items-center">
    <input type="hidden" name="tab" value="buch">
    <select name="auswahl" class="form-select rounded-pill w-auto border-primary">
     <option value="buch_nr">Nr</option>
     <option value="isbn">ISBN</option>
     <option value="titel">Titel</option>
     <option value="autor">Autor</option>
     <option value="verlag">Verlag</option>
     <option value="status">Status</option>
    </select>
    <button class="btn btn-primary rounded-pill px-4 fw-semibold" name="abschicken">Sortieren</button>
   </form>
  </div>
 </div>

 <!-- SUCHEN -->
 <div class="card shadow-sm mb-4 rounded-3 border-0">
  <div class="card-body p-4">
   <form method="post" class="input-group mb-4 shadow-sm">
    <input class="form-control rounded-pill border-primary" name="search_titel" value="<?= htmlspecialchars($search) ?>" placeholder="Titel suchen">
    <button class="btn btn-outline-primary rounded-pill px-4 fw-semibold">Suchen</button>
   </form>
  </div>
 </div>


 <!-- TABELLE -->
 <div class="table-responsive">
  <table class="table table-hover table-striped border-0 shadow-sm rounded-3 overflow-hidden">
   <thead class="bg-primary text-white">
    <tr>
     <th class="py-3 px-4">Nr</th>
     <th class="py-3 px-4">ISBN</th>
     <th class="py-3 px-4">Titel</th>
     <th class="py-3 px-4">Autor</th>
     <th class="py-3 px-4">Verlag</th>
     <th class="py-3 px-4">Genre</th>
     <th class="py-3 px-4">Beschreibung</th>
     <th class="py-3 px-4">Status</th>
     <th class="py-3 px-4">Aktion</th>
    </tr>
   </thead>
   <tbody>
    <?php foreach ($rows as $r): ?>
     <tr class="align-middle">
      <td class="py-3 px-4"><?= htmlspecialchars($r['buch_nr']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['isbn']) ?></td>
      <td class="py-3 px-4 fw-semibold"><?= htmlspecialchars($r['titel']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['autor']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['verlag']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['genre']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['beschreibung']) ?></td>
      <td class="py-3 px-4"><span class="badge bg-secondary rounded-pill px-3 py-2"><?= htmlspecialchars($r['status']) ?></span></td>
      <td class="py-3 px-4">
       <div class="d-flex gap-2">
        <form method="post" style="display:inline;">
         <input type="hidden" name="tab" value="buch">
         <input type="hidden" name="edit_form" value="1">
         <input type="hidden" name="isbn" value="<?= htmlspecialchars($r['isbn']) ?>">
         <button class="btn btn-sm btn-warning rounded-pill px-3 fw-semibold" type="submit">Bearbeiten</button>
        </form>
        <form method="post" style="display:inline;" onsubmit="return confirm('Willst du dieses Buch wirklich löschen?')">
         <input type="hidden" name="tab" value="buch">
         <input type="hidden" name="delete" value="<?= htmlspecialchars($r['isbn']) ?>">
         <button class="btn btn-sm btn-danger rounded-pill px-3 fw-semibold" type="submit">Löschen</button>
        </form>
       </div>
      </td>
     </tr>
    <?php endforeach; ?>
   </tbody>
  </table>
 </div>

</div>