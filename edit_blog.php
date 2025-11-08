<?php
session_start();
include 'db_connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the blog details
$result = $conn->query("SELECT * FROM blogs WHERE id = $id");
$blog = $result->fetch_assoc();

// Redirect if blog not found or user not authorized
if (!$blog || (isset($_SESSION['username']) && $_SESSION['username'] !== $blog['author'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Blog — <?= htmlspecialchars($blog['title']) ?></title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="my_blog_content.css">
<link rel="stylesheet" href="edit_blog.css">
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
</head>
<body class="edit-page">

<header class="app-header">
    <div class="header-inner">
        <div class="brand">
            <div class="logo-circle">W</div>
            <div>
                <div class="site-title">WriteOff</div>
                <div class="site-sub">Edit Your Blog</div>
            </div>
        </div>
        <div class="header-actions">
            <a href="home.php" class="btn">Home</a>
            <a href="view_blog.php?id=<?= $blog['id'] ?>" class="btn">View Blog</a>
        </div>
    </div>
</header>

<main class="container">
    <section class="edit-blog-card">
        <h2>Edit Blog</h2>
        <form action="update_blog.php" method="POST">
            <input type="hidden" name="id" value="<?= $blog['id'] ?>">

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($blog['title']) ?>" required>

            <label for="content">Content:</label>
            <textarea name="content" id="content" required><?= htmlspecialchars($blog['content']) ?></textarea>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Blog</button>
                <a href="view_blog.php?id=<?= $blog['id'] ?>" class="btn btn-red">Cancel</a>
            </div>
        </form>
    </section>
</main>

<footer class="app-footer">
    &copy; <?= date("Y") ?> WriteOff
</footer>

<script>
    // Initialize EasyMDE markdown editor
    var easyMDE = new EasyMDE({
        element: document.getElementById("content"),
        spellChecker: false,
        placeholder: "Write your blog content here...",
        autoDownloadFontAwesome: false,
        minHeight: "300px"
    });
</script>
</body>
</html>
