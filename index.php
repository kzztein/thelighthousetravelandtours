<?php
session_start();
require_once 'includes/db.php';

// Handle contact form submission
$contact_success = '';
$contact_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name    = trim($conn->real_escape_string($_POST['name'] ?? ''));
    $email   = trim($conn->real_escape_string($_POST['email'] ?? ''));
    $message = trim($conn->real_escape_string($_POST['message'] ?? ''));

    if ($name && $email && $message) {
        $sql = "INSERT INTO contact_messages (name, email, message, created_at)
                VALUES ('$name', '$email', '$message', NOW())";
        if ($conn->query($sql)) {
            $contact_success = "Thank you, $name! We'll get back to you soon.";
        } else {
            $contact_error = "Something went wrong. Please try again.";
        }
    } else {
        $contact_error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Lighthouse Travel &amp; Tours</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- Hero Section -->
<section class="hero" id="home">
  <div class="hero-content">
    <h1>Explore the World With Us</h1>
    <p>Discover beautiful destinations and unforgettable adventures.</p>
    <a href="booking.php" class="btn btn-book-now btn-lg">Book Your Tour Now</a>
  </div>
</section>

<!-- Popular Destinations Carousel -->
<section id="destinations" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold display-5">Popular Destinations</h2>
    <div id="destinationsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
      <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="row justify-content-center g-4">
            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height:450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius:20px;height:100%;">
                  <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" class="img-fluid h-100 w-100" style="object-fit:cover;" alt="Boracay">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background:linear-gradient(to top,rgba(0,0,0,0.6),transparent);border-radius:20px;">
                    <h5 class="text-white fs-4 fw-bold">Boracay</h5>
                    <p class="text-white small mb-3">White sand beaches and crystal-clear waters.</p>
                    <a href="booking.php" class="btn view-tour-btn btn-sm px-4 py-2">View Tour</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height:450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius:20px;height:100%;">
                  <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470" class="img-fluid h-100 w-100" style="object-fit:cover;" alt="Mountain Adventure">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background:linear-gradient(to top,rgba(0,0,0,0.6),transparent);border-radius:20px;">
                    <h5 class="text-white fs-4 fw-bold">Mountain Adventure</h5>
                    <p class="text-white small mb-3">Experience thrilling mountain hiking trips.</p>
                    <a href="booking.php" class="btn view-tour-btn btn-sm px-4 py-2">View Tour</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height:450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius:20px;height:100%;">
                  <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5ce" class="img-fluid h-100 w-100" style="object-fit:cover;" alt="Paris">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background:linear-gradient(to top,rgba(0,0,0,0.6),transparent);border-radius:20px;">
                    <h5 class="text-white fs-4 fw-bold">Paris</h5>
                    <p class="text-white small mb-3">Visit iconic landmarks and romantic streets.</p>
                    <a href="booking.php" class="btn view-tour-btn btn-sm px-4 py-2">View Tour</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="row justify-content-center g-4">
            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height:450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius:20px;height:100%;">
                  <img src="https://images.unsplash.com/photo-1549887530-6e74c13be85a" class="img-fluid h-100 w-100" style="object-fit:cover;" alt="Bali">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background:linear-gradient(to top,rgba(0,0,0,0.6),transparent);border-radius:20px;">
                    <h5 class="text-white fs-4 fw-bold">Bali</h5>
                    <p class="text-white small mb-3">Tropical paradise with beautiful beaches.</p>
                    <a href="booking.php" class="btn view-tour-btn btn-sm px-4 py-2">View Tour</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height:450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius:20px;height:100%;">
                  <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5" class="img-fluid h-100 w-100" style="object-fit:cover;" alt="Rome">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background:linear-gradient(to top,rgba(0,0,0,0.6),transparent);border-radius:20px;">
                    <h5 class="text-white fs-4 fw-bold">Rome</h5>
                    <p class="text-white small mb-3">Historic landmarks and rich culture.</p>
                    <a href="booking.php" class="btn view-tour-btn btn-sm px-4 py-2">View Tour</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height:450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius:20px;height:100%;">
                  <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470" class="img-fluid h-100 w-100" style="object-fit:cover;" alt="Swiss Alps">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background:linear-gradient(to top,rgba(0,0,0,0.6),transparent);border-radius:20px;">
                    <h5 class="text-white fs-4 fw-bold">Swiss Alps</h5>
                    <p class="text-white small mb-3">Snowy mountains and breathtaking views.</p>
                    <a href="booking.php" class="btn view-tour-btn btn-sm px-4 py-2">View Tour</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#destinationsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#destinationsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="bg-white text-center">
  <div class="container">
    <h2 class="mb-5 fw-bold">Why Choose Us</h2>
    <div class="row g-4">
      <div class="col-md-3">
        <i class="bi bi-cash feature-icon"></i>
        <h5 class="mt-3">Affordable Packages</h5>
        <p class="text-muted small">Best prices for every budget.</p>
      </div>
      <div class="col-md-3">
        <i class="bi bi-person-check feature-icon"></i>
        <h5 class="mt-3">Experienced Guides</h5>
        <p class="text-muted small">Local experts who know every route.</p>
      </div>
      <div class="col-md-3">
        <i class="bi bi-shield-check feature-icon"></i>
        <h5 class="mt-3">Safe Travel</h5>
        <p class="text-muted small">Your safety is our top priority.</p>
      </div>
      <div class="col-md-3">
        <i class="bi bi-headset feature-icon"></i>
        <h5 class="mt-3">24/7 Support</h5>
        <p class="text-muted small">We're here whenever you need us.</p>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold display-5">Contact Us</h2>
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="card shadow-sm border-0 p-4">
          <?php if ($contact_success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($contact_success) ?></div>
          <?php elseif ($contact_error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($contact_error) ?></div>
          <?php endif; ?>
          <form method="POST" action="index.php#contact">
            <div class="mb-3">
              <input type="text" name="name" class="form-control contact-input" placeholder="Your Name" required>
            </div>
            <div class="mb-3">
              <input type="email" name="email" class="form-control contact-input" placeholder="Your Email" required>
            </div>
            <div class="mb-3">
              <textarea name="message" class="form-control contact-input" rows="5" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" name="contact_submit" class="btn btn-contact w-100">Send Message</button>
          </form>
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
    <p class="mb-0 small">© <?= date('Y') ?> The Lighthouse Travel &amp; Tours. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
