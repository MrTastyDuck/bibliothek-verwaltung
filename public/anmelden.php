<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Willkommen</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
 <div class="container my-5">
  <h2 class="text-center mb-4">Anmelden</h2>

  <div class="card mx-auto" style="max-width: 400px;">
   <div class="card-body">
    <form method="POST" action="">
     <div class="mb-3">
      <label for="username" class="form-label">Benutzername</label>
      <input type="text" class="form-control" id="username" name="username" required>
     </div>

     <div class="mb-3">
      <label for="password" class="form-label">Passwort</label>
      <input type="password" class="form-control" id="password" name="password" required>
     </div>

     <button type="submit" class="btn btn-primary w-100">Anmelden</button>
    </form>
   </div>
  </div>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>