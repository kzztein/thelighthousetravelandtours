<?php
// ============================================================
// ADMIN ACCOUNT SETUP — Run this ONCE then DELETE this file!
// Visit: https://thelighthousetravelandtours.com/create_admin.php
// ============================================================
require_once 'includes/db.php';

$name     = 'Admin';
$username = 'lhadmin';
$password = 'LH@Admin2026!';

$hashed = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO admins (name, username, password) VALUES ('$name', '$username', '$hashed')";

if ($conn->query($sql)) {
    echo "<h2 style='font-family:sans-serif;color:green'>✅ Admin account created!</h2>";
    echo "<p style='font-family:sans-serif'>Username: <strong>$username</strong><br>Password: <strong>$password</strong></p>";
    echo "<p style='font-family:sans-serif;color:red'><strong>⚠️ DELETE this file now from Hostinger File Manager!</strong></p>";
    echo "<a href='admin/login.php' style='font-family:sans-serif'>Go to Admin Login →</a>";
} else {
    echo "<h2 style='font-family:sans-serif;color:red'>❌ Failed: " . $conn->error . "</h2>";
    echo "<p style='font-family:sans-serif'>Admin account may already exist.</p>";
}
?>
