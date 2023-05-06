<!--Δημιουργία navbar-->
<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #5d2844;">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active">
                    <?php echo $_SESSION['cinema_name'] ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_menu.php">Back</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="functions\logout.php">Logout</a>
            </li>
    </div>
</nav>