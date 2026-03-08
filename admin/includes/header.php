<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $page_title ?? 'Admin' ?> – Lighthouse Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * { font-family: 'Poppins', sans-serif; }
    body { background: #f0f2f5; }

    /* Sidebar */
    .sidebar {
      width: 260px; min-height: 100vh;
      background: linear-gradient(180deg, #0a0f1e 0%, #0d1b3e 100%);
      position: fixed; top: 0; left: 0;
      display: flex; flex-direction: column;
      z-index: 100;
    }
    .sidebar-brand {
      padding: 28px 24px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .sidebar-brand img { height: 44px; width: 44px; border-radius: 50%; object-fit: cover; }
    .sidebar-brand .brand-name { color: white; font-weight: 700; font-size: 0.95rem; line-height: 1.2; }
    .sidebar-brand .brand-sub { color: rgba(255,255,255,0.45); font-size: 0.72rem; letter-spacing: 1px; }

    .sidebar-nav { padding: 16px 12px; flex: 1; }
    .nav-section-label {
      color: rgba(255,255,255,0.3);
      font-size: 0.65rem; font-weight: 600;
      letter-spacing: 1.5px; text-transform: uppercase;
      padding: 12px 12px 6px;
    }
    .sidebar-link {
      display: flex; align-items: center; gap: 12px;
      color: rgba(255,255,255,0.6);
      padding: 10px 14px; border-radius: 10px;
      text-decoration: none; font-size: 0.88rem; font-weight: 500;
      transition: all 0.2s; margin-bottom: 2px;
    }
    .sidebar-link i { font-size: 1.1rem; width: 20px; }
    .sidebar-link:hover { background: rgba(255,255,255,0.08); color: white; }
    .sidebar-link.active { background: linear-gradient(135deg,#0072ff,#00c6ff); color: white; }

    .sidebar-footer {
      padding: 16px 20px;
      border-top: 1px solid rgba(255,255,255,0.08);
    }
    .sidebar-footer a {
      color: rgba(255,255,255,0.5); font-size: 0.82rem;
      text-decoration: none; display: flex; align-items: center; gap: 8px;
    }
    .sidebar-footer a:hover { color: #ff4e50; }

    /* Main content */
    .main-content { margin-left: 260px; min-height: 100vh; }

    .topbar {
      background: white; padding: 16px 32px;
      display: flex; align-items: center; justify-content: space-between;
      box-shadow: 0 1px 4px rgba(0,0,0,0.06);
      position: sticky; top: 0; z-index: 50;
    }
    .topbar h5 { font-weight: 700; margin: 0; color: #111; }
    .admin-avatar {
      width: 38px; height: 38px; border-radius: 50%;
      background: linear-gradient(135deg,#0072ff,#00c6ff);
      display: flex; align-items: center; justify-content: center;
      color: white; font-weight: 700; font-size: 0.9rem;
    }
    .page-body { padding: 32px; }

    /* Cards */
    .stat-card { background: white; border-radius: 16px; padding: 24px; border: none; }
    .stat-icon {
      width: 52px; height: 52px; border-radius: 14px;
      display: flex; align-items: center; justify-content: center; font-size: 1.4rem;
    }
    .table-card { background: white; border-radius: 16px; overflow: hidden; }
    .table-card .table { margin: 0; }
    .table-card .table th { background: #f8f9fa; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #666; border: none; padding: 14px 20px; }
    .table-card .table td { padding: 14px 20px; vertical-align: middle; border-color: #f0f0f0; font-size: 0.88rem; }
    .table-card .table tr:last-child td { border: none; }

    .badge-status { padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
    .badge-pending  { background: #fff3cd; color: #856404; }
    .badge-confirmed{ background: #d1e7dd; color: #0a3622; }
    .badge-cancelled{ background: #f8d7da; color: #842029; }

    .btn-action { padding: 5px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 500; }

    /* Form styles */
    .form-label { font-weight: 500; font-size: 0.88rem; color: #444; }
    .form-control, .form-select {
      border-radius: 10px; border: 1.5px solid #e0e0e0;
      padding: 10px 14px; font-size: 0.9rem;
    }
    .form-control:focus, .form-select:focus {
      border-color: #0072ff;
      box-shadow: 0 0 0 3px rgba(0,114,255,0.1);
    }
    .btn-primary-custom {
      background: linear-gradient(135deg,#0072ff,#00c6ff);
      color: white; border: none; border-radius: 10px;
      padding: 10px 24px; font-weight: 600;
      transition: all 0.2s;
    }
    .btn-primary-custom:hover { opacity: 0.9; transform: translateY(-1px); color: white; }

    /* Image preview */
    .img-preview {
      width: 100%; height: 160px; object-fit: cover;
      border-radius: 12px; border: 2px solid #e0e0e0;
    }
    .img-preview-placeholder {
      width: 100%; height: 160px; border-radius: 12px;
      background: #f0f2f5; border: 2px dashed #ccc;
      display: flex; align-items: center; justify-content: center;
      color: #aaa; font-size: 2rem;
    }

    @media (max-width: 768px) {
      .sidebar { display: none; }
      .main-content { margin-left: 0; }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="sidebar-brand d-flex align-items-center gap-3">
    <img src="../logo.png" alt="Logo">
    <div>
      <div class="brand-name">The Lighthouse</div>
      <div class="brand-sub">ADMIN PANEL</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Overview</div>
    <a href="index.php" class="sidebar-link <?= ($active_page??'') === 'dashboard' ? 'active' : '' ?>">
      <i class="bi bi-grid-1x2"></i> Dashboard
    </a>

    <div class="nav-section-label">Manage</div>
    <a href="tours.php" class="sidebar-link <?= ($active_page??'') === 'tours' ? 'active' : '' ?>">
      <i class="bi bi-map"></i> Tour Packages
    </a>
    <a href="promos.php" class="sidebar-link <?= ($active_page??'') === 'promos' ? 'active' : '' ?>">
      <i class="bi bi-tag"></i> Events &amp; Promos
    </a>

    <div class="nav-section-label">Data</div>
    <a href="bookings.php" class="sidebar-link <?= ($active_page??'') === 'bookings' ? 'active' : '' ?>">
      <i class="bi bi-calendar-check"></i> Bookings
    </a>
    <a href="messages.php" class="sidebar-link <?= ($active_page??'') === 'messages' ? 'active' : '' ?>">
      <i class="bi bi-envelope"></i> Messages
    </a>
  </nav>

  <div class="sidebar-footer">
    <a href="../index.php" class="mb-2 d-block"><i class="bi bi-globe"></i> View Website</a>
    <a href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="topbar">
    <h5><?= $page_title ?? 'Dashboard' ?></h5>
    <div class="d-flex align-items-center gap-3">
      <span class="text-muted small">Welcome, <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></span>
      <div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)) ?></div>
    </div>
  </div>
  <div class="page-body">
