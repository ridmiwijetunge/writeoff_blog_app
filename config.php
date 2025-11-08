<?php
// Start session to handle logged-in users
session_start();

// Database credentials
$db_host = 'localhost';  // usually localhost in XAMPP
$db_name = 'blog_app';   // your database name
$db_user = 'root';       // default XAMPP MySQL user
$db_pass = '';           // default XAMPP password (blank)

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    // Set error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Helper to get current logged-in user
function current_user() {
    return $_SESSION['user'] ?? null;
}