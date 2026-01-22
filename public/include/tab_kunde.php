<!-- TAB 2: -->
<div class="tab-pane fade show active" id="tab-kunde">

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

 <!-- ADMINISTRATOR HINZUFÜGEN -->
 <div class="card shadow-sm mb-4 rounded-3 border-0">
  <div class="card-header bg-primary text-white rounded-top-3 fw-semibold">
   <button class="btn btn-link text-white text-decoration-none fw-semibold p-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminFormCollapse" aria-expanded="false" aria-controls="adminFormCollapse">
    Administrator hinzufügen
   </button>
  </div>
  <div class="collapse" id="adminFormCollapse">
   <div class="card-body p-4">
    <form method="get" class="row g-3">
     <input type="hidden" name="tab" value="kunde">
     <div class="col-md-6">
      <input class="form-control" name="add_a_vname" placeholder="Vorname" required>
     </div>
     <div class="col-md-6">
      <input class="form-control" name="add_a_name" placeholder="Name" required>
     </div>
     <div class="col-md-6">
      <input class="form-control" name="add_a_email" placeholder="E-Mail" type="email" required>
     </div>
     <div class="col-md-6">
      <input class="form-control" name="add_a_tel" placeholder="Telefonnummer" required>
     </div>
     <div class="col-md-6">
      <input class="form-control" name="add_a_username" placeholder="Benutzername" required>
     </div>
     <div class="col-md-6">
      <input class="form-control" name="add_a_password" placeholder="Passwort" type="password" required>
     </div>
     <div class="col-12">
      <button class="btn btn-primary rounded-pill px-4 fw-semibold" name="add_admin">Hinzufügen</button>
     </div>
    </form>
   </div>
  </div>
 </div>


 <!-- HINZUFÜGEN -->
 <?php if (!$kunde): ?>
  <div class="card mb-3">
   <div class="card-header">Kunde hinzufügen</div>
   <div class="card-body">
    <form method="get" class="row g-3">
     <input type="hidden" name="tab" value="kunde">
     <input class="form-control" name="add_k_vname" placeholder="Vorname">
     <input class="form-control" name="add_k_name" placeholder="Name">
     <input class="form-control" name="add_k_email" placeholder="E-Mail">
     <input class="form-control" name="add_k_tel" placeholder="Telefonnummer">
     <input class="form-control" name="add_k_datum" placeholder="Datum der Eintragung" value="<?php echo date('Y-m-d'); ?>">
     <button class="btn btn-primary rounded-pill px-4 fw-semibold" name="add_kunde">Hinzufügen</button>
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
     <input type="hidden" name="tab" value="kunde">
     <input type="hidden" name="old_k_nr" value="<?= $kunde['kunden_nr'] ?>">
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

 <!-- SORTIEREN -->
<div class="card shadow-sm mb-4 rounded-3 border-0">
  <div class="card-body p-4">
   <form method="get" class="d-flex gap-3 align-items-center">
    <input type="hidden" name="tab" value="kunde">
    <select name="auswahl" class="form-select rounded-pill w-auto border-primary">
     <option value="kunden_nr">Nr</option>
     <option value="vname">Vorname</option>
     <option value="name">Name</option>
     <option value="email">E-Mail</option>
     <option value="tel">Telefonnummer</option>
    </select>
    <button class="btn btn-primary rounded-pill px-4 fw-semibold" name="abschicken">Sortieren</button>
   </form>
  </div>
 </div>

  <!-- SUCHEN -->
 <div class="card shadow-sm mb-4 rounded-3 border-0">
  <div class="card-body p-4">
   <form method="post" class="input-group mb-4 shadow-sm">
    <input class="form-control rounded-pill border-primary" name="search_kunden_nr" value="<?= htmlspecialchars($search) ?>" placeholder="Kunde suchen">
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
     <th class="py-3 px-4">Vorname</th>
     <th class="py-3 px-4">Name</th>
     <th class="py-3 px-4">E-Mail</th>
     <th class="py-3 px-4">Telefonnummer</th>
     <th class="py-3 px-4">Datum der Eintragung</th>
     <th class="py-3 px-4">Aktion</th>
    </tr>
   </thead>
   <tbody>
    <?php foreach ($rows_k as $r): ?>
     <tr class="align-middle">
      <td class="py-3 px-4"><?= htmlspecialchars($r['kunden_nr']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['vname']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['name']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['email']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['tel']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['kunde_seit']) ?></td>
      <td class="py-3 px-4">
       <div class="d-flex gap-2">
        <a class="btn btn-sm btn-warning rounded-pill px-3 fw-semibold"
           href="?tab=kunde&k_edit=1&kunden_nr=<?= urlencode($r['kunden_nr']) ?>">
           Bearbeiten
        </a>
        <a class="btn btn-sm btn-danger rounded-pill px-3 fw-semibold"
           href="?tab=kunde&k_delete=1&k_delete=<?= urlencode($r['kunden_nr']) ?>"
           onclick="return confirm('Willst du diesen Kunden wirklich löschen?')">
           Löschen
        </a>
       </div>
      </td>
     </tr>
    <?php endforeach; ?>
   </tbody>
  </table>
 </div>

</div>
