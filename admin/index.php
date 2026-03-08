<?php
require_once 'auth.php';
require_once '../includes/db.php';
$page_title  = 'Dashboard';
$active_page = 'dashboard';

// Counts
$total_bookings  = $conn->query("SELECT COUNT(*) as c FROM bookings")->fetch_assoc()['c'] ?? 0;
$pending_bookings= $conn->query("SELECT COUNT(*) as c FROM bookings WHERE status='pending'")->fetch_assoc()['c'] ?? 0;
$total_users     = $conn->query("SELECT COUNT(*) as c FROM users")->fetch_assoc()['c'] ?? 0;
$total_messages  = $conn->query("SELECT COUNT(*) as c FROM contact_messages")->fetch_assoc()['c'] ?? 0;
$total_tours     = $conn->query("SELECT COUNT(*) as c FROM tours")->fetch_assoc()['c'] ?? 0;
$total_promos    = $conn->query("SELECT COUNT(*) as c FROM promos")->fetch_assoc()['c'] ?? 0;

// Recent bookings
$recent_bookings = $conn->query("
    SELECT b.*, u.name as user_name, u.email
    FROM bookings b JOIN users u ON b.user_id = u.id
    ORDER BY b.created_at DESC LIMIT 5
");

// Recent messages
$recent_messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5");

include 'includes/header.php';
?>

<!-- Stat Cards -->
<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card d-flex align-items-center gap-3">
      <div class="stat-icon" style="background:#e8f0ff;color:#0072ff;"><i class="bi bi-calendar-check"></i></div>
      <div>
        <div class="text-muted small">Total Bookings</div>
        <div class="fw-bold fs-4"><?= $total_bookings ?></div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card d-flex align-items-center gap-3">
      <div class="stat-icon" style="background:#fff3cd;color:#f59e0b;"><i class="bi bi-hourglass-split"></i></div>
      <div>
        <div class="text-muted small">Pending</div>
        <div class="fw-bold fs-4"><?= $pending_bookings ?></div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card d-flex align-items-center gap-3">
      <div class="stat-icon" style="background:#d1e7dd;color:#198754;"><i class="bi bi-people"></i></div>
      <div>
        <div class="text-muted small">Registered Users</div>
        <div class="fw-bold fs-4"><?= $total_users ?></div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card d-flex align-items-center gap-3">
      <div class="stat-icon" style="background:#f8d7da;color:#dc3545;"><i class="bi bi-envelope"></i></div>
      <div>
        <div class="text-muted small">Messages</div>
        <div class="fw-bold fs-4"><?= $total_messages ?></div>
      </div>
    </div>
  </div>
</div>

<!-- Recent Bookings -->
<div class="row g-4">
  <div class="col-lg-7">
    <div class="table-card">
      <div class="d-flex align-items-center justify-content-between p-4 pb-2">
        <h6 class="fw-bold mb-0">Recent Bookings</h6>
        <a href="bookings.php" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
      </div>
      <table class="table">
        <thead><tr>
          <th>Guest</th><th>Tour</th><th>Date</th><th>Status</th>
        </tr></thead>
        <tbody>
        <?php if ($recent_bookings && $recent_bookings->num_rows > 0): ?>
          <?php while ($b = $recent_bookings->fetch_assoc()): ?>
          <tr>
            <td>
              <div class="fw-medium"><?= htmlspecialchars($b['user_name']) ?></div>
              <div class="text-muted small"><?= htmlspecialchars($b['email']) ?></div>
            </td>
            <td><?= htmlspecialchars($b['tour_name']) ?></td>
            <td><?= date('M d, Y', strtotime($b['tour_date'])) ?></td>
            <td><span class="badge-status badge-<?= $b['status'] ?>"><?= ucfirst($b['status']) ?></span></td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center text-muted py-4">No bookings yet.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Recent Messages -->
  <div class="col-lg-5">
    <div class="table-card">
      <div class="d-flex align-items-center justify-content-between p-4 pb-2">
        <h6 class="fw-bold mb-0">Recent Messages</h6>
        <a href="messages.php" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
      </div>
      <table class="table">
        <thead><tr><th>From</th><th>Preview</th></tr></thead>
        <tbody>
        <?php if ($recent_messages && $recent_messages->num_rows > 0): ?>
          <?php while ($m = $recent_messages->fetch_assoc()): ?>
          <tr>
            <td>
              <div class="fw-medium"><?= htmlspecialchars($m['name']) ?></div>
              <div class="text-muted small"><?= htmlspecialchars($m['email']) ?></div>
            </td>
            <td class="text-muted small"><?= htmlspecialchars(substr($m['message'], 0, 50)) ?>...</td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="2" class="text-center text-muted py-4">No messages yet.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
