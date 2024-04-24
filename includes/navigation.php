<?php
// Start session to manage user authentication
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">My First PHP Site</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapse component for mobile view -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contactus.php">Contact</a>
        </li>

        <!-- Conditional rendering based on login status -->
        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- User is logged in, show Log out link -->
          <li class="nav-item">
            <a class="nav-link font-weight-bolder" href="logout.php" id="logout-link">Log out</a>
          </li>
        <?php else: ?>
          <!-- User is not logged in, show Log in and Sign up links -->
          <li class="nav-item">
            <a class="nav-link font-weight-bolder" href="login.php">Log in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-bolder" href="signup.php">Sign up</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>