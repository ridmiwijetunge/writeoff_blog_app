<?php
session_start();
include 'db_connect.php';

// Make sure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0; // Existing blog ID
    $title = isset($_POST['title']) ? $conn->real_escape_string($_POST['title']) : '';
    $content = isset($_POST['content']) ? $conn->real_escape_string($_POST['content']) : '';
    $author = $_SESSION['username'];

    if (!$title || !$content) {
        die("All fields are required!");
    }

    if ($id) {
        // Update existing blog
        $sql = "UPDATE blogs SET title='$title', content='$content', updated_at=NOW() WHERE id=$id";
        if ($conn->query($sql)) {
            header("Location: view_blog.php?id=$id");
            exit;
        } else {
            die("Error updating blog: " . $conn->error);
        }
    } else {
        // Insert new blog
        $sql = "INSERT INTO blogs (title, content, author, created_at) 
                VALUES ('$title', '$content', '$author', NOW())";
        if ($conn->query($sql)) {
            $new_id = $conn->insert_id; // ID of the newly created blog
            header("Location: view_blog.php?id=$new_id");
            exit;
        } else {
            die("Error creating blog: " . $conn->error);
        }
    }
} else {
    die("Invalid request!");
}
?>
