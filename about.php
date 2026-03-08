<?php
session_start();
require_once 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us – The Lighthouse</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body { padding-top: 100px; }
    .about-hero {
      background: linear-gradient(135deg, #0072ff 0%, #00c6ff 100%);
      color: white;
      padding: 80px 0;
      text-align: center;
    }
    .team-card img {
      width: 100px; height: 100px;
      border-radius: 50%; object-fit: cover;
      border: 4px solid #00c6ff;
    }
    .stat-box { background: #f4f6f9; border-radius: 16px; padding: 30px; text-align: center; }
    .stat-box h2 { color: #0072ff; font-weight: 700; font-size: 2.5rem; }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- Hero -->
<section class="about-hero">
  <div class="container">
    <img src="logo.png" alt="Logo" style="height:80px;width:80px;object-fit:cover;border-radius:50%;border:4px solid white;" class="mb-4">
    <h1 class="fw-bold display-5">About The Lighthouse</h1>
    <p class="lead mt-3 col-md-7 mx-auto">
      We guide travelers to the world's most breathtaking destinations — safely, affordably, and unforgettably.
    </p>
  </div>
</section>

<!-- Mission & Vision -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
          <div class="mb-3"><i class="bi bi-compass fs-1 text-primary"></i></div>
          <h4 class="fw-bold">Our Mission</h4>
          <p class="text-muted">
            To make travel accessible and enjoyable for everyone. We craft personalized tour packages
            that fit every budget, every dream, and every type of traveler — from solo adventurers
            to family vacations.
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
          <div class="mb-3"><i class="bi bi-eye fs-1 text-primary"></i></div>
          <h4 class="fw-bold">Our Vision</h4>
          <p class="text-muted">
            To become the leading travel agency in the Philippines and beyond — recognized for
            our exceptional service, trusted guides, and commitment to creating memories that
            last a lifetime.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Stats -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">Our Journey So Far</h2>
    <div class="row g-4">
      <div class="col-6 col-md-3">
        <div class="stat-box">
          <h2>5,000+</h2>
          <p class="text-muted mb-0">Happy Travelers</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-box">
          <h2>30+</h2>
          <p class="text-muted mb-0">Destinations</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-box">
          <h2>8+</h2>
          <p class="text-muted mb-0">Years Experience</p>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-box">
          <h2>98%</h2>
          <p class="text-muted mb-0">Satisfaction Rate</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Why Us -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">What Makes Us Different</h2>
    <div class="row g-4">
      <div class="col-md-4 text-center">
        <i class="bi bi-cash-coin fs-1 text-primary mb-3 d-block"></i>
        <h5 class="fw-bold">Transparent Pricing</h5>
        <p class="text-muted">No hidden fees. What you see is what you pay.</p>
      </div>
      <div class="col-md-4 text-center">
        <i class="bi bi-people fs-1 text-primary mb-3 d-block"></i>
        <h5 class="fw-bold">Local Expert Guides</h5>
        <p class="text-muted">Our guides know every trail, temple, and hidden gem.</p>
      </div>
      <div class="col-md-4 text-center">
        <i class="bi bi-heart fs-1 text-primary mb-3 d-block"></i>
        <h5 class="fw-bold">Passion for Travel</h5>
        <p class="text-muted">We're travelers ourselves — so we know what matters.</p>
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
</body>
</html>
