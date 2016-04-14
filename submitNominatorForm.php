<?php
session_start();
include 'connect.php';

// checking the user
if(isset($_POST['submitNomination'])){
	
	//Getting all the values set by the professor for the nomination 
	$nominatorName = mysqli_real_escape_string($con,$_POST["nominatorName"]);
	$nominatorEmail = mysqli_real_escape_string($con,$_POST["nominatorEmail"]);
	$nomineeName = mysqli_real_escape_string($con,$_POST["nomineeName"]);
	$nomineeRank = mysqli_real_escape_string($con,$_POST["nomineeRank"]);
	$nomineePid = mysqli_real_escape_string($con,$_POST["nomineePid"]);	
	$nomineeEmail = mysqli_real_escape_string($con,$_POST["nomineeEmail"]);	
	$isNomineePhdStudent = mysqli_real_escape_string($con,$_POST["isNomineePhdStudent"]);	
	$isNomineeNewlyAdmitted = mysqli_real_escape_string($con,$_POST["isNomineeNewlyAdmitted"]);	
	$timestamp = date('y-m-d h:m:s');
	
	//Query to create the nominee data that the nominator has entered
	$createNominee = "INSERT INTO gtanominee 
		(nomineeName, nomineeRank, pid, nomineeEmail, isPHDStudent, newlyAdmitted) 
		VALUES ('$nomineeName', '$nomineeRank', '$nomineePid', '$nomineeEmail', 
			'$isNomineePhdStudent', '$isNomineeNewlyAdmitted')";
	
	//Execute the query
	$executeNomineeCreation = mysqli_query($con, $createNominee);
	
	$nominatorLogin = $_SESSION['user'];
	$sessionId = $_SESSION['sessionId'];
	
	//Update the relationship table because a nomination has just occurred
	$createNomination = "INSERT INTO nomination 
	(nominatorLogin, pid, ranking, timestamp, sessionid)
	VALUES ('$nominatorLogin', '$nomineePid', '$nomineeRank', '$timestamp', '$sessionId')";
	
	//Execute the query
	$executeNominationCreation = mysqli_query($con, $createNomination);
	
	//Update the relationship table between the session and the nominee, since a nominee was just added
	$createSessionNominee = "INSERT INTO sessionnominee
	(sessionid, gtanomineeLogin) 
	VALUES ('$sessionId', '$nomineePid')";
	
	//Execute the query
	$executeSessionNominee = mysqli_query($con, $createSessionNominee);

	//A nominee was just nominated, and an email needs to be send to notify the nominee
	
	$messagebody = urlencode ("http://127.0.0.1/newnominee.php?pid=$nomineePid");
	header("Location:sendmail.py?recipient=$nomineeEmail&body=$messagebody");
	
}
?>
