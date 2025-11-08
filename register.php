<?php
include 'db_connect.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT id FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $error = "Username or Email already used!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        $stmt->execute();

        $success = "Registration successful! You can now login.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register — WriteOff</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body class="register-page">

<header class="app-header">
  <div class="header-inner">
    <div class="brand">
      <div class="logo-circle">W</div>
      <div>
        <div class="site-title">WriteOff</div>
        <div class="site-sub">Register</div>
      </div>
    </div>
    <div class="header-actions">
      <a href="home.php" class="btn">Home</a>
    </div>
  </div>
</header>

<div class="container">
    <div class="form-card">
        <h2>Create an Account</h2>

        <?php if($error): ?>
            <script>alert('<?php echo $error; ?>');</script>
        <?php endif; ?>

        <?php if($success): ?>
            <script>alert('<?php echo $success; ?>'); window.location='login.php';</script>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-row">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-row">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-row">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div style="margin-top:14px; display:flex; gap:10px; justify-content:center;">
              <button class="btn-primary" type="submit">Register</button>
              <a class="btn-ghost" href="login.php">Login</a>
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
