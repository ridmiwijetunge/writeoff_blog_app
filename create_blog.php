<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title == '' || $content == '') {
        $error = "Please fill in both title and content.";
    } else {
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, author) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $username);
        if ($stmt->execute()) {
            $success = "Blog uploaded successfully!";
        } else {
            $error = "Failed to upload blog. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="app-header">
    <div class="header-inner">
        <div class="brand">
            <div class="logo-circle">W</div>
            <div>
                <div class="site-title">WriteOff</div>
                <div class="site-sub">Create a new blog</div>
            </div>
        </div>
        <div class="header-actions">
            <a href="my_account.php" class="btn">Back</a>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>
</header>

<div class="form-container">
    <h2>Upload New Blog</h2>
    <?php if ($error != ''): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php elseif ($success != ''): ?>
        <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="title" placeholder="Blog Title" required>
        <textarea name="content" placeholder="Write your blog here..." rows="10" required></textarea>
        <button type="submit">Upload</button>
    </form>
</div>

<footer class="app-footer">
    <p>© <?= date("Y") ?> WriteOff • All rights reserved</p>
</footer>
</body>
</html>
