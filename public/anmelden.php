<?php
require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM t_bibliothekar WHERE benutzername = '$username'";
    $result = mysqli_query($db, $query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['passwort'])) {
            session_start();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: verwaltung.php");
            exit();
        } else {
            $error = "Falsches Passwort.";
        }
    } else {
        $error = "Benutzer nicht gefunden.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Als Admin anmelden</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
 <div class="container">
  <div class="row justify-content-center">
   <div class="col-md-6 col-lg-4">
    <div class="card shadow-lg rounded-3 border-0">
     <div class="card-body p-5">
      <h2 class="text-center mb-4 text-primary fw-bold">Als Admin Anmelden</h2>
      <?php if (isset($error)): ?>
          <div class="alert alert-danger" role="alert">
              <?php echo $error; ?>
          </div>
      <?php endif; ?>
      <form method="POST" action="">
       <div class="mb-4">
        <label for="username" class="form-label fw-semibold">Benutzername</label>
        <input type="text" class="form-control form-control-lg rounded-pill" id="username" name="username" required>
       </div>
       <div class="mb-4">
        <label for="password" class="form-label fw-semibold">Passwort</label>
        <input type="password" class="form-control form-control-lg rounded-pill" id="password" name="password" required>
       </div>
       <button type="submit" class="btn btn-primary w-100 btn-lg rounded-pill fw-semibold">Anmelden</button>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>