<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>WriteOff — Home</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="home-page">

  <header class="app-header">
    <div class="header-inner">
      <div class="brand">
        <div class="logo-circle">W</div>
        <div>
          <div class="site-title">WriteOff</div>
          <div class="site-sub">Your creative writing space</div>
        </div>
      </div>
      <!-- Removed header-actions (login/register buttons) -->
    </div>
  </header>

  <div class="container">
    <section class="hero">
      <div class="hero-left">
        <h1>Write. Share. Inspire.</h1>
        <p>Welcome to WriteOff — a simple, elegant space for your creative writing journey.</p>
        <div class="hero-cta">
          <a href="register.php" class="btn-primary">Register</a>
          <a href="login.php" class="btn-ghost">Login</a>
        </div>
      </div>
    </section>
  </div>

  <footer class="app-footer home-footer">
    <div class="container">
      <small>© <?= date("Y") ?> WriteOff • Crafted for writers</small>
    </div>
  </footer>
</body>
</html>
