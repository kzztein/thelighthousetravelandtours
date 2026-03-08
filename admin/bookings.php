<?php
require_once 'auth.php';
require_once '../includes/db.php';
$page_title  = 'Bookings';
$active_page = 'bookings';

$success = '';

// Update status
if (isset($_GET['status']) && isset($_GET['id'])) {
    $id     = (int)$_GET['id'];
    $status = $conn->real_escape_string($_GET['status']);
    if (in_array($status, ['pending','confirmed','cancelled'])) {
        $conn->query("UPDATE bookings SET status='$status' WHERE id=$id");
        $success = "Booking status updated.";
    }
}

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM bookings WHERE id=$id");
    $success = "Booking deleted.";
}

// Filter
$filter = $conn->real_escape_string($_GET['filter'] ?? 'all');
$where  = $filter !== 'all' ? "WHERE b.status='$filter'" : '';

$bookings = $conn->query("
    SELECT b.*, u.name as user_name, u.email
    FROM bookings b JOIN users u ON b.user_id = u.id
    $where
    ORDER BY b.created_at DESC
");

include 'includes/header.php';
?>

<?php if ($success): ?>
  <div class="alert alert-success rounded-3 mb-4"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<!-- Filter Tabs -->
<div class="d-flex gap-2 mb-4 flex-wrap">
  <?php foreach (['all','pending','confirmed','cancelled'] as $f): ?>
    <a href="bookings.php?filter=<?= $f ?>"
       class="btn btn-sm rounded-pill <?= $filter === $f ? 'btn-primary' : 'btn-outline-secondary' ?>">
      <?= ucfirst($f) ?>
    </a>
  <?php endforeach; ?>
</div>

<div class="table-card">
  <table class="table">
    <thead><tr>
      <th>Guest</th><th>Tour</th><th>Tour Date</th><th>Guests</th><th>Booked On</th><th>Status</th><th>Actions</th>
    </tr></thead>
    <tbody>
    <?php if ($bookings && $bookings->num_rows > 0): ?>
      <?php while ($b = $bookings->fetch_assoc()): ?>
      <tr>
        <td>
          <div class="fw-medium"><?= htmlspecialchars($b['user_name']) ?></div>
          <div class="text-muted small"><?= htmlspecialchars($b['email']) ?></div>
        </td>
        <td class="fw-medium"><?= htmlspecialchars($b['tour_name']) ?></td>
        <td><?= date('M d, Y', strtotime($b['tour_date'])) ?></td>
        <td><?= $b['guests'] ?></td>
        <td class="text-muted small"><?= date('M d, Y', strtotime($b['created_at'])) ?></td>
        <td><span class="badge-status badge-<?= $b['status'] ?>"><?= ucfirst($b['status']) ?></span></td>
        <td>
          <div class="d-flex gap-1 flex-wrap">
            <?php if ($b['status'] !== 'confirmed'): ?>
              <a href="bookings.php?id=<?= $b['id'] ?>&status=confirmed&filter=<?= $filter ?>"
                 class="btn btn-action btn-outline-success" title="Confirm">
                <i class="bi bi-check-lg"></i>
              </a>
            <?php endif; ?>
            <?php if ($b['status'] !== 'cancelled'): ?>
              <a href="bookings.php?id=<?= $b['id'] ?>&status=cancelled&filter=<?= $filter ?>"
                 class="btn btn-action btn-outline-warning" title="Cancel">
                <i class="bi bi-x-lg"></i>
              </a>
            <?php endif; ?>
            <a href="bookings.php?delete=<?= $b['id'] ?>&filter=<?= $filter ?>"
               class="btn btn-action btn-outline-danger" title="Delete"
               onclick="return confirm('Delete this booking?')">
              <i class="bi bi-trash"></i>
            </a>
          </div>
        </td>
      </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7" class="text-center text-muted py-5">No bookings found.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
