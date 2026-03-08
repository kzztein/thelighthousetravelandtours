<?php
require_once 'auth.php';
require_once '../includes/db.php';
$page_title  = 'Events & Promos';
$active_page = 'promos';

$success = '';
$error   = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM promos WHERE id=$id");
    $success = "Promo/event deleted successfully.";
}

// Handle Add / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = (int)($_POST['id'] ?? 0);
    $title       = $conn->real_escape_string(trim($_POST['title'] ?? ''));
    $type        = $conn->real_escape_string($_POST['type'] ?? 'promo');
    $description = $conn->real_escape_string(trim($_POST['description'] ?? ''));
    $badge       = $conn->real_escape_string(trim($_POST['badge'] ?? ''));
    $location    = $conn->real_escape_string(trim($_POST['location'] ?? ''));
    $event_date  = $conn->real_escape_string($_POST['event_date'] ?? '');
    $expires_at  = $conn->real_escape_string($_POST['expires_at'] ?? '');
    $image_url   = $conn->real_escape_string(trim($_POST['image_url'] ?? ''));

    if ($title && $description) {
        if ($id) {
            $conn->query("UPDATE promos SET title='$title', type='$type', description='$description',
                badge='$badge', location='$location', event_date=" . ($event_date ? "'$event_date'" : "NULL") . ",
                expires_at=" . ($expires_at ? "'$expires_at'" : "NULL") . ", image_url='$image_url'
                WHERE id=$id");
            $success = "Updated successfully.";
        } else {
            $conn->query("INSERT INTO promos (title, type, description, badge, location, event_date, expires_at, image_url)
                VALUES ('$title','$type','$description','$badge','$location',
                " . ($event_date ? "'$event_date'" : "NULL") . ",
                " . ($expires_at ? "'$expires_at'" : "NULL") . ",
                '$image_url')");
            $success = "Added successfully.";
        }
    } else {
        $error = "Title and description are required.";
    }
}

// Fetch for edit
$edit_item = null;
if (isset($_GET['edit'])) {
    $edit_id   = (int)$_GET['edit'];
    $edit_item = $conn->query("SELECT * FROM promos WHERE id=$edit_id")->fetch_assoc();
}

// Fetch all
$promos = $conn->query("SELECT * FROM promos ORDER BY type, id DESC");

include 'includes/header.php';
?>

<?php if ($success): ?>
  <div class="alert alert-success rounded-3 mb-4"><?= htmlspecialchars($success) ?></div>
<?php elseif ($error): ?>
  <div class="alert alert-danger rounded-3 mb-4"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="row g-4">

  <!-- Form -->
  <div class="col-lg-4">
    <div class="stat-card">
      <h6 class="fw-bold mb-4"><?= $edit_item ? '✏️ Edit Item' : '➕ Add Event / Promo' ?></h6>
      <form method="POST">
        <?php if ($edit_item): ?>
          <input type="hidden" name="id" value="<?= $edit_item['id'] ?>">
        <?php endif; ?>

        <div class="mb-3">
          <label class="form-label">Type *</label>
          <select name="type" class="form-select" id="typeSelect" onchange="toggleFields()">
            <option value="promo"  <?= ($edit_item['type'] ?? '') === 'promo'  ? 'selected' : '' ?>>🏷️ Promo</option>
            <option value="event"  <?= ($edit_item['type'] ?? '') === 'event'  ? 'selected' : '' ?>>📅 Event</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Title *</label>
          <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($edit_item['title'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Description *</label>
          <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($edit_item['description'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Badge Label</label>
          <input type="text" name="badge" class="form-control" placeholder="e.g. 20% OFF, FREE UPGRADE"
                 value="<?= htmlspecialchars($edit_item['badge'] ?? '') ?>">
        </div>
        <div class="mb-3" id="imageUrlField">
          <label class="form-label">Image URL</label>
          <input type="url" name="image_url" class="form-control" placeholder="https://..."
                 value="<?= htmlspecialchars($edit_item['image_url'] ?? '') ?>">
        </div>
        <div class="mb-3 event-only" id="locationField">
          <label class="form-label">Location</label>
          <input type="text" name="location" class="form-control" placeholder="e.g. Boracay, Philippines"
                 value="<?= htmlspecialchars($edit_item['location'] ?? '') ?>">
        </div>
        <div class="mb-3 event-only" id="eventDateField">
          <label class="form-label">Event Date</label>
          <input type="date" name="event_date" class="form-control"
                 value="<?= htmlspecialchars($edit_item['event_date'] ?? '') ?>">
        </div>
        <div class="mb-4 promo-only" id="expiresField">
          <label class="form-label">Promo Expires On</label>
          <input type="date" name="expires_at" class="form-control"
                 value="<?= htmlspecialchars($edit_item['expires_at'] ?? '') ?>">
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary-custom flex-fill">
            <?= $edit_item ? 'Update' : 'Add' ?>
          </button>
          <?php if ($edit_item): ?>
            <a href="promos.php" class="btn btn-outline-secondary">Cancel</a>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>

  <!-- Table -->
  <div class="col-lg-8">
    <div class="table-card">
      <div class="p-4 pb-2"><h6 class="fw-bold mb-0">All Events &amp; Promos</h6></div>
      <table class="table">
        <thead><tr>
          <th>Type</th><th>Title</th><th>Badge</th><th>Date/Expires</th><th>Actions</th>
        </tr></thead>
        <tbody>
        <?php if ($promos && $promos->num_rows > 0): ?>
          <?php while ($p = $promos->fetch_assoc()): ?>
          <tr>
            <td>
              <span class="badge-status" style="background:<?= $p['type']==='event'?'#e8f0ff':'#fff3cd' ?>;color:<?= $p['type']==='event'?'#0072ff':'#856404' ?>;">
                <?= $p['type'] === 'event' ? '📅 Event' : '🏷️ Promo' ?>
              </span>
            </td>
            <td>
              <div class="fw-medium"><?= htmlspecialchars($p['title']) ?></div>
              <div class="text-muted small"><?= htmlspecialchars(substr($p['description'], 0, 45)) ?>...</div>
            </td>
            <td><?= $p['badge'] ? '<span class="badge bg-danger">' . htmlspecialchars($p['badge']) . '</span>' : '<span class="text-muted small">—</span>' ?></td>
            <td class="small text-muted">
              <?php if ($p['type'] === 'event' && $p['event_date']): ?>
                <?= date('M d, Y', strtotime($p['event_date'])) ?>
              <?php elseif ($p['expires_at']): ?>
                Ends <?= date('M d, Y', strtotime($p['expires_at'])) ?>
              <?php else: ?>
                —
              <?php endif; ?>
            </td>
            <td>
              <a href="promos.php?edit=<?= $p['id'] ?>" class="btn btn-action btn-outline-primary me-1">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="promos.php?delete=<?= $p['id'] ?>" class="btn btn-action btn-outline-danger"
                 onclick="return confirm('Delete this item?')">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5" class="text-center text-muted py-4">No promos or events yet.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
function toggleFields() {
  const type = document.getElementById('typeSelect').value;
  document.querySelectorAll('.event-only').forEach(el => el.style.display = type === 'event' ? '' : 'none');
  document.querySelectorAll('.promo-only').forEach(el => el.style.display = type === 'promo' ? '' : 'none');
}
toggleFields(); // run on load
</script>

<?php include 'includes/footer.php'; ?>
