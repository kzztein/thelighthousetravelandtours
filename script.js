<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Travel & Tours</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Clean Modern Navbar with Separate Buttons -->
<nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top py-3" style="backdrop-filter: blur(8px); box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
  <div class="container">
    <!-- Logo with Image -->
    <a class="navbar-brand d-flex align-items-center" href="index.html">
      <img src="logo.png" 
           alt="Logo" style="height:50px; width:50px; object-fit:cover; border-radius:50%;" class="me-2">
      THE LIGHTHOUSE
    </a>

    <!-- Hamburger for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-dark fw-medium" href="booking.html">Booking</a></li>
        <li class="nav-item"><a class="nav-link text-dark fw-medium" href="promos.html">Events & Promos</a></li>
        <li class="nav-item"><a class="nav-link text-dark fw-medium" href="about.html">About Us</a></li>
        <li class="nav-item"><a class="nav-link text-dark fw-medium" href="#contact">Contact</a></li>
      </ul>
      <!-- Separate Buttons -->
      <div class="d-flex ms-lg-3">
        <a href="login.html" class="btn btn-outline-dark me-2 rounded-pill px-4">Sign In</a>
        <a href="login.html" class="btn btn-primary rounded-pill px-4">Sign Up</a>
      </div>
    </div>
  </div>
</nav>
<!-- Hero Section -->
<section class="hero" id="home">
  <div class="hero-content">
    <h1>Explore the World With Us</h1>
    <p>Discover beautiful destinations and unforgettable adventures.</p>
    <a href="booking.html" class="btn btn-book-now btn-lg">Book Your Tour Now</a>
  </div>
</section>

<!-- Popular Destinations Carousel (3 cards visible, bigger style) -->
<section id="destinations" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold display-5">Popular Destinations</h2>

    <div id="destinationsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
      
      <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="row justify-content-center g-4">
            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height: 450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius: 20px; height: 100%;">
                  <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" class="img-fluid h-100 w-100" style="object-fit: cover;">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); border-radius: 20px;">
                    <h5 class="text-white fs-4 fw-bold">Boracay</h5>
                    <p class="text-white small mb-3">White sand beaches and crystal-clear waters.</p>
                    <button class="btn view-tour-btn btn-sm px-4 py-2" onclick="bookTour(this)">View Tour</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height: 450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius: 20px; height: 100%;">
                  <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470" class="img-fluid h-100 w-100" style="object-fit: cover;">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); border-radius: 20px;">
                    <h5 class="text-white fs-4 fw-bold">Mountain Adventure</h5>
                    <p class="text-white small mb-3">Experience thrilling mountain hiking trips.</p>
                    <button class="btn view-tour-btn btn-sm px-4 py-2" onclick="bookTour(this)">View Tour</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height: 450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius: 20px; height: 100%;">
                  <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5ce" class="img-fluid h-100 w-100" style="object-fit: cover;">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); border-radius: 20px;">
                    <h5 class="text-white fs-4 fw-bold">Paris</h5>
                    <p class="text-white small mb-3">Visit iconic landmarks and romantic streets.</p>
                    <button class="btn view-tour-btn btn-sm px-4 py-2" onclick="bookTour(this)">View Tour</button>
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
              <div class="card destination-card shadow-lg border-0" style="height: 450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius: 20px; height: 100%;">
                  <img src="https://images.unsplash.com/photo-1549887530-6e74c13be85a" class="img-fluid h-100 w-100" style="object-fit: cover;">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); border-radius: 20px;">
                    <h5 class="text-white fs-4 fw-bold">Bali</h5>
                    <p class="text-white small mb-3">Tropical paradise with beautiful beaches.</p>
                    <button class="btn view-tour-btn btn-sm px-4 py-2" onclick="bookTour(this)">View Tour</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height: 450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius: 20px; height: 100%;">
                  <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" class="img-fluid h-100 w-100" style="object-fit: cover;">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); border-radius: 20px;">
                    <h5 class="text-white fs-4 fw-bold">Rome</h5>
                    <p class="text-white small mb-3">Historic landmarks and rich culture.</p>
                    <button class="btn view-tour-btn btn-sm px-4 py-2" onclick="bookTour(this)">View Tour</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card destination-card shadow-lg border-0" style="height: 450px;">
                <div class="card-img-top position-relative overflow-hidden" style="border-radius: 20px; height: 100%;">
                  <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470" class="img-fluid h-100 w-100" style="object-fit: cover;">
                  <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); border-radius: 20px;">
                    <h5 class="text-white fs-4 fw-bold">Swiss Alps</h5>
                    <p class="text-white small mb-3">Snowy mountains and breathtaking views.</p>
                    <button class="btn view-tour-btn btn-sm px-4 py-2" onclick="bookTour(this)">View Tour</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- Carousel controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#destinationsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#destinationsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
        <span class="visually-hidden">Next</span>
      </button>

  </div>
</section>

<!-- Why Choose Us -->
<section class="bg-light text-center">
  <div class="container">
    <h2 class="mb-5">Why Choose Us</h2>
    <div class="row">
      <div class="col-md-3"><i class="bi bi-cash feature-icon"></i><h5>Affordable Packages</h5></div>
      <div class="col-md-3"><i class="bi bi-person-check feature-icon"></i><h5>Experienced Guides</h5></div>
      <div class="col-md-3"><i class="bi bi-shield-check feature-icon"></i><h5>Safe Travel</h5></div>
      <div class="col-md-3"><i class="bi bi-headset feature-icon"></i><h5>24/7 Support</h5></div>
    </div>
  </div>
</section>

<!-- Modern Contact Section -->
<section id="contact" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold display-5">Contact Us</h2>
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="card shadow-sm border-0 p-4">
          <form>
            <div class="mb-3">
              <input type="text" class="form-control contact-input" placeholder="Name" required>
            </div>
            <div class="mb-3">
              <input type="email" class="form-control contact-input" placeholder="Email" required>
            </div>
            <div class="mb-3">
              <textarea class="form-control contact-input" rows="5" placeholder="Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-contact w-100">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="text-center">
  <p>Follow Us</p>
  <i class="bi bi-facebook"></i>
  <i class="bi bi-instagram"></i>
  <i class="bi bi-twitter"></i>
  <p class="mt-3">© 2026 TravelTours</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>