<?php
session_start(); //Ξεκινάει session για ιστοσελίδα
if (!isset($_SESSION['username'])) { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα του χρήστη
  Header("Location:index.php"); //Αν δεν έχει setαριστεί το username, ανακατεύθυνση στην index
}
include("functions\Shows.php"); //Συμπερίληψη αρχείου Shows
$username = $_SESSION['username']; //To username = με το username του πίνακα SESSION
$email = $_SESSION['email']; //To email = με το email του πίνακα SESSION
$isadm = $_SESSION['isadm']; //To isadm = με το isadm του πίνακα SESSION
$seats_limit = $_SESSION['seats_limit']; //To seats_limit = με το seats_limit του πίνακα SESSION
$what_show = new Shows(); //Το what_show = με τη κλάσση με όνομα Shows

if (isset($_GET['submit'])) { //Δομή ελέγχου αν έχει setαριστεί/πατηθεί το submit με μορφή του πίνακα GET
  $bookdate = $_GET['bookdate']; //To bookdate = με το bookdate του πίνακα GET
  $what_show = $_GET['what_show']; //To what_show = με το what_show του πίνακα GET
  $what_seat = $_GET['what_seat']; //To what_seat = με το what_seat του πίνακα GET
  if (!$what_seat) { //Δομή ελέγχου αν δεν έχει value το what_seat
    //Εμφάνισης alert
    echo '<script type = "text/javascript">';
    echo 'alert("Choose a seat!");';
    echo 'window.location.href = "krathseis.php"';
    echo '</script>';
  }
  include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
  //Query ερώτημα τύπου SELECT
  $sql = "SELECT * from reservations where "
    . "res_date = '" . $bookdate . "' "
    . "and seat =  $what_seat "
    . "and prov_id =   $what_show ";


  $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
  if (mysqli_num_rows($result) > 0) { //Δομή ελέγχου για να είναι ο αριθμός των γραμμών μεγαλύτερο του 0
    //Εμφάνισης alert
    echo '<script type = "text/javascript">';
    echo 'alert("Seat already taken!");';
    echo 'window.location.href = "menu.php"';
    echo '</script>';
    mysqli_close($conn); //Τερατισμός σύνδεσης με τη βάση δεδομένων
  } else {
    //Query ερώτημα τύπου INSERT
    $sql = "INSERT INTO reservations  (username, res_date, prov_id,seat,approved) values ('"
      . $username . "','"
      . $bookdate . "',"
      . $what_show . ","
      . $what_seat . ",1)";
    $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
    mysqli_close($conn); //Τερατισμός σύνδεσης με τη βάση δεδομένων
    if ($result) { //Αν το result είναι το boolean=true
      header("Location:menu.php"); //Aνακατεύθυνση στo menu
    }

  }
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
<!-- Internal CSS για μορφοποίηση ιστοσελίδας -->
<style>
  .csz {
    display: inline;
    padding: 47px;
  }

  .csz2 {
    display: inline;
    padding: 5.6px;
  }
</style>


<body>
  <?php
  include("navbars\user_navbar.php"); //Συμπερίληψη αρχείου navbar
  ?>

  <script>

    function show_seats(what_date, what_show) {//Αρχή μεθόδου show_seats() με ορίσματα what_date και what_show
      const xhttp = new XMLHttpRequest();//Δημιουργία νέου XMLHttpRequest αντικειμένου
      xhttp.onreadystatechange = function () {//Εκχωρήση μια συνάρτησης στο onreadystatechange
        if (this.readyState == 4 && this.status == 200) {

          //Δομή επανάληψης εμφάνισης μιας θέσης μη καταχωρημένης
          for (i = 1; i < <?php echo $_SESSION['seats_limit'] ?>; i++) {
            let sid = "seat" + i;
            document.getElementById(sid).disabled = false;
          }

          //Δομή επανάληψης εμφάνισης μιας θέσης καταχωρημένης
          json_seats = JSON.parse(this.responseText);
          for (const key in json_seats) {
            let id = "seat" + key;
            document.getElementById(id).disabled = true;
          }
        }
      }
      /*Στέλνετε αίτημα στον διακομιστή, χρησιμοποιόντας τις μεθόδους open()
       και send() του αντικειμένου XMLHttpRequest*/
      xhttp.open("GET", "available.php?d=" + what_date + "&s=" + what_show);
      xhttp.send();
    }
    <?php $d = "'" . date('Y-m-d') . "'"; ?>
    my_date = (<?php echo $d; ?>);
    my_show = 1;

  </script>
  <!--Booking System-->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-2">
        <h3 style="color:#0d6efd">Choose date </h3>
      </div>
    </div>
  </div>
  <div class="container" style="padding-left: 35px;">
    <div class="row justify-content-center">
      <div class="col-md-2">
        <form method="GET">
          <div class="input-group">
            <input type="date" id="bookdate" name="bookdate" value="<?php echo $_SESSION['date_now']; ?>"
              min="<?php echo $_SESSION['date_now']; ?>" max="<?php echo $_SESSION['date_limit']; ?>" onchange="document.getElementById('show1').checked=true;
           my_date=this.value;show_seats(this.value,my_show);">
          </div>
      </div>
    </div>
  </div>
  <hr style="color:#0d6efd">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-2">
        <h3 style="color:#0d6efd">Choose show</h3>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <?php
        $what_show->show_films();
        ?>
        <?php
        $i = 1;
        foreach ($what_show->provoles as $provoli) {
          echo "<div class='radio ' style='display:inline'>";
          $id = "'show" . $i . "'";
          echo "<label><input  id = $id onclick ='show_seats(my_date,this.value)'";
          if ($i == 1)
            echo " checked = true ";
          echo " type= 'radio' name='what_show'  value=$provoli[id]>$provoli[title]-->$provoli[start]-$provoli[end]</label>";
          echo "<div class='csz'>";
          echo "</div>";
          echo "</div>";
          $i++;
        }
        ?>
      </div>
    </div>
  </div>
  <hr style="color:#0d6efd">
  <div class="container ">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h3 class="text-center" style="color:#0d6efd">Choose seat</h3>
      </div>
    </div>
  </div>
  <div class="container ">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <?php
        for ($i = 1; $i <= $seats_limit; $i++) {
          echo "<tr>";
          echo "<td >";
          echo "<div class='radio ' style='display:inline'>";
          $id = 'seat' . $i;
          echo "<label><input  id= $id type= 'radio' name='what_seat'  value=$i>$i</label>";
          echo "</div>";
          echo "<div class='csz2'>";
          echo "</div>";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </div>
    </div>
  </div>
  <div class="container ">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form method="GET">
          <button type='submit' class='btn w-100' style="background-color:#0d6efd; color: white;" type="submit"
            name="submit" value="submit">
            Reserve seat
          </button>
        </form>
      </div>
    </div>
  </div>
  <br>
  <script>
    show_seats(my_date, my_show);//Μέθοδος show_seats με ορίσματα my_date και my_show
  </script>
  <?php
  include("footers\user_footer.php"); //Συμπερίληψη αρχείου footer
  ?>
</body>

</html>