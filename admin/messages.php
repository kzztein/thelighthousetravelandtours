<?php
require_once 'auth.php';
require_once '../includes/db.php';
$page_title  = 'Contact Messages';
$active_page = 'messages';

$success = '';

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM contact_messages WHERE id=$id");
    $success = "Message deleted.";
}

$messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");

include 'includes/header.php';
?>

<?php if ($success): ?>
  <div class="alert alert-success rounded-3 mb-4"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<div class="row g-4">
  <?php if ($messages && $messages->num_rows > 0): ?>
    <?php while ($m = $messages->fetch_assoc()): ?>
    <div class="col-md-6">
      <div class="stat-card h-100" style="border-left: 4px solid #0072ff;">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <div>
            <div class="fw-bold"><?= htmlspecialchars($m['name']) ?></div>
            <div class="text-muted small"><?= htmlspecialchars($m['email']) ?></div>
          </div>
          <div class="d-flex align-items-center gap-2">
            <span class="text-muted small"><?= date('M d, Y', strtotime($m['created_at'])) ?></span>
            <a href="messages.php?delete=<?= $m['id'] ?>"
               class="btn btn-action btn-outline-danger"
               onclick="return confirm('Delete this message?')">
              <i class="bi bi-trash"></i>
            </a>
          </div>
        </div>
        <p class="text-muted mb-2" style="font-size:0.9rem;line-height:1.6;">
          <?= nl2br(htmlspecialchars($m['message'])) ?>
        </p>
        <a href="mailto:<?= htmlspecialchars($m['email']) ?>?subject=Re: Your inquiry to The Lighthouse"
           class="btn btn-sm btn-primary-custom">
          <i class="bi bi-reply me-1"></i> Reply via Email
        </a>
      </div>
    </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="col-12">
      <div class="stat-card text-center py-5 text-muted">
        <i class="bi bi-envelope-open fs-1 mb-3 d-block"></i>
        No messages yet.
      </div>
    </div>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
