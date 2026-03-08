<?php
// Include this at the top of every admin page
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
?>
