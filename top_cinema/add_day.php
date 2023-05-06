<?php
session_start(); //Ξεκινάει session για ιστοσελίδα
if (!isset($_SESSION['username'])) { //Δομή ελέγχου για τη σύνδεση στην ιστοσελίδα του admin
	Header("Location:index.php"); //Αν δεν έχει setαριστεί το username, ανακατεύθυνση στην index
}
include("connection.php"); //Συμπερίληψη αρχείου σύνδεσης με ΒΔ connection.php
?>
<!DOCTYPE html>
<!--Γλώσσα αρχέιου-->
<html lang="en">

<head>
	<title>Admin's Page</title>
	<meta charset="utf-8">
	<!-- RESPONSIVE -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--Favicon-->
	<link rel="icon" type="image/x-icon" href="images/logo.png">
	<!--CDN Bootstrap-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<!-- Internal CSS για μορφοποίηση ιστοσελίδας -->
<style>
	h3 {
		text-align: center;
		font-size: 50px;
		background: linear-gradient(to left,
				#5d2844,
				#bea9b4);
		-webkit-background-clip: text;
		color: transparent;
	}
</style>

<body>
	<?php
	$username = $_SESSION['username']; //Username είναι ίδιo με το username του πίνακα SESSION
	$isadm = $_SESSION['isadm']; //Isadm είναι ίδιo με το isadm του πίνακα SESSION
	include("navbars\admin_navbar.php") //Συμπερίληψη αρχείου navbar
		?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<?php

				if (isset($_SESSION['status'])) { //Δομή ελέγχου αν έχει setαριστεί το status(κώδικας επαναφοράς) του πίνακα SESSION
					echo "<h5>
		<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>Notations:</strong> " . $_SESSION['status'] . "
		<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</h5>";
					unset($_SESSION['status']); //Aνsetαρε το status του πίνακα SESSION
				}
				?>
			</div>
		</div>
	</div>

	<main>
		<div class="container" style="padding: 5.5rem;">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="card body" style="border: white;">
						<h3 class="display-5" style="text-align: center; ">Change Active Days</h3>
						<form action="save_day.php" method="POST">
							<div class="d-flex justify-content-center pt-3">
								<input type="date" class="form-control" name="days"
									min="<?php echo $_SESSION['date_now']; ?>">
							</div>
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-md-2">
										<div class="d-flex justify-content-center pt-3">
											<button class="btn btn-primary" type="submit" name="save_day"
												style="background-color: #5d2844; border: #5d2844; border-radius: 15px;">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
	<!-- Script για alert -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
		integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
		integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
		crossorigin="anonymous"></script>


	<?php
	include("footers\admin_footer.php") //Συμπερίληψη αρχείου footer
		?>
</body>

</html>