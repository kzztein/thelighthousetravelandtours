<?php
session_start();
require_once '../includes/db.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($conn->real_escape_string($_POST['username'] ?? ''));
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $sql = "SELECT id, name, password FROM admins WHERE username='$username' LIMIT 1";
        $result = $conn->query($sql);
        if ($result && $result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_id']   = $admin['id'];
                $_SESSION['admin_name'] = $admin['name'];
                header('Location: index.php');
                exit;
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No admin account found with that username.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login – The Lighthouse</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * { font-family: 'Poppins', sans-serif; }
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #0072ff 0%, #00c6ff 100%);
      display: flex; align-items: center; justify-content: center;
    }
    .login-card {
      background: white;
      border-radius: 24px;
      padding: 48px 40px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    .admin-badge {
      background: linear-gradient(135deg, #0072ff, #00c6ff);
      color: white;
      border-radius: 50px;
      padding: 4px 16px;
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 1px;
    }
    .form-control {
      border-radius: 12px;
      padding: 12px 15px;
      border: 1px solid #ddd;
    }
    .form-control:focus {
      border-color: #0072ff;
      box-shadow: 0 0 0 3px rgba(0,114,255,0.15);
    }
    .btn-login {
      background: linear-gradient(135deg, #0072ff, #00c6ff);
      color: white; border: none;
      border-radius: 12px; padding: 12px;
      font-weight: 600; font-size: 1rem;
      transition: all 0.3s;
    }
    .btn-login:hover { opacity: 0.9; transform: translateY(-2px); color: white; }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="text-center mb-4">
      <img src="../logo.png" alt="Logo" style="height:65px;width:65px;object-fit:cover;border-radius:50%;" class="mb-3">
      <div><span class="admin-badge">ADMIN PANEL</span></div>
      <h4 class="fw-bold mt-3 mb-0">The Lighthouse</h4>
      <p class="text-muted small">Sign in to manage your website</p>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label fw-medium">Username</label>
        <div class="input-group">
          <span class="input-group-text" style="border-radius:12px 0 0 12px;"><i class="bi bi-person"></i></span>
          <input type="text" name="username" class="form-control" style="border-radius:0 12px 12px 0;" placeholder="admin" required>
        </div>
      </div>
      <div class="mb-4">
        <label class="form-label fw-medium">Password</label>
        <div class="input-group">
          <span class="input-group-text" style="border-radius:12px 0 0 12px;"><i class="bi bi-lock"></i></span>
          <input type="password" name="password" id="pw" class="form-control" style="border-radius:0 12px 12px 0;" placeholder="••••••••" required>
          <button type="button" class="btn btn-outline-secondary" style="border-radius:0 12px 12px 0;" onclick="togglePw()"><i class="bi bi-eye" id="eyeIcon"></i></button>
        </div>
      </div>
      <button type="submit" class="btn btn-login w-100">Sign In</button>
    </form>

    <div class="text-center mt-4">
      <a href="../index.php" class="text-muted small"><i class="bi bi-arrow-left me-1"></i>Back to website</a>
    </div>
  </div>

  <script>
  function togglePw() {
    const pw = document.getElementById('pw');
    const icon = document.getElementById('eyeIcon');
    if (pw.type === 'password') {
      pw.type = 'text';
      icon.className = 'bi bi-eye-slash';
    } else {
      pw.type = 'password';
      icon.className = 'bi bi-eye';
    }
  }
  </script>
</body>
</html>
