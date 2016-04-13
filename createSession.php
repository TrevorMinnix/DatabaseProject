<?php
$con = mysqli_connect("localhost","root","", "dbproject");
if (mysqli_connect_errno())
{
echo "MySQLi Connection was not established: " . mysqli_connect_error();
}
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
	
}
?>
