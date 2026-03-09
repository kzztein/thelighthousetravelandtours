<?php
// Session must be started before this is included
$current_page = basename($_SERVER['PHP_SELF']);
$logged_in = isset($_SESSION['user_id']);
$user_name = $logged_in ? $_SESSION['user_name'] : '';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top py-3" style="backdrop-filter: blur(8px); box-shadow: 0 2px 8px rgba(0,0,0,0.15);" id="mainNav">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="logo.png" alt="The Lighthouse Logo" style="height:50px;width:50px;object-fit:cover;border-radius:50%;">
      <span>THE LIGHTHOUSE</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $current_page === 'booking.php' ? 'active' : '' ?>" href="booking.php">Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page === 'promos.php' ? 'active' : '' ?>" href="promos.php">Events &amp; Promos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page === 'about.php' ? 'active' : '' ?>" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#contact">Contact</a>
        </li>
      </ul>
      <div class="d-flex ms-lg-3 gap-2">
        <?php if ($logged_in): ?>
          <span class="navbar-text fw-medium me-2">Hi, <?= htmlspecialchars($user_name) ?>!</span>
          <a href="logout.php" class="btn btn-outline-danger rounded-pill px-4">Logout</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-outline-light rounded-pill px-4">Sign In</a>
          <a href="login.php?tab=signup" class="btn btn-primary rounded-pill px-4">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
