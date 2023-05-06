<?php

class Shows //Δημιουργία κλάσσης με όνομα Shows

{
    public $provoles = array(); //Δήλωση μεταβλητής και εκχώριση μεθόδου array()
    function show_films() //Αρχή μεθόδου show_fimls()

    {
        include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
        $sql = "SELECT provoles.prov_id as id,provoles.time_start as start,provoles.time_end as end,provoles.film_id,  "
            . "films.film_id, films.film_title as title, films.film_plot as plot from provoles left join films on "
            . "provoles.film_id=films.film_id order by provoles.prov_id"; //Query ερώτημα τύπου SELECT
        $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
        if (mysqli_num_rows($result) > 0) { //Δομή ελέγχου για να είναι ο αριθμός των γραμμών μεγαλύτερο του 0
            while ($row = mysqli_fetch_assoc($result)) { //Δομή επανάληψης με συνθήκη τερματισμού τύπου boolean=false
                array_push($this->provoles, $row); //Μέθοδος array_push() στην οποία περιέχει 2 ορίσματα την αρχικοποίηση των προβολών και τον τοπικό πίνακα $row 
            }
            mysqli_close($conn); //Τερατισμός σύνδεσης με τη βάση δεδομένων
        }
    }
}
?>