<?php
session_start();
include 'connect.php';

// checking the user
if (isset($_POST['submitNomineeForm'])) {
	
	//check if nominee is already verified
	$nomineeVerifiedQuery = mysqli_query($con, "SELECT verified FROM nomination WHERE sessionid='{$_SESSION['sessionid']}' AND pid='{$_SESSION['user']}'");
	$nomineeVerified = mysqli_fetch_array($nomineeVerifiedQuery);
	
	if($nomineeVerified['verified'] == 0)
	{
		//Getting all the values set by the professor for the nomination

		$nomineePhone = mysqli_real_escape_string($con, $_POST["nomineePhone"]);
		$numberOfSem = mysqli_real_escape_string($con, $_POST["numberOfSem"]);
		$isNomineePassedSpeak = mysqli_real_escape_string($con, $_POST["isNomineePassedSpeak"]);
		$numberOfSemAsGTA = mysqli_real_escape_string($con, $_POST["numOfSemAsGTA"]);

		$coursesCompleted = mysqli_real_escape_string($con, $_POST["coursesCompleted"]);
		$coursesGPA = mysqli_real_escape_string($con, $_POST["coursesGPA"]);
		$publications = mysqli_real_escape_string($con, $_POST["publications"]);

		$advisorName = mysqli_real_escape_string($con, $_POST["advisorName"]);


		$timestamp = date('y-m-d h:m:s');

		//Update the values for the nominee that just submitted his form
		/* $updateNominee = "INSERT INTO gtanominee 	(advisor, newlyAdmitted, nomineeName, nomineeEmail, isPHDStudent, nomineePhone, semestersAsGrad, passedSpeak, semestersAsGTA, gradCourses, gpa, publications, pid)
									VALUES 			('$advisorName', $isNomineeNewlyAdmitted , '$nomineeName' , '$nomineeEmail' , $isNomineePhdStudent , '$nomineePhone',$numberOfSemAsGTA,$isNomineePassedSpeak,$numberOfSemAsGTA,'$coursesCompleted',$coursesGPA, '$publications', '$nomineePid');"; */
		$updateNominee = "UPDATE gtanominee SET nomineePhone='$nomineePhone', semestersAsGrad='$numberOfSem', passedSpeak='$isNomineePassedSpeak', semestersAsGTA='$numberOfSemAsGTA', gradCourses='$coursesCompleted', gpa='$coursesGPA', publications='$publications', advisor='$advisorName' WHERE pid='{$_SESSION['user']}'";
		
		$updateNomination = "UPDATE nomination SET responded=1 WHERE pid='{$_SESSION['user']}' AND sessionid='{$_SESSION['sessionid']}'";
									
		//Execute the queries
		$executeNomineeUpdate = mysqli_query($con, $updateNominee) or trigger_error("Query Failed! SQL: $updateNominee - Error: " . mysqli_error($con), E_USER_ERROR);
		$executeNominationUpdate = mysqli_query($con, $updateNomination) or trigger_error("Query Failed! SQL: $updateNominee - Error: " . mysqli_error($con), E_USER_ERROR);

		//Now the nominee has just filled out the form, an email needs to be sent to the nominator in the block below.
		
		//get nominator email
		$nominatorEmailQuery = mysqli_query($con, "SELECT nominatorEmail FROM gtanominator INNER JOIN nomination ON gtanominator.nominatorLogin=nomination.nominatorLogin WHERE sessionid='{$_SESSION['sessionid']}' AND pid='{$_SESSION['user']}'");
		$nominatorEmailInfo = mysqli_fetch_array($nominatorEmailQuery);
		$nominatorEmail = $nominatorEmailInfo['nominatorEmail'];
		
		//get nominee name
		$nomineeNameQuery = mysqli_query($con, "SELECT nomineeName FROM gtanominee WHERE pid='{$_SESSION['user']}'");
		$nomineeName = mysqli_fetch_array($nomineeNameQuery);
		
		$messagebody = urlencode ("Nominee, {$nomineeName['nomineeName']}, is ready for verification. Please log in and verify nominees. 127.0.0.1/index.html");
		$subject = urlencode("Verify GTA Nominee");
		header("Location:sendmail.py?recipient=$nominatorEmail&subject=$subject&body=$messagebody");
	}
	else{
		echo "Already verified.";
	}

    
}
?>
