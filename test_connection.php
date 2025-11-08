<?php
include 'db_connect.php';

if ($conn) {
    echo "<h2 style='color:green; text-align:center;'>✅ Database connection successful!</h2>";
} else {
    echo "<h2 style='color:red; text-align:center;'>❌ Database connection failed!</h2>";
}
?>
