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
    <!--CDN Bootstrap & Script -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    include("navbars\admin_navbar.php"); //Συμπερίληψη αρχείου navbar
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="container">
                <div class="col-md-12">
                    <table class="table" style="text-align: center;">
                        <thead>
                            <!-- Δημιουργία Πίνακα -->
                            <tr>
                                <th scope="col" style="color:#5d2844;"><u>ID</u></th>
                                <th scope="col" style="color:#5d2844;"><u>Username</u></th>
                                <th scope="col" style="color:#5d2844;"><u>Reservation Date</u></th>
                                <th scope="col" style="color:#5d2844;"><u>Show ID</u></th>
                                <th scope="col" style="color:#5d2844;"><u>Seat Number</u></th>
                                <th scope="col" style="color:#5d2844;"><u>Status</u></th>
                            </tr>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM reservations WHERE approved = '2' ORDER BY id ASC"; //Query ερώτημα τύπου SELECT όταν το approved=2
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
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus" data-bs-content="Ιt has been approved!">
                                        <button class="btn btn-success" type="button" disabled>Approved</button>
                                    </span>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Script για popover  -->
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })  
    </script>
    <?php
    include("footers\admin_footer.php"); //Συμπερίληψη αρχείου footer
    ?>
</body>

</html>