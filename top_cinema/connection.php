<?php
//Σύνδεση στη rdmbs ΒΔ  top_cinema
// Δημιουργία σύνδεσης
$host = "localhost";
$name = "root";
$password = "";
$db = "top_cinema";
$conn = mysqli_connect($host, $name, $password, $db);
// Checkάρισμα σύνδεσης
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>