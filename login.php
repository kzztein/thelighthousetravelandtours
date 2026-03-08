<?php
session_start();
require_once 'includes/db.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    $redirect = $_GET['redirect'] ?? 'index.php';
    header("Location: $redirect");
    exit;
}

$error = '';
$success = '';
$active_tab = $_GET['tab'] ?? 'login'; // 'login' or 'signup'
$redirect = $_GET['redirect'] ?? 'index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- LOGIN ---
    if (isset($_POST['login_submit'])) {
        $email    = trim($conn->real_escape_string($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        if ($email && $password) {
            $sql    = "SELECT id, name, password FROM users WHERE email='$email' LIMIT 1";
            $result = $conn->query($sql);
            if ($result && $result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    header("Location: $redirect");
                    exit;
                } else {
                    $error = "Incorrect password.";
                }
            } else {
                $error = "No account found with that email.";
            }
        } else {
            $error = "Please fill in all fields.";
        }
        $active_tab = 'login';
    }

    // --- SIGNUP ---
    if (isset($_POST['signup_submit'])) {
        $name     = trim($conn->real_escape_string($_POST['name'] ?? ''));
        $email    = trim($conn->real_escape_string($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        if ($name && $email && $password) {
            // Check if email already exists
            $check = $conn->query("SELECT id FROM users WHERE email='$email' LIMIT 1");
            if ($check && $check->num_rows > 0) {
                $error = "An account with that email already exists.";
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (name, email, password, created_at)
                        VALUES ('$name', '$email', '$hashed', NOW())";
                if ($conn->query($sql)) {
                    $new_id = $conn->insert_id;
                    $_SESSION['user_id']   = $new_id;
                    $_SESSION['user_name'] = $name;
                    header("Location: $redirect");
                    exit;
                } else {
                    $error = "Registration failed. Please try again.";
                }
            }
        } else {
            $error = "Please fill in all fields.";
        }
        $active_tab = 'signup';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login / Sign Up – The Lighthouse</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body { background: #f4f6f9; padding-top: 100px; }
    .auth-card { max-width: 440px; margin: 60px auto; border-radius: 20px; }
    .nav-tabs .nav-link { font-weight: 600; }
    .nav-tabs .nav-link.active { color: #0072ff; border-bottom: 3px solid #0072ff; }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="container">
  <div class="card auth-card shadow-lg border-0 p-4">
    <div class="text-center mb-4">
      <img src="logo.png" alt="Logo" style="height:70px;width:70px;object-fit:cover;border-radius:50%;">
      <h4 class="mt-3 fw-bold">The Lighthouse</h4>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="authTabs">
      <li class="nav-item flex-fill text-center">
        <button class="nav-link w-100 <?= $active_tab === 'login' ? 'active' : '' ?>" data-bs-toggle="tab" data-bs-target="#loginTab">Sign In</button>
      </li>
      <li class="nav-item flex-fill text-center">
        <button class="nav-link w-100 <?= $active_tab === 'signup' ? 'active' : '' ?>" data-bs-toggle="tab" data-bs-target="#signupTab">Sign Up</button>
      </li>
    </ul>

    <div class="tab-content">

      <!-- Login Tab -->
      <div class="tab-pane fade <?= $active_tab === 'login' ? 'show active' : '' ?>" id="loginTab">
        <form method="POST" action="login.php?redirect=<?= urlencode($redirect) ?>">
          <div class="mb-3">
            <label class="form-label fw-medium">Email</label>
            <input type="email" name="email" class="form-control contact-input" placeholder="you@email.com" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-medium">Password</label>
            <input type="password" name="password" class="form-control contact-input" placeholder="••••••••" required>
          </div>
          <button type="submit" name="login_submit" class="btn btn-contact w-100 mt-2">Sign In</button>
        </form>
      </div>

      <!-- Signup Tab -->
      <div class="tab-pane fade <?= $active_tab === 'signup' ? 'show active' : '' ?>" id="signupTab">
        <form method="POST" action="login.php?tab=signup&redirect=<?= urlencode($redirect) ?>">
          <div class="mb-3">
            <label class="form-label fw-medium">Full Name</label>
            <input type="text" name="name" class="form-control contact-input" placeholder="Juan dela Cruz" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-medium">Email</label>
            <input type="email" name="email" class="form-control contact-input" placeholder="you@email.com" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-medium">Password</label>
            <input type="password" name="password" class="form-control contact-input" placeholder="Min. 8 characters" minlength="8" required>
          </div>
          <button type="submit" name="signup_submit" class="btn btn-contact w-100 mt-2">Create Account</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
