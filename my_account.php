<?php
session_start();
include 'db_connect.php';

// ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// --- Fetch blogs written by this user (table: blogs) ---
$myStmt = $conn->prepare("
    SELECT id, title, content, author, created_at
    FROM blogs
    WHERE author = ?
    ORDER BY created_at DESC
");
$myStmt->bind_param("s", $username);
$myStmt->execute();
$myResult = $myStmt->get_result();

// --- Fetch 5 most recent blogs NOT written by this user ---
$otherStmt = $conn->prepare("
    SELECT id, title, content, author, created_at
    FROM blogs
    WHERE author != ?
    ORDER BY created_at DESC
    LIMIT 5
");
$otherStmt->bind_param("s", $username);
$otherStmt->execute();
$otherResult = $otherStmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Account — WriteOff</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="my_blog.css">
</head>
<body>
<header class="app-header">
  <div class="header-inner">
    <div class="brand">
      <div class="logo-circle">W</div>
      <div>
        <div class="site-title">WriteOff</div>
        <div class="site-sub">Your creative writing space</div>
      </div>
    </div>

    <div class="header-actions">
      <a href="create_blog.php" class="btn">Create Blog</a>
      <a href="logout.php" class="btn">Logout</a>
    </div>
  </div>
</header>

<main class="container">
<section class="hero">
  <h1 style="text-align:center;">Welcome, <?= htmlspecialchars($username); ?>!</h1>
  <!-- Removed the "Your personalized dashboard" paragraph -->
</section>

<!-- My Blogs Preview -->
<section class="blog-list">
  <h2 style="text-align:center;">📝 My Blogs</h2>

  <?php if ($myResult && $myResult->num_rows > 0): ?>
    <?php while ($row = $myResult->fetch_assoc()): ?>
      <div class="blog-card">
        <h3>
          <a href="view_blog.php?id=<?= $row['id']; ?>" style="text-decoration:none; color:inherit;">
            <?= htmlspecialchars($row['title']); ?>
          </a>
        </h3>
        <p><?= nl2br(htmlspecialchars(mb_strimwidth($row['content'], 0, 300, '...'))); ?></p>
        <small>Author: <?= htmlspecialchars($row['author']); ?> | Created: <?= htmlspecialchars($row['created_at']); ?></small>
        <!-- Edit/Delete buttons removed for preview -->
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>You haven’t written any blogs yet. <a href="create_blog.php" class="btn-primary">Create your first</a></p>
  <?php endif; ?>
</section>

<!-- Recent Blogs from Others -->
<section class="blog-list">
  <h2 style="text-align:center;">🌍 Recent Blogs from Others</h2>

  <?php if ($otherResult && $otherResult->num_rows > 0): ?>
    <?php while ($row = $otherResult->fetch_assoc()): ?>
      <div class="blog-card">
        <h3>
          <a href="view_blog.php?id=<?= $row['id']; ?>" style="text-decoration:none; color:inherit;">
            <?= htmlspecialchars($row['title']); ?>
          </a>
        </h3>
        <p><?= nl2br(htmlspecialchars(mb_strimwidth($row['content'], 0, 200, '...'))); ?></p>
        <small>By: <?= htmlspecialchars($row['author']); ?> | <?= htmlspecialchars($row['created_at']); ?></small>
        <div style="margin-top:10px;">
          <a href="view_blog.php?id=<?= $row['id']; ?>" class="btn-primary">Read More</a>
        </div>
        <!-- Edit/Delete buttons removed -->
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No recent blogs available.</p>
  <?php endif; ?>
</section>
</main>

<footer class="app-footer">
  <div class="container">
    <small>© <?= date("Y") ?> WriteOff • Crafted for writers</small>
  </div>
</footer>
</body>
</html>
