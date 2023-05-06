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
<?php
include("navbars\user_navbar.php"); //Συμπερίληψη αρχείου navbar
?>
<div class="container">
      <div class="col-md-12">
            <?php
            include("Film.php"); //Συμπερίληψη αρχείου Film
            $fil = new Film(); //Δημιουργία στιγμυότυπου της κλάσης Film
            $fil->show_films(); //Το στιγμυότυπο u1 καλεί τη μέθοδο show_films() 
            ?>
            </table>
      </div>
</div>
</div>
<!-- Δημιουργία button -->
<div class="container ">
      <div class="row justify-content-center">
            <div class="col-md-7">
                  <form method="GET">
                        <a type='submit' class="btn w-100" href="krathseis.php"
                              style="background-color:#0d6efd; color: white;" type="submit" name="submit"
                              value="submit">
                              Reserve your seat now
                        </a>
                  </form>
            </div>
      </div>
</div>
<?php
include("footers\user_footer.php"); //Συμπερίληψη αρχείου footer
?>

</body>

</html>