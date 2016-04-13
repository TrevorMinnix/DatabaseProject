<?php
$con = mysqli_connect("localhost","root","", "dbproject");
if (mysqli_connect_errno())
{
echo "MySQLi Connection was not established: " . mysqli_connect_error();
}
// checking the user
if(isset($_POST['addFaculty'])){
	
	//Getting all the values set by the professor for the nomination 
	$facultyName = mysqli_real_escape_string($con,$_POST["facultyName"]);
	$facultyLogin = mysqli_real_escape_string($con,$_POST["facultyLogin"]);
	$facultyPass = mysqli_real_escape_string($con,$_POST["facultyPass"]);	
	$facultyEmail = mysqli_real_escape_string($con,$_POST["facultyEmail"]);	
	$facultyType = mysqli_real_escape_string($con,$_POST["facultyType"]);
	$sessionSemester = mysqli_real_escape_string($con,$_POST["sessionSemester"]);
	$sessionYear = mysqli_real_escape_string($con,$_POST["sessionYear"]);
	$sessionId = $_SESSION['sessionId'];
	
	//Admin is adding a gcchair to a session
	if($facultyType == "gcchair") {
		$queryToExecute = "INSERT INTO gcchair (gcLogin, sessionid)
			VALUES ('$facultyLogin', '$sessionId'); 
			INSERT INTO gcmember (gcName, gcEmail, gcLogin, gcPass) 
			VALUES ('$facultyName', '$facultyEmail', '$facultyLogin', '$facultyPass');
			INSERT INTO sessiongc (sessionid, gcLogin)
			VALUES('$sessionId', '$facultyLogin')";
	}
	//Admin is adding a gcmember
	else if($facultyType == "gcmember") {
		$insertInto = "gcmember";
		$queryToExecute = "INSERT INTO gcmember (gcName, gcEmail, gcLogin, gcPass) 
			VALUES ('$facultyName', '$facultyEmail', '$facultyLogin', '$facultyPass');
			INSERT INTO sessiongc (sessionid, gcLogin)
			VALUES('$sessionId', '$facultyLogin')";
	}
	//Admin is adding a professor
	else if($facultyType == "professor") {
		$insertInto = "gtanominator";
		$queryToExecute = "INSERT INTO gtanominator 
			(nominatorName, nominatorEmail, nominatorLogin, nominatorPass)
			VALUES('$facultyName', '$facultyEmail', '$facultyLogin', '$facultyPass');
			INSERT INTO sessionnominators (sessionid, gtaNominatorLogin)
			VALUES ('$sessionId', '$facultyLogin')";
	}
	
	$timestamp = date('y-m-d h:m:s');
	
	//Execute the query
	if($queryToExecute != "") {
		$executeNomineeUpdate = mysqli_query($con, $queryToExecute);	
	}
	//The system admin has just submitted the form, the form has been saved, and it should be cleared now
	
}
?>
