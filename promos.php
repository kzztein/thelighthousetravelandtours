<?php
session_start();
require_once 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Events &amp; Promos – The Lighthouse</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body { padding-top: 100px; }
    .promo-badge {
      position: absolute; top: 15px; left: 15px;
      background: #ff4e50; color: white;
      padding: 4px 12px; border-radius: 20px;
      font-size: 0.8rem; font-weight: 600;
    }
    .promo-card { border-radius: 20px; overflow: hidden; position: relative; }
    .promo-card img { height: 220px; object-fit: cover; width: 100%; }
    .event-card { border-left: 5px solid #0072ff; border-radius: 12px; }
    .event-date { background: #0072ff; color: white; border-radius: 10px; padding: 10px 15px; text-align: center; min-width: 65px; }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg,#0072ff,#00c6ff); color:white; padding: 70px 0; text-align:center;">
  <div class="container">
    <h1 class="fw-bold display-5">Events &amp; Promos</h1>
    <p class="lead mt-2">Exclusive deals and upcoming events just for you.</p>
  </div>
</section>

<!-- Promos -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="fw-bold mb-4">🔥 Current Promotions</h2>
    <div class="row g-4">

      <div class="col-md-4">
        <div class="card promo-card shadow-lg border-0 h-100">
          <span class="promo-badge">20% OFF</span>
          <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" alt="Summer Promo">
          <div class="card-body">
            <h5 class="fw-bold">Summer Beach Promo</h5>
            <p class="text-muted">Get 20% off all beach tours this summer. Valid for bookings until July 31.</p>
            <p class="small text-danger fw-semibold"><i class="bi bi-clock"></i> Ends July 31, <?= date('Y') ?></p>
            <a href="booking.php" class="btn btn-gradient w-100">Book Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card promo-card shadow-lg border-0 h-100">
          <span class="promo-badge">FREE UPGRADE</span>
          <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5ce" alt="Holiday Special">
          <div class="card-body">
            <h5 class="fw-bold">Holiday Special</h5>
            <p class="text-muted">Book any international package and get a free hotel room upgrade included.</p>
            <p class="small text-danger fw-semibold"><i class="bi bi-clock"></i> Ends December 25, <?= date('Y') ?></p>
            <a href="booking.php" class="btn btn-gradient w-100">Book Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card promo-card shadow-lg border-0 h-100">
          <span class="promo-badge">GROUP DEAL</span>
          <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470" alt="Group Tour">
          <div class="card-body">
            <h5 class="fw-bold">Group Tour Discount</h5>
            <p class="text-muted">Bring 5 or more friends and everyone saves ₱2,000 off their booking.</p>
            <p class="small text-danger fw-semibold"><i class="bi bi-clock"></i> Limited slots available</p>
            <a href="booking.php" class="btn btn-gradient w-100">Book Now</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Upcoming Events -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-bold mb-4">📅 Upcoming Events</h2>
    <div class="row g-3">

      <div class="col-12">
        <div class="card event-card shadow-sm border-0 p-3">
          <div class="d-flex align-items-center gap-4">
            <div class="event-date">
              <div class="fw-bold fs-4">15</div>
              <div class="small">Apr</div>
            </div>
            <div>
              <h5 class="fw-bold mb-1">Boracay Island Hopping Festival</h5>
              <p class="text-muted mb-1 small"><i class="bi bi-geo-alt"></i> Boracay, Philippines &nbsp;|&nbsp; <i class="bi bi-people"></i> Limited to 30 travelers</p>
              <p class="mb-0 text-muted small">A guided island hopping experience across Boracay's hidden coves and sandbars.</p>
            </div>
            <a href="booking.php" class="btn btn-outline-primary rounded-pill ms-auto px-4">Join</a>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card event-card shadow-sm border-0 p-3">
          <div class="d-flex align-items-center gap-4">
            <div class="event-date">
              <div class="fw-bold fs-4">22</div>
              <div class="small">May</div>
            </div>
            <div>
              <h5 class="fw-bold mb-1">Mt. Pulag Sunrise Trek</h5>
              <p class="text-muted mb-1 small"><i class="bi bi-geo-alt"></i> Benguet, Philippines &nbsp;|&nbsp; <i class="bi bi-people"></i> Limited to 20 travelers</p>
              <p class="mb-0 text-muted small">Experience the famous sea of clouds at the summit of Mt. Pulag at sunrise.</p>
            </div>
            <a href="booking.php" class="btn btn-outline-primary rounded-pill ms-auto px-4">Join</a>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card event-card shadow-sm border-0 p-3">
          <div class="d-flex align-items-center gap-4">
            <div class="event-date">
              <div class="fw-bold fs-4">10</div>
              <div class="small">Jun</div>
            </div>
            <div>
              <h5 class="fw-bold mb-1">Bali Cultural Immersion Tour</h5>
              <p class="text-muted mb-1 small"><i class="bi bi-geo-alt"></i> Bali, Indonesia &nbsp;|&nbsp; <i class="bi bi-people"></i> Limited to 15 travelers</p>
              <p class="mb-0 text-muted small">Explore temples, rice terraces, and traditional Balinese cooking classes.</p>
            </div>
            <a href="booking.php" class="btn btn-outline-primary rounded-pill ms-auto px-4">Join</a>
          </div>
        </div>
      </div>

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
<style>
.btn-gradient {
  background: linear-gradient(90deg, #14f0cb, #0b8989);
  border: none; color: #fff; font-weight: 600;
}
.btn-gradient:hover { color: #fff; opacity: 0.9; }
</style>
</body>
</html>
