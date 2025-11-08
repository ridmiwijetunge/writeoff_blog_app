<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$delete_sql = "DELETE FROM blogs WHERE id = $id";
if ($conn->query($delete_sql)) {
    echo "<script>alert('Blog deleted successfully'); window.location.href='my_account.php';</script>";
    exit;
} else {
    echo "<script>alert('Error deleting blog'); window.location.href='my_account.php';</script>";
    exit;
}
