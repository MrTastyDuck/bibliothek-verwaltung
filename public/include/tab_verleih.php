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

<!-- HINZUFÜGEN AUSLEIHE-->
 <?php if (!$ausleihe): ?>
  <?php
  if (isset($_SESSION['admin_username'])) {
      $username = mysqli_real_escape_string($db, $_SESSION['admin_username']);
      $query = "SELECT bibliothekar_nr FROM t_bibliothekar WHERE benutzername = '$username'";
      $result = mysqli_query($db, $query);
      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $admin_bibnr = $row['bibliothekar_nr'];
      } else {
          $admin_bibnr = '';
      }
  } else {
      $admin_bibnr = '';
  }
  ?>
  <div class="card mb-3">
   <div class="card-header">Neue Ausleihe erstellen</div>
   <div class="card-body">
    <form method="post" class="row g-3">
     <input type="hidden" name="tab" value="verleih">
     <input class="form-control" name="add_knr" placeholder="Kunden Nr">
     <input class="form-control" name="add_bisbn" placeholder="Buch ISBN">
     <input class="form-control" name="add_bibnr" placeholder="Bibliothekar Nr " value="<?php echo htmlspecialchars($admin_bibnr); ?>">
     <input class="form-control" name="add_date" placeholder="Datum" value="<?php echo date('Y-m-d'); ?>">
     <select name="add_status" class="form-select">
      <option value="ausgeliehen">Ausgeliehen</option>
      <option value="reserviert">Reserviert</option>
     </select>
     <button class="btn btn-primary rounded-pill px-4 fw-semibold" name="add_verleih">Erstellen</button>
    </form>
   </div>
  </div>
 <?php endif; ?>

 <!-- BEARBEITEN AUSLEIHE -->
 <?php if ($ausleihe): ?>
  <div class="card mt-4">
   <div class="card-header">Ausleihe bearbeiten</div>
   <div class="card-body">
    <form method="post">
    <input type="hidden" name="tab" value="verleih">
     <input type="hidden" name="v_old_nr" value="<?= $ausleihe['ausleihe_nr'] ?>">
     <input class="form-control mb-2" name="v_edit_knr" value="<?= $ausleihe['kunden_nr'] ?>">
     <input class="form-control mb-2" name="v_edit_bisbn" value="<?= $ausleihe['buch_isbn'] ?>">
     <input class="form-control mb-2" name="v_edit_bibnr" value="<?= $ausleihe['bibliothekar_nr'] ?>">
     <input class="form-control mb-2" name="v_edit_date" value="<?= $ausleihe['datum'] ?>">
     <input class="form-control mb-2" name="v_edit_status" value="<?= $ausleihe['status'] ?>">
     <button class="btn btn-primary" name="v_edit_form">Speichern</button>
    </form>
   </div>
  </div>
 <?php endif; ?>

 <!-- SUCHEN -->
 <div class="card shadow-sm mb-4 rounded-3 border-0">
  <div class="card-body p-4">
   <form method="post" class="input-group mb-4 shadow-sm">
    <input class="form-control rounded-pill border-primary" name="search_titel" value="<?= htmlspecialchars($search) ?>" placeholder="Nach Ausleihe per Kunde suchen">
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
     <th class="py-3 px-4">Kunde Nr</th>
     <th class="py-3 px-4">Buch ISBN</th>
     <td class="py-3 px-4">Bibliothekar Nr</td>
     <th class="py-3 px-4">Datum der Ausleihe</th>
     <th class="py-3 px-4">Status</th>
     <th class="py-3 px-4">Aktion</th>
    </tr>
   </thead>
   <tbody>
    <?php foreach ($rows_v as $r): ?>
     <tr class="align-middle">
      <td class="py-3 px-4"><?= htmlspecialchars($r['ausleihe_nr']) ?></td>
      <td class="py-3 px-4 fw-semibold"><?= htmlspecialchars($r['kunden_nr']) ?></td>
      <td class="py-3 px-4 fw-semibold"><?= htmlspecialchars($r['buch_isbn']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['bibliothekar_nr']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['datum']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['status']) ?></td>
      <td class="py-3 px-4">
       <div class="d-flex gap-2">
        <form method="post" style="display:inline;">
         <input type="hidden" name="tab" value="verleih">
         <input type="hidden" name="v_edit" value="1">
         <input type="hidden" name="ausleihe_nr" value="<?= htmlspecialchars($r['ausleihe_nr']) ?>">
         <button class="btn btn-sm btn-warning rounded-pill px-3 fw-semibold" type="submit">Bearbeiten</button>
        </form>
        <form method="post" style="display:inline;" onsubmit="return confirm('Das Buch wird wieder als verfügbar angezeigt!')">
         <input type="hidden" name="tab" value="verleih">
         <input type="hidden" name="v_return" value="<?= htmlspecialchars($r['ausleihe_nr']) ?>">
         <button class="btn btn-sm btn-danger rounded-pill px-3 fw-semibold" type="submit">Rückgabe</button>
        </form>
       </div>
      </td>
     </tr>
    <?php endforeach; ?>
   </tbody>
  </table>
 </div>