<?php

class Film //Δημιουργία κλάσσης με όνομα Film

{
    //Ορισμός μεταβλητών
    public $film_id;
    public $film_title;
    public $film_plot;
    public $film_image;
    public $film_poster;

    function show_films() //Αρχή μεθόδου show_films()

    {


        include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
        $sql = "SELECT * FROM films "; //Query ερώτημα τύπου SELECT
        $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
        if (mysqli_num_rows($result) > 0) { //Δομή ελέγχου για να είναι ο αριθμός των γραμμών μεγαλύτερο του 0

            //Δημιουργία Πίνακα
            echo "<div class='" . "container" . "'>";
            echo "<h2 style='color:#0d6efd'>Films</h2>";
            echo "<table class='table table-hover'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th style='color:#0d6efd'>Id</th>";
            echo "<th style='color:#0d6efd'>Title</th>";
            echo "<th style='color:#0d6efd'>Plot</th>";
            echo "<th style='color:#0d6efd'>Poster</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) { //Δομή επανάληψης με συνθήκη τερματισμού τύπου boolean=false
                echo "<tr>";
                //Εκχώρηση στις τοπικές μεταβλητές (client) το περιεχόμενο των παρακάτω θέσεων του πίνακα $row
                $this->film_id = $row['film_id'];
                echo "<td>" . $this->film_id . "</td>";
                $this->film_title = $row['film_title'];
                echo "<td>" . $this->film_title . "</td>";
                $this->film_plot = $row['film_plot'];
                echo "<td>" . $this->film_plot . "</td>";
                $this->film_poster = $row['film_poster'];

                echo "<td>" . '<img src="data:image/png;base64,' . base64_encode($this->film_poster) . '" width =200 height=300/>' . "</td>";
                echo "</tr>";
                echo "</tbody>";
            }
            mysqli_close($conn); //Τερατισμός σύνδεσης με τη βάση δεδομένων

        }
    }

}
?>