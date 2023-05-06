<?php

class Settings //Δημιουργία κλάσσης με όνομα Settings

{
    //Ορισμός μεταβλητών
    public $name;
    public $date_now;
    public $date_limit;
    public $seats_limit;


    function read_settings() //Αρχή μεθόδου read_settings()

    {
        //Αρχίκοποιηση μεταβλητών 
        $this->name = "NO NAME";
        $date = date('Y-m-d');
        $this->date_now = $date;
        $this->date_limit = $date;
        $this->seats_limit = 10;

        include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php

        $sql = "SELECT * FROM settings"; //Query ερώτημα τύπου SELECT
        $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
        if (mysqli_num_rows($result) > 0) { //Δομή ελέγχου για να είναι ο αριθμός των γραμμών μεγαλύτερο του 0

            $row = mysqli_fetch_assoc($result); //Αποθήκευση πληροφοριών σε τοπικό πίνακα $row 
            //Εκχώρηση στις τοπικές μεταβλητές (client) το περιεχόμενο των παρακάτω θέσεων του πίνακα $row
            $this->name = $row['name'];
            $this->date_limit = $row['date_limit'];
            $this->seats_limit = $row['seats_limit'];
        }
        mysqli_close($conn); //Τερατισμός σύνδεσης με τη βάση δεδομένων
        //Εκχώρηση τοπικών μεταβλητων σε πίνακα SESSION του client
        $_SESSION['cinema_name'] = $this->name;
        $_SESSION['date_now'] = $this->date_now;
        $_SESSION['date_limit'] = $this->date_limit;
        $_SESSION['seats_limit'] = $this->seats_limit;

    }
}
?>