<?php
require_once 'auth.php';
require_once '../includes/db.php';
$page_title  = 'Tour Packages';
$active_page = 'tours';

$success = '';
$error   = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $tour = $conn->query("SELECT image_path FROM tours WHERE id=$id")->fetch_assoc();
    if ($tour && $tour['image_path'] && file_exists('../' . $tour['image_path'])) {
        unlink('../' . $tour['image_path']);
    }
    $conn->query("DELETE FROM tours WHERE id=$id");
    $success = "Tour deleted successfully.";
}

// Handle Add / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id       = (int)($_POST['id'] ?? 0);
    $name     = $conn->real_escape_string(trim($_POST['name'] ?? ''));
    $country  = $conn->real_escape_string(trim($_POST['country'] ?? ''));
    $price    = (float)($_POST['price'] ?? 0);
    $description = $conn->real_escape_string(trim($_POST['description'] ?? ''));

    // Handle image upload
    $image_path = $conn->real_escape_string(trim($_POST['existing_image'] ?? ''));
    if (!empty($_FILES['image']['name'])) {
        $allowed = ['jpg','jpeg','png','webp'];
        $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $filename   = 'tour_' . time() . '_' . rand(100,999) . '.' . $ext;
            $upload_dir = '../admin/uploads/';
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $filename)) {
                // Delete old image if editing
                if ($id && !empty($_POST['existing_image'])) {
                    $old = '../' . $_POST['existing_image'];
                    if (file_exists($old)) unlink($old);
                }
                $image_path = 'admin/uploads/' . $filename;
            } else {
                $error = "Image upload failed. Check folder permissions.";
            }
        } else {
            $error = "Only JPG, PNG, or WEBP images are allowed.";
        }
    }

    if (!$error && $name && $country && $price) {
        if ($id) {
            $conn->query("UPDATE tours SET name='$name', country='$country', price=$price, description='$description', image_path='$image_path' WHERE id=$id");
            $success = "Tour updated successfully.";
        } else {
            $conn->query("INSERT INTO tours (name, country, price, description, image_path) VALUES ('$name','$country',$price,'$description','$image_path')");
            $success = "Tour added successfully.";
        }
    } elseif (!$error) {
        $error = "Please fill in all required fields.";
    }
}

// Fetch for edit
$edit_tour = null;
if (isset($_GET['edit'])) {
    $edit_id   = (int)$_GET['edit'];
    $edit_tour = $conn->query("SELECT * FROM tours WHERE id=$edit_id")->fetch_assoc();
}

// Fetch all tours
$tours = $conn->query("SELECT * FROM tours ORDER BY id DESC");

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
      <h6 class="fw-bold mb-4"><?= $edit_tour ? '✏️ Edit Tour' : '➕ Add New Tour' ?></h6>
      <form method="POST" enctype="multipart/form-data">
        <?php if ($edit_tour): ?>
          <input type="hidden" name="id" value="<?= $edit_tour['id'] ?>">
          <input type="hidden" name="existing_image" value="<?= htmlspecialchars($edit_tour['image_path']) ?>">
        <?php endif; ?>

        <div class="mb-3">
          <label class="form-label">Tour Name *</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($edit_tour['name'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Country *</label>
          <select name="country" class="form-select" required>
            <?php
            $countries = ['Philippines','Japan','France','Australia','Canada','USA','Indonesia','Italy','Switzerland'];
            foreach ($countries as $c):
              $sel = ($edit_tour['country'] ?? '') === $c ? 'selected' : '';
            ?>
              <option value="<?= $c ?>" <?= $sel ?>><?= $c ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Price (USD) *</label>
          <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" name="price" class="form-control" min="0" step="0.01"
                   value="<?= $edit_tour['price'] ?? '' ?>" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="2"><?= htmlspecialchars($edit_tour['description'] ?? '') ?></textarea>
        </div>
        <div class="mb-4">
          <label class="form-label">Tour Image</label>
          <?php if (!empty($edit_tour['image_path'])): ?>
            <img src="../<?= htmlspecialchars($edit_tour['image_path']) ?>" class="img-preview mb-2 d-block" id="imgPreview">
          <?php else: ?>
            <div class="img-preview-placeholder mb-2" id="imgPlaceholder"><i class="bi bi-image"></i></div>
            <img src="" class="img-preview mb-2 d-none" id="imgPreview">
          <?php endif; ?>
          <input type="file" name="image" class="form-control" accept="image/*" id="imageInput">
          <div class="text-muted small mt-1">JPG, PNG or WEBP. Leave blank to keep existing.</div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary-custom flex-fill">
            <?= $edit_tour ? 'Update Tour' : 'Add Tour' ?>
          </button>
          <?php if ($edit_tour): ?>
            <a href="tours.php" class="btn btn-outline-secondary">Cancel</a>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>

  <!-- Table -->
  <div class="col-lg-8">
    <div class="table-card">
      <div class="p-4 pb-2"><h6 class="fw-bold mb-0">All Tour Packages (<?= $tours ? $tours->num_rows : 0 ?>)</h6></div>
      <table class="table">
        <thead><tr>
          <th>Image</th><th>Tour</th><th>Country</th><th>Price</th><th>Actions</th>
        </tr></thead>
        <tbody>
        <?php if ($tours && $tours->num_rows > 0): ?>
          <?php while ($t = $tours->fetch_assoc()): ?>
          <tr>
            <td>
              <?php if (!empty($t['image_path'])): ?>
                <img src="../<?= htmlspecialchars($t['image_path']) ?>" style="width:60px;height:45px;object-fit:cover;border-radius:8px;">
              <?php else: ?>
                <div style="width:60px;height:45px;background:#f0f2f5;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#aaa;"><i class="bi bi-image"></i></div>
              <?php endif; ?>
            </td>
            <td>
              <div class="fw-medium"><?= htmlspecialchars($t['name']) ?></div>
              <div class="text-muted small"><?= htmlspecialchars(substr($t['description'] ?? '', 0, 40)) ?><?= strlen($t['description'] ?? '') > 40 ? '...' : '' ?></div>
            </td>
            <td><?= htmlspecialchars($t['country']) ?></td>
            <td class="fw-semibold text-primary">$<?= number_format($t['price']) ?></td>
            <td>
              <a href="tours.php?edit=<?= $t['id'] ?>" class="btn btn-action btn-outline-primary me-1">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="tours.php?delete=<?= $t['id'] ?>" class="btn btn-action btn-outline-danger"
                 onclick="return confirm('Delete this tour?')">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5" class="text-center text-muted py-4">No tours yet. Add your first one!</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<script>
// Live image preview
document.getElementById('imageInput').addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = e => {
      const preview = document.getElementById('imgPreview');
      const placeholder = document.getElementById('imgPlaceholder');
      preview.src = e.target.result;
      preview.classList.remove('d-none');
      if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(file);
  }
});
</script>

<?php include 'includes/footer.php'; ?>
