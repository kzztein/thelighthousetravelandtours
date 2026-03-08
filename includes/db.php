<?php
// Database Configuration
// Update these values in Hostinger hPanel → Databases → MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_username');   // e.g. u123456789_lighthouse
define('DB_PASS', 'your_db_password');
define('DB_NAME', 'your_db_name');       // e.g. u123456789_lighthouse

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    // In production, log this instead of displaying it
    error_log("Database connection failed: " . $conn->connect_error);
    // Don't die — pages still work without DB (graceful degradation)
}
?>
