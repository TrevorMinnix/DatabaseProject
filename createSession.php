<?php
include 'connect.php';

// checking the user
if(isset($_POST['submitNomineeForm'])){
	
	//Getting all the values set by the professor for the nomination 
	$sessionSemester = mysqli_real_escape_string($con,$_POST["sessionSemester"]);
	$sessionYear = mysqli_real_escape_string($con,$_POST["sessionYear"]);
	$nominationDeadline = mysqli_real_escape_string($con,$_POST["nominationDeadline"]);
	$nomineeResponseDeadline = mysqli_real_escape_string($con,$_POST["nomineeResponseDeadline"]);
	$nomineeVerificationDeadline = mysqli_real_escape_string($con,$_POST["nomineeVerificationDeadline"]);
	
	$timestamp = date('y-m-d h:m:s');
	
	//Need to create session in DB based on values above
	//This new seesion is also no active
}
?>
