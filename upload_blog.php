<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');

if (!$title || !$content) {
    $_SESSION['error'] = "Title and Content cannot be empty!";
    header("Location: create_blog.php");
    exit;
}

$stmt = $conn->prepare("INSERT INTO blogs (title, content, author, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sss", $title, $content, $_SESSION['username']);

if ($stmt->execute()) {
    $_SESSION['success'] = "Blog uploaded successfully!";
    header("Location: create_blog.php");
    exit;
} else {
    $_SESSION['error'] = "Failed to upload blog. Please try again.";
    header("Location: create_blog.php");
    exit;
}
?>
