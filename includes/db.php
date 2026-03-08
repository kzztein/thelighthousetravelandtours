<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'u604181547_travel_tours');
define('DB_PASS', 'LH@Tours2026!');
define('DB_NAME', 'u604181547_light_house');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
}
?>
