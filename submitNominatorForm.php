<?php
session_start();
include 'connect.php';

// checking the user
if(isset($_POST['submitNomination'])){
	
	$nominatorLogin = $_SESSION['user'];
	$sessionId = $_SESSION['sessionid'];
	
	//get nominator name and email
	$nominatorQuery = mysqli_query($con, "SELECT nominatorName, nominatorEmail FROM gtanominator WHERE nominatorLogin='{$nominatorLogin}'");
	$nominatorInfo = mysqli_fetch_array($nominatorQuery);
	$nominatorName = $nominatorInfo['nominatorName'];
	$nominatorEmail = $nominatorInfo['nominatorEmail'];
	
	//Getting all the values set by the professor for the nomination 
	/* $nominatorName = mysqli_real_escape_string($con,$_POST["nominatorName"]);
	$nominatorEmail = mysqli_real_escape_string($con,$_POST["nominatorEmail"]); */
	$nomineeName = mysqli_real_escape_string($con,$_POST["nomineeName"]);
	$nomineeRank = mysqli_real_escape_string($con,$_POST["nomineeRank"]);
	$nomineePid = mysqli_real_escape_string($con,$_POST["nomineePid"]);	
	$nomineeEmail = mysqli_real_escape_string($con,$_POST["nomineeEmail"]);	
	$isNomineePhdStudent = mysqli_real_escape_string($con,$_POST["isNomineePhdStudent"]);	
	$isNomineeNewlyAdmitted = mysqli_real_escape_string($con,$_POST["isNomineeNewlyAdmitted"]);	
	$timestamp = date('y-m-d h:m:s');
	
	//$nomineeName = $_POST['nomineePid'];
	//$nomineePid = '963852741';
	//$nomineeEmail = 'gta1@emailinator.com';
	//$isNomineePhdStudent = 1;
	//$isNomineeNewlyAdmitted = 0;
	
	//Query to create the nominee data that the nominator has entered
	$createNominee = "INSERT INTO gtanominee 
		(nomineeName, pid, nomineeEmail, isPHDStudent, newlyAdmitted) 
		VALUES ('{$nomineeName}', '{$nomineePid}', '{$nomineeEmail}', 
			'{$isNomineePhdStudent}', '{$isNomineeNewlyAdmitted}')";
	
	//Execute the query
	$executeNomineeCreation = mysqli_query($con, $createNominee);
	
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
	
	$messagebody = urlencode ("You have been nominated to be a GTA. http://127.0.0.1/newnominee.php?pid=$nomineePid");
	$subject = urlencode("GTA Nomination");
	header("Location:sendmail.py?recipient=$nomineeEmail&subject=$subject&body=$messagebody");
	
}
?>
