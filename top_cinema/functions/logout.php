<?php
session_start(); //Ξεκινάει session για ιστοσελίδα

session_destroy(); //Καταστροφή/Κλείσιμο του session για ιστοσελίδα
Header("Location:../index.php"); //Ανακατεύθυνση στην index
?>