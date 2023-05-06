<?php

session_start(); //Ξεκινάει session για ιστοσελίδα
if (!isset($_SESSION['username'])) { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα του admin
      Header("Location:index.php"); //Αν δεν έχει setαριστεί το username, ανακατεύθυνση στην index
}
include("functions\Venue.php"); //Συμπερίληψη αρχείου Venue.php
$username = $_SESSION['username']; //Το username είναι ίσο με το username του πίνακα SESSION
$what_show = $_GET['s']; //Το what_show = με  ορίσμα s της μεθόδου show_venue() 
$what_date = $_GET['d']; //Το what_date = με το ορίσμα d της μεθόδου show_venue() 
$what_venue = new Venue(); //Το what_venue = με τη κλάσση με όνομα Venue
$what_venue->show_venue($what_date, $what_show); //Το what_venue είναι operator στη μεθόδο show_venue() με ορίσματα $what_date και $what_show
$seats_json = json_encode($what_venue->venue_seats); //Το seats_json = με μεθόδο json_encode() με ορίσμα what_date το οποίο είναι operator στο venue_seats
echo $seats_json; //Τύπωμα 
?>