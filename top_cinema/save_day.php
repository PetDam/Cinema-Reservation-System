<?php
session_start(); //Ξεκινάει session για ιστοσελίδα

include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php

if (isset($_POST['save_day'])) { //Δομή ελέγχου αν έχει setαριστεί ο πίνακας POST με value το save_day
    $day = date('Y-m-d', strtotime($_POST['days'])); /*Day = με ορίσματα της function date όπως η ημερομήνια
        να είναι της μορφής 'Y-m-d' και της μεθόδου strtotime με την ημέρα από τον πίνακα POST*/
    if ($day == '1970-01-01') { //Δομή ελέγχου
        $_SESSION['status'] = "Try again!"; //Eμφάνιση alert
        Header("Location:add_day.php"); //Aνακατεύθυνση στην add_day
    } else {
        $sql = "UPDATE settings SET date_limit='$day'"; //Query ερώτημα τύπου UPDATE
        $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
        if ($result) { //Αν το result είναι το boolean=true
            $_SESSION['status'] = "Success!"; //Eμφάνιση alert
            Header("Location:add_day.php"); //Aνακατεύθυνση στην add_day
        } else if (!$result) { //Αν το result είναι το boolean=false
            $_SESSION['status'] = "Try Again!"; //Eμφάνιση alert
            Header("Location:add_day.php"); //Aνακατεύθυνση στην add_day
        }
    }
}
?>