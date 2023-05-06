<?php
session_start(); //Ξεκινάει session για ιστοσελίδα
if (!isset($_SESSION['username'])) { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα του χρήστη
  Header("Location:index.php"); //Αν δεν έχει setαριστεί το username, ανακατεύθυνση στην index
}
?>

<!DOCTYPE html>
<!--Γλώσσα αρχέιου-->
<html lang="en">

<head>
  <title>
    <?php echo $_SESSION['cinema_name'] //Εμφάνιση του ονόματος από τον πίνακα SESSION που σετάρετε στο settings.php?>
  </title>
  <meta charset="utf-8">
  <!-- RESPONSIVE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--Favicon-->
  <link rel="icon" type="x-icon" href="images/logo.png">
  <!--CDN Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--External CSS για μορφοποίηση ιστοσελίδας-->
  <link href="css/footer.css" rel="stylesheet">
</head>

<body>
  <!-- Custom navbar -->
  <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active">
            <?php echo $_SESSION['cinema_name'] ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tainies.php">Movies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="krathseis.php">Reservations</a>
        </li>
      </ul>
      <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link" href="functions\logout.php">Logout</a>
        </li>
    </div>
  </nav>

  <!-- Carousel -->
  <div id="demo" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner" style="border-radius:30px">
      <div class="carousel-item active" data-bs-interval="7000">
        <img src="images/avatar.png" alt="avatar" class="d-block" style="width:100%">
        <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.7); border-radius: 30px;">
          <h3>Avatar: The Way of Water</h3>
          <a class="btn btn-outline-primary" href="krathseis.php" role="button">Book a seat!</a>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="7000">
        <img src="images/topgun.png" alt="topgun" class="d-block" style="width:100%">
        <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.7); border-radius: 30px;">
          <h3>Top Gun: Maverick</h3>
          <a class="btn btn-outline-primary" href="krathseis.php" role="button">Book a seat!</a>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="7000">
        <img src="images/otto.png" alt="king otto" class="d-block" style="width:100%">
        <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.7); border-radius: 30px;">
          <h3>King Otto</h3>
          <a class="btn btn-outline-primary" href="krathseis.php" role="button">Book a seat!</a>
        </div>
      </div>
    </div>


    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <?php
  include("footers\user_footer.php"); //Συμπερίληψη αρχείου footer
  ?>
  <!-- Script για carusel  -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
</body>

</html>