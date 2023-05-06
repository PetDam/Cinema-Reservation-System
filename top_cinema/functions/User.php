<?php
class User //Δημιουργία κλάσσης με όνομα User

{
    //Ορισμός μεταβλητών
    public $username;
    public $password;
    public $email;
    public $isadm;
    function login()
    {

        include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
        $sql = "SELECT * FROM users where username='" . $this->username . "' and password='" . md5($this->password) . "'"; //Query ερώτημα τύπου SELECT
        $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
        if (mysqli_num_rows($result) > 0) { //Δομή ελέγχου για να είναι ο αριθμός των γραμμών μεγαλύτερο του 0

            while ($row = mysqli_fetch_assoc($result)) { //Δομή επανάληψης με συνθήκη τερματισμού τύπου boolean=false
                //Εκχώρηση στις τοπικές μεταβλητές (client) το περιεχόμενο των παρακάτω θέσεων του πίνακα $row 
                $this->username = $row['username'];
                $this->email = $row['email'];
                $this->isadm = $row['isadm'];
            }
            mysqli_close($conn); //Τερατισμός σύνδεσης με τη βάση δεδομένων
            //Εκχώρηση τοπικών μεταβλητων σε πίνακα SESSION του client
            $_SESSION['email'] = $this->email;
            $_SESSION['username'] = $this->username;
            $_SESSION['isadm'] = $this->isadm;
            if (($_SESSION['username']) && $_SESSION['isadm'] == '1') { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα
                Header("Location:admin_menu.php"); //Αν το username ταιριάζει με το isadm=1, ανακατεύθυνση στο menu του admin
            } else {
                Header("Location:menu.php"); //Αν το username δεν ταιριάζει με το isadm=1, ανακατεύθυνση στο menu του χρήστη
            }
        }
        mysqli_close($conn); //Τερατισμός σύνδεσης με τη βάση δεδομένων
    }
    function signup() //Αρχή μεθόδου signup()

    {
        include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
        $sql = "SELECT * FROM users where username='" . $this->username . "'"; //Query ερώτημα τύπου SELECT
        $result = mysqli_query($conn, $sql); //Μέθοδος με ορίσματα $conn και $sql
        if (mysqli_num_rows($result) > 0) { //Δομή ελέγχου για να είναι ο αριθμός των γραμμών μεγαλύτερο του 0
            mysqli_close($conn);
        } else {
            //Query ερώτημα τύπου INSERT στο οποίο εισάγονται οι τοπικες μεταβλητές στα πεδία της db
            $sql = "INSERT INTO users  (username,password,email,isadm) values ('"
                . $this->username . "','"
                . md5($this->password) . "','" //to md5 einai to hash password diladi den tha fainetai to pragmatiko password sthn db
                . $this->email . "','"
                . $this->isadm . "')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                mysqli_close($conn);
                $_SESSION['email'] = $this->email;
                $_SESSION['username'] = $this->username;
                $_SESSION['isadm'] = $this->isadm;
                header("Location:menu.php");
            }
            mysqli_close($conn);

        }
    }
}
?>