<?php
session_start();
require_once 'includes/db.php';

$booking_success = '';
$booking_error = '';

// Handle booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_submit'])) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php?redirect=booking.php');
        exit;
    }

    $user_id   = (int)$_SESSION['user_id'];
    $tour_name = $conn->real_escape_string($_POST['tour_name'] ?? '');
    $tour_date = $conn->real_escape_string($_POST['tour_date'] ?? '');
    $guests    = (int)($_POST['guests'] ?? 1);

    if ($tour_name && $tour_date) {
        $sql = "INSERT INTO bookings (user_id, tour_name, tour_date, guests, created_at)
                VALUES ($user_id, '$tour_name', '$tour_date', $guests, NOW())";
        if ($conn->query($sql)) {
            $booking_success = "Your tour has been booked! Our team will contact you soon.";
        } else {
            $booking_error = "Something went wrong. Please try again.";
        }
    } else {
        $booking_error = "Please fill in all fields.";
    }
}

$tours = [
    ['name' => 'Mountain Adventure',  'price' => 200,  'country' => 'Philippines', 'img' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470'],
    ['name' => 'Paris Tour',          'price' => 900,  'country' => 'France',       'img' => 'https://images.unsplash.com/photo-1526778548025-fa2f459cd5ce'],
    ['name' => 'Boracay Beach',       'price' => 350,  'country' => 'Philippines', 'img' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e'],
    ['name' => 'Tokyo Experience',    'price' => 800,  'country' => 'Japan',        'img' => 'https://images.unsplash.com/photo-1526778548025-fa2f459cd5ce'],
    ['name' => 'Australia Outback',   'price' => 1200, 'country' => 'Australia',    'img' => 'https://images.unsplash.com/photo-1491557345352-5929e343eb89'],
    ['name' => 'Canada Rockies',      'price' => 950,  'country' => 'Canada',       'img' => 'https://images.unsplash.com/photo-1543353071-873f17a7a088'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tour Packages – The Lighthouse</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body { padding-top: 100px; }
    .package-card { transition: transform 0.3s, box-shadow 0.3s; }
    .package-card:hover { transform: translateY(-8px); box-shadow: 0 12px 25px rgba(0,0,0,0.2); }
    .package-card img { height: 200px; object-fit: cover; border-radius: 12px 12px 0 0; }
    .btn-gradient {
      background: linear-gradient(90deg, #14f0cb, #0b8989);
      border: none; color: #fff; font-weight: 600;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-gradient:hover { transform: scale(1.05); box-shadow: 0 6px 15px rgba(0,0,0,0.2); color:#fff; }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- Filter Bar -->
<section class="py-4 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">Tour Packages</h2>
    <div class="dropdown d-inline-block">
      <button class="btn btn-outline-primary dropdown-toggle rounded-pill px-4" type="button" id="countryDropdown" data-bs-toggle="dropdown">
        <i class="bi bi-geo-alt-fill me-2"></i> Select Country
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item country-filter" href="#" data-country="All">All Countries</a></li>
        <li><a class="dropdown-item country-filter" href="#" data-country="Philippines">Philippines</a></li>
        <li><a class="dropdown-item country-filter" href="#" data-country="Japan">Japan</a></li>
        <li><a class="dropdown-item country-filter" href="#" data-country="France">France</a></li>
        <li><a class="dropdown-item country-filter" href="#" data-country="Australia">Australia</a></li>
        <li><a class="dropdown-item country-filter" href="#" data-country="Canada">Canada</a></li>
      </ul>
    </div>
  </div>
</section>

<!-- Tour Cards -->
<section class="py-5 bg-light">
  <div class="container">

    <?php if ($booking_success): ?>
      <div class="alert alert-success text-center"><?= htmlspecialchars($booking_success) ?></div>
    <?php elseif ($booking_error): ?>
      <div class="alert alert-danger text-center"><?= htmlspecialchars($booking_error) ?></div>
    <?php endif; ?>

    <div class="row g-4 justify-content-center" id="tourCards">
      <?php foreach ($tours as $tour): ?>
      <div class="col-md-4 tour-card" data-country="<?= $tour['country'] ?>">
        <div class="card package-card shadow-lg rounded-4 text-center h-100">
          <img src="<?= $tour['img'] ?>?w=600&q=80" alt="<?= htmlspecialchars($tour['name']) ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="fw-bold mb-1"><?= htmlspecialchars($tour['name']) ?></h5>
            <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> <?= $tour['country'] ?></p>
            <p class="fw-semibold text-primary mb-3">$<?= number_format($tour['price']) ?> / person</p>

            <?php if (isset($_SESSION['user_id'])): ?>
              <!-- Inline booking form for logged-in users -->
              <form method="POST" action="booking.php" class="mt-auto">
                <input type="hidden" name="tour_name" value="<?= htmlspecialchars($tour['name']) ?>">
                <input type="date" name="tour_date" class="form-control mb-2 tour-date" required min="<?= date('Y-m-d') ?>">
                <select name="guests" class="form-select mb-3">
                  <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> Guest<?= $i > 1 ? 's' : '' ?></option>
                  <?php endfor; ?>
                </select>
                <button type="submit" name="book_submit" class="btn btn-gradient w-100">Book Now</button>
              </form>
            <?php else: ?>
              <a href="login.php?redirect=booking.php" class="btn btn-gradient w-100 mt-auto">Book Now</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="text-center">
  <div class="container">
    <p class="mb-2 fw-semibold">Follow Us</p>
    <div class="d-flex justify-content-center gap-3 fs-4 mb-3">
      <a href="#"><i class="bi bi-facebook"></i></a>
      <a href="#"><i class="bi bi-instagram"></i></a>
      <a href="#"><i class="bi bi-twitter"></i></a>
    </div>
    <p class="mb-0 small">© <?= date('Y') ?> The Lighthouse Travel &amp; Tours.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Country filter
document.querySelectorAll('.country-filter').forEach(item => {
  item.addEventListener('click', function(e) {
    e.preventDefault();
    const country = this.dataset.country;
    document.getElementById('countryDropdown').innerHTML =
      `<i class="bi bi-geo-alt-fill me-2"></i>${country === 'All' ? 'Select Country' : country}`;
    document.querySelectorAll('.tour-card').forEach(card => {
      card.style.display = (country === 'All' || card.dataset.country === country) ? '' : 'none';
    });
  });
});
</script>
</body>
</html>
