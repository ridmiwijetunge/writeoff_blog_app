<?php
session_start();
include 'db_connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = $conn->query("SELECT * FROM blogs WHERE id = $id");
$blog = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($blog['title']) ?></title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="my_blog_content.css">
<link rel="stylesheet" href="recent_blogs.css"> <!-- Added to push footer down -->
<link rel="stylesheet" href="edit_blog.css"> <!-- Added for centering and blue background -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>
<body class="recent-blogs-page">

<main class="container">
<article class="single-blog">

    <h2><?= htmlspecialchars($blog['title']) ?></h2>

    <p class="meta">
        By <?= htmlspecialchars($blog['author']) ?> • <?= date("M d, Y", strtotime($blog['created_at'])) ?>
        <?php if (!empty($blog['updated_at'])): ?> • Updated <?= date("M d, Y", strtotime($blog['updated_at'])) ?> <?php endif; ?>
    </p>

    <div class="content markdown-content" data-markdown="<?= htmlspecialchars($blog['content']) ?>"></div>

    <div class="actions" style="margin-top:20px;">
        <a href="my_account.php" class="btn-blue">Back</a>
        <?php if (isset($_SESSION['username']) && $_SESSION['username'] === $blog['author']): ?>
            <a href="edit_blog.php?id=<?= $blog['id'] ?>" class="btn-blue">Edit</a>
            <a href="delete_blog.php?id=<?= $blog['id'] ?>" class="btn-red" onclick="return confirm('Delete this blog?');">Delete</a>
        <?php endif; ?>
    </div>

</article>
</main>

<footer class="app-footer">
    &copy; <?= date("Y") ?> WriteOff
</footer>

<script src="markdown_render.js"></script>
</body>
</html>
