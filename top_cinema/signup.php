<?php
session_start(); //Ξεκινάει session για ιστοσελίδα
include("functions\User.php"); //Συμπερίληψη αρχείου User
if (isset($_SESSION['username'])) { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα του χρήστη
  Header("Location:menu.php"); //Αν έχει setαριστεί το username, ανακατεύθυνση στο menu
}
?>

<?php
if (isset($_REQUEST['username'])) {
  $u1 = new User(); //Δημιουργία στιγμυότυπου της κλάσσης User
  $u1->username = $_REQUEST['username']; /*Δίνεται η τιμή που αποθηκεύεται στον πίνακα REQUEST['username'] στην μεταβλητή
     username του στιγμυοτύπου u1*/
  $u1->password = $_REQUEST['password']; /*Δίνεται η τιμή που αποθηκεύεται στον πίνακα REQUEST['password'] στην μεταβλητή
     password του στιγμυοτύπου u1*/
  $u1->email = $_REQUEST['email']; /*Δίνεται η τιμή που αποθηκεύεται στον πίνακα REQUEST['email'] στην μεταβλητή
     email του στιγμυοτύπου u1*/
  $u1->isadm = 0; //Δίνεται η τιμή 0 στην μεταβλητή isadm του στιγμυοτύπου u1
  $u1->signup(); /*Το στιγμυότυπο u1 καλεί τη μέθοδο signup() έχοντας στις μεταβλητές του τα δεδομένα του χρήστη
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
  <script>//Ξεκινάει JavaScript μέθοδος ελέγχου συμπλήρωσης κενών
    function checkForm() {//Όνομα καλέσματος μεθόδου
      let h = document.forms["signin"]["email"].value;//Δημιουργία Μεταβλητών
      let e = document.forms["signin"]["username"].value;
      let p = document.forms["signin"]["password"].value;
      if (h == "" || e == "" || p == "") {//Δομή ελέγχου αν οι μεταβλητές είναι κενές
        alert("Credentials must be filled!")//Εμφάνιση alert
        return false;
      }
    }
  </script>

  <!--Φόρμα εγγραφής-->
  <main class="form-signin">
    <form name="signin" method="POST" onsubmit="return checkForm()">
      <img class="mb-4" src="images/logo.png" alt="logo" width="28%" height="28%">
      <h1 class="h3 mb-3 fw-normal">Register</h1>
      <div class="form-floating">
        <input type="email" class="form-control" name="email" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" name="username" placeholder="Name">
        <label for="floatingInput">Name</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" type="submit">Submit</button>
      <br></br>
      <p>I already have an account.</p>
      <a href="index.php">Login</a>
      <hr style="color:#0c63e4; border-top: 1px;">
      <g class="mt-5 mb-3 text-muted">&copy; 2022–2023</g>
    </form>
  </main>
</body>

</html>