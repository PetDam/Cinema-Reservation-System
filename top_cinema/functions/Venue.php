<?php
class Venue //Δημιουργία κλάσσης με όνομα Venue

{
        public $venue_seats = array(); //Δήλωση μεταβλητής και εκχώριση μεθόδου array()
        function show_venue($d, $s) //Αρχή μεθόδου show_venue() με ορίσματα d και s

        {
                include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
                $sql = "SELECT * from reservations where res_date = '" . $d . "' "
                        . "and prov_id =  $s "; //Query ερώτημα τύπου SELECT
                $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
                if (mysqli_num_rows($result) > 0) { //Δομή ελέγχου για να είναι ο αριθμός των γραμμών μεγαλύτερο του 0
                        while ($row = mysqli_fetch_assoc($result)) { //Δομή επανάληψης με συνθήκη τερματισμού τύπου boolean=false
                                $this->venue_seats[$row['seat']] = 2; //Εκχώρηση στην τοπική μεταβλητή (client) το περιεχόμενο των θέσεων μια αίθουσας του πίνακα $row με τιμή =2 
                        }
                        mysqli_close($conn); //Τερατισμός σύνδεσης με τη βάση δεδομένων
                }
        }
}
?>