<?php
session_start(); //Ξεκινάει session για ιστοσελίδα

if (!isset($_SESSION['username'])) { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα του admin
    Header("Location:index.php"); //Αν δεν έχει setαριστεί το username, ανακατεύθυνση στην index
}
include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
?>
<!DOCTYPE html>
<!--Γλώσσα αρχέιου-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- RESPONSIVE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <!--CDN Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<!-- Internal CSS για μορφοποίηση ιστοσελίδας -->
<style>
    h2 {
        text-align: center;
        font-size: 45px;
        background: linear-gradient(to left,
                #5d2844,
                #bea9b4);
        -webkit-background-clip: text;
        color: transparent;
    }
</style>

<body>
    <!-- Custom navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #5d2844;">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active">
                        <?php echo $_SESSION['cinema_name'] ?>
                    </a>
                </li>

            </ul>
            <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="functions\logout.php">Logout</a>
                </li>
        </div>
    </nav>
    <!--Tέλος Custom navbar -->
    <div class="container" style="padding-top: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-center pt-5">
                    <h2>Welcome
                        <?php echo $_SESSION['username'] ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!--Δημιουργία Κουμπιών-->
                <a type="submit" class="btn" href="add_day.php"
                    style="background-color: #5d2844; color: white; border-radius: 10px; width: 33%; height: 50px; padding-top: 12px; border-radius:15px;"
                    name="accept">Customize days</a>
                <a type="submit" class="btn position-relative" href="requests.php"
                    style="background-color: #5d2844; color: white; border-radius: 10px; width: 33%; height: 50px; padding-top: 12px; border-radius:15px;"
                    name="accept">Reservation Requests
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php $sql = "SELECT * FROM reservations WHERE approved = '1'";
                        $result = mysqli_query($conn, $sql);
                        $i = mysqli_num_rows($result);
                        echo $i; ?>
                        <span class="visually-hidden">unread messages</span>
                    </span></a>
                <a type="submit" class="btn" href="accept.php"
                    style="background-color: #5d2844; color: white; border-radius: 10px; width: 33%; height: 50px; padding-top: 12px; border-radius:15px;"
                    name="accept">Reserved Seats</a>
            </div>
        </div>
    </div>
    <?php
    include("footers\admin_footer.php") //Συμπερίληψη αρχείου footer
        ?>
</body>

</html>