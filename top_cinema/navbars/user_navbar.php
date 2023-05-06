<!--Δημιουργία navbar-->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active">
          <?php echo $_SESSION['cinema_name'] ?>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="menu.php">Menu</a>
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