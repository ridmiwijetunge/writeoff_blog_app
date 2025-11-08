<?php
session_start();
include 'db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']); // username or email
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, username, password FROM user WHERE username = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $user = $res->fetch_assoc();

        // ⚠️ Plain-text password comparison
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: my_account.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username or email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login — WriteOff</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
  <header class="app-header">
    <div class="header-inner">
      <div class="brand">
        <div class="logo-circle">W</div>
        <div>
          <div class="site-title">WriteOff</div>
          <div class="site-sub">Sign in</div>
        </div>
      </div>
      <div class="header-actions">
        <a href="home.php" class="btn">Home</a>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="form-card">
      <h2>Login to WriteOff</h2>
      <?php if (!empty($error)) echo "<div class='alert error'>".htmlspecialchars($error)."</div>"; ?>
      <form method="post" action="credentials.php">
        <div class="form-row">
          <label>Username or Email</label>
          <input type="text" name="login" required>
        </div>
        <div class="form-row">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>
        <div style="margin-top:14px; display:flex; gap:10px; justify-content:center;">
          <button class="btn-primary" type="submit">Login</button>
          <a class="btn-ghost" href="register.php">Register</a>
        </div>
      </form>
    </div>
  </div>

  <footer class="app-footer">
    <div class="container">
      <small>© <?= date("Y") ?> WriteOff</small>
    </div>
  </footer>
</body>
</html>
