<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if (!isset($_GET['id'])) {
    echo "Invalid blog ID.";
    exit();
}

$id = intval($_GET['id']);
$query = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "Blog not found.";
    exit();
}

$blog = $result->fetch_assoc();
$isAuthor = ($blog['author'] === $username);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($blog['title']); ?> — WriteOff</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="my_blog_content.css">
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
      <a href="my_account.php" class="btn">Back</a>
      <a href="logout.php" class="btn">Logout</a>
    </div>
  </div>
</header>

<div class="container" style="max-width: 800px; margin: 40px auto;">
  <article class="blog-content">
    <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
    <p><strong>Author:</strong> <?php echo htmlspecialchars($blog['author']); ?></p>
    <p><strong>Created:</strong> <?php echo htmlspecialchars($blog['created_at']); ?></p>
    <?php if (!empty($blog['updated_at'])): ?>
      <p><strong>Last Updated:</strong> <?php echo htmlspecialchars($blog['updated_at']); ?></p>
    <?php endif; ?>
    <hr>
    <p style="margin-top:20px; line-height:1.7;"><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>

    <?php if ($isAuthor): ?>
      <div style="margin-top: 25px;">
        <a href="edit_blog.php?id=<?php echo $blog['id']; ?>" class="btn-primary">✏️ Edit</a>
        <a href="delete_blog.php?id=<?php echo $blog['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog?');" class="btn-danger">🗑️ Delete</a>
      </div>
    <?php endif; ?>
  </article>
</div>

<footer class="app-footer">
  <p>© <?= date("Y") ?> WriteOff • All rights reserved</p>
</footer>
</body>
</html>
