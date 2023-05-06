<?php
session_start(); //Ξεκινάει session για ιστοσελίδα
include("functions\User.php"); //Συμπερίληψη αρχείου User
include("functions\Settings.php"); //Συμπερίληψη αρχείου Settings
$settings = new Settings(); //Το settings = με τη κλάσση με όνομα Settings
$settings->read_settings(); //Το settings είναι operator στη μεθόδο read_settings()

if (isset($_SESSION['username']) && $_SESSION['isadm'] == '1') { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα του admin
  Header("Location:admin_menu.php"); //Αν έχει setαριστεί το username και το isadm = 1, ανακατεύθυνση στο admin_menu
} else if (isset($_SESSION['username'])) {
  Header("Location:menu.php"); //Αλλιώς αν έχει setαριστεί το username και το isadm != 1, ανακατεύθυνση στο menu
}
?>

<?php
if (isset($_REQUEST['username'])) {
  $u1 = new User(); //Δημιουργία στιγμυότυπου της κλάσης User
  $u1->username = $_REQUEST['username']; /*Δίνεται η τιμή που αποθηκεύεται στον πίνακα REQUEST['username'] στην μεταβλητή
     username του στιγμυοτύπου u1*/
  $u1->password = $_REQUEST['password']; /*Δίνεται η τιμή που αποθηκεύεται στον πίνακα REQUEST['password'] στην μεταβλητή
     password του στιγμυοτύπου u1*/
  $u1->login(); /*Το στιγμυότυπο u1 καλεί τη μέθοδο login() έχοντας στις μεταβλητές του τα δεδομένα του χρήστη
   που συνδέεται*/
}
?>

<!DOCTYPE html>
<!--Γλώσσα αρχέιου-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"><!-- RESPONSIVE -->
  <meta name="description" content="">
  <link rel="icon" type="image/x-icon" href="images/logo.png"><!--Favicon-->
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <!--CDN Bootstrap-->
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--External CSS για μορφοποίηση ιστοσελίδας-->
  <link href="css/style.css" rel="stylesheet">
  <!--Internal CSS για μορφοποίηση ιστοσελίδας-->
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

</head>

<body class="text-center">
  <script> //Ξεκινάει JavaScript μέθοδος ελέγχου συμπλήρωσης κενών
    function checkForm() { //Όνομα καλέσματος μεθόδου
      let e = document.forms["login"]["username"].value;//Δημιουργία μεταβλητών
      let p = document.forms["login"]["password"].value;
      if (e == "" || p == "") {//Δομή ελέγχου αν οι μεταβλητές είναι κενές
        alert("Credentials must be filled!")//Εμφάνιση alert
        return false;
      }

    }  </script>
  <!--Φόρμα σύνδεσης-->
  <main class="form-signin">
    <form name="login" method="POST" onsubmit="return checkForm()">
      <img class="mb-4" src="images/logo.png" alt="logo" width="28%" height="28%">
      <h1 class="h3 mb-3 fw-normal">Login</h1>
      <div class="form-floating">
        <input type="text" class="form-control" name="username" placeholder="Name">
        <label for="floatingInput">Name</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" value="submit">Submit</button>
      <br></br>
      <p>Don't have an account?</p>
      <a href="signup.php">Register</a>
      <hr style="color:#0c63e4; border-top: 1px;">
      <g class="mt-5 mb-3 text-muted">&copy; 2022–2023</g>
    </form>
  </main>
</body>

</html>