  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>Abusidiq</span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="" href="index.php">Home</a></li>
          <li><a href="">About</a></li>
          <li><a href="">Team</a></li>
          <li><a href="./contact.php">Contact Us</a></li>

          <?php if (isset($_SESSION['user_role'])): ?>
              <li><a href="admin">Admin</a></li>
          <?php else: ?>
                <li><a href="./login.php">Signin</a></li>
                <li><a href="./registration.php">Signup</a></li>
          <?php endif; ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">