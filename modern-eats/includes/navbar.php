<?php
$BASE_URL = "http://localhost/modern-eats";

if (isset($_SESSION['user_id'])) {
  
  $user = $_SESSION['username'];
}


?>

<nav class="navbar navbar-expand-lg custom-nav fs-5 " data-bs-theme="dark">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <!-- Brand on the left -->
    <a class="navbar-brand fs-3 fw-bold text-white" href="<?= $BASE_URL ?>/index.php">Modern-Eats</a>
    
    <!-- Mobile toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Nav items on the right -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= $BASE_URL ?>/index.php">Home</a>
        </li>

        <?php if (isset($user)): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reservations
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="<?= $BASE_URL ?>/reservation/booking.php">Book A Table</a></li>
              <li><a class="dropdown-item" href="<?= $BASE_URL ?>/cancelReservation.php">Cancel Reservation</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?= $BASE_URL ?>/editReservation.php">Edit Reservation</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?= $BASE_URL ?>/auth/signUp.php">Create An Account</a>
          </li>
        <?php endif; ?>

        <?php if (isset($user)): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= htmlspecialchars($user) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="/user/profile">View Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?= $BASE_URL ?>/auth/logout.php">Log Out</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="<?= $BASE_URL ?>/auth/login.php">Log in</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

