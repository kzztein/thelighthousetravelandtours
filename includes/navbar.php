<?php
$current_page = basename($_SERVER['PHP_SELF']);
$logged_in = isset($_SESSION['user_id']);
$user_name = $logged_in ? $_SESSION['user_name'] : '';
$has_hero = ($current_page === 'index.php');
?>
<nav class="navbar navbar-expand-lg fixed-top py-2" id="mainNav" 
     style="background:<?= $has_hero ? 'transparent' : 'rgba(10,15,40,0.97)' ?> !important; transition: background 0.4s ease, box-shadow 0.4s ease; backdrop-filter: blur(10px);">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="logo.png?v=3" alt="The Lighthouse Logo" style="height:80px;width:auto;object-fit:contain;mix-blend-mode:multiply;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
            style="border-color:rgba(255,255,255,0.4);">
      <span class="navbar-toggler-icon" style="filter:invert(1);"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $current_page === 'booking.php' ? 'active' : '' ?>" href="booking.php"
             style="color:rgba(255,255,255,0.88);font-weight:500;">Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page === 'promos.php' ? 'active' : '' ?>" href="promos.php"
             style="color:rgba(255,255,255,0.88);font-weight:500;">Events &amp; Promos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page === 'about.php' ? 'active' : '' ?>" href="about.php"
             style="color:rgba(255,255,255,0.88);font-weight:500;">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#contact"
             style="color:rgba(255,255,255,0.88);font-weight:500;">Contact</a>
        </li>
      </ul>
      <div class="d-flex ms-lg-3 gap-2">
        <?php if ($logged_in): ?>
          <span class="navbar-text fw-medium me-2" style="color:white;">Hi, <?= htmlspecialchars($user_name) ?>!</span>
          <a href="logout.php" class="btn btn-outline-light rounded-pill px-4">Logout</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-outline-light rounded-pill px-4">Sign In</a>
          <a href="login.php?tab=signup" class="btn btn-light rounded-pill px-4 fw-semibold" style="color:#0072ff;">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<script>
<?php if ($has_hero): ?>
window.addEventListener('scroll', function () {
  const nav = document.getElementById('mainNav');
  if (window.scrollY > 60) {
    nav.style.background = 'rgba(10,15,40,0.97)';
    nav.style.boxShadow = '0 2px 16px rgba(0,0,0,0.25)';
  } else {
    nav.style.background = 'transparent';
    nav.style.boxShadow = 'none';
  }
});
<?php endif; ?>
</script>
