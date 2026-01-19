<!-- SORTIEREN -->
 <div class="card shadow-sm mb-4 rounded-3 border-0">
  <div class="card-body p-4">
   <form method="post" class="d-flex gap-3 align-items-center">
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
   <form method="get" class="input-group mb-4 shadow-sm">
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
     <th class="py-3 px-4">ISBN</th>
     <th class="py-3 px-4">Titel</th>
     <th class="py-3 px-4">Autor</th>
     <th class="py-3 px-4">Verlag</th>
     <th class="py-3 px-4">Genre</th>
     <th class="py-3 px-4">Beschreibung</th>
     <th class="py-3 px-4">Status</th>
    </tr>
   </thead>
   <tbody>
    <?php foreach ($rows as $r): ?>
     <tr class="align-middle">
      <td class="py-3 px-4"><?= htmlspecialchars($r['isbn']) ?></td>
      <td class="py-3 px-4 fw-semibold"><?= htmlspecialchars($r['titel']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['autor']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['verlag']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['genre']) ?></td>
      <td class="py-3 px-4"><?= htmlspecialchars($r['beschreibung']) ?></td>
      <td class="py-3 px-4"><span class="badge bg-secondary rounded-pill px-3 py-2"><?= htmlspecialchars($r['status']) ?></span></td>
     </tr>
    <?php endforeach; ?>
   </tbody>
  </table>
 </div>
