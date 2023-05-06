<?php
session_start(); //Ξεκινάει session για ιστοσελίδα
if (!isset($_SESSION['username']) && $_SESSION['isadm'] == '1') { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα του admin
     Header("Location:index.php"); //Αν δεν έχει setαριστεί το username και το isadm = 1, ανακατεύθυνση στην index
}
include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
?>
<!DOCTYPE html>
<!--Γλώσσα αρχέιου-->
<html lang="en">

<head>
     <title>Admin's Page</title>
     <meta charset="utf-8">
     <!-- RESPONSIVE -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!--Favicon-->
     <link rel="icon" type="image/x-icon" href="images/logo.png">
     <!--CDN Bootstrap-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
     <?php
     include("navbars\admin_navbar.php"); //Συμπερίληψη αρχείου navbar
     ?>
     <div class="container-fluid pt-5">
          <div class="row justify-content-center">
               <div class="col-md-10">
                    <table class="table" style="text-align: center;">
                         <thead>
                              <!-- Δημιουργία Πίνακα -->
                              <tr>
                                   <th scope="col" style="color:#5d2844;"><u>ID</u></th>
                                   <th scope="col" style="color:#5d2844;"><u>Username</u></th>
                                   <th scope="col" style="color:#5d2844;"><u>Reservation Date</u></th>
                                   <th scope="col" style="color:#5d2844;"><u>Show ID</u></th>
                                   <th scope="col" style="color:#5d2844;"><u>Seat Number</u></th>
                                   <th scope="col" style="color:#5d2844;"><u>Action</u></th>
                              </tr>
                         </thead>
               </div>
          </div>
     </div>
     <div class="container-fluid">
          <div class="row justify-content-center">
               <div class="col">
                    <?php
                    $sql = "SELECT * FROM reservations WHERE approved = 1 ORDER BY id ASC"; //Query ερώτημα τύπου SELECT όταν το approved=1
                    $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
                    while ($row = mysqli_fetch_array($result)) { //Δομή επανάληψης με συνθήκη τερματισμού τύπου boolean=false
                         ?>
                         <!-- Εμφάνιση στοιχείων στον πίνακα από το περιεχόμενο των θέσεων του πίνακα $row   -->
                         <tr>
                              <td>
                                   <?php echo $row['id']; ?>
                              </td>
                              <td>
                                   <?php echo $row['username']; ?>
                              </td>
                              <td>
                                   <?php echo $row['res_date']; ?>
                              </td>
                              <td>
                                   <?php echo $row['prov_id']; ?>
                              </td>
                              <td>
                                   <?php echo $row['seat']; ?>
                              </td>
                              <td>
                                   <form action="requests.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                        <button type="submit" class="btn"
                                             style="background-color: #329932; color: white; border-radius: 10px;"
                                             name="accept">Accept</button>
                                        <button type="submit" class="btn"
                                             style="background-color: #ff3232; color: white; border-radius: 10px;"
                                             name="delete">Delete</button>
                                   </form>
                              </td>
                         </tr>
                         <?php
                    }
                    ?>
                    </table>
               </div>
          </div>
     </div>
     <?php

     if (isset($_POST['accept'])) { //Δομή ελέγχου αν έχει setαριστεί ο πίνακας POST με accept
          $id = $_POST['id']; //Το id = με το id του πίνακα POST 
     
          $sql = "UPDATE reservations SET approved = 2 WHERE id = $id"; //Query ερώτημα τύπου UPDATE
          $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
          //Εμφάνιση alert
          echo '<script type = "text/javascript">';
          echo 'alert("This reservation has been approved!");';
          echo 'window.location.href = "requests.php"';
          echo '</script>';

     }

     if (isset($_POST['delete'])) { //Δομή ελέγχου αν έχει setαριστεί ο πίνακας POST με delete
          $id = $_POST['id']; //Το id = με το id του πίνακα POST 
     
          $sql = "DELETE FROM reservations WHERE id = $id"; //Query ερώτημα τύπου DELETE
          $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
          //Εμφάνιση alert
          echo '<script type = "text/javascript">';
          echo 'alert("This reservation has been rejected!");';
          echo 'window.location.href = "requests.php"';
          echo '</script>';
          exit();
     }
     ?>
     <?php
     include("footers\admin_footer.php"); //Συμπερίληψη αρχείου footer
     ?>
</body>

</html>